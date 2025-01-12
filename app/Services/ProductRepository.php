<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTranslation;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductRepository extends AbstractCrud
{
    protected $languageCode;
    protected $fileStorageService;

    public function __construct(Product $model,FileStorageService $fileStorageService)
    {
        parent::__construct($model);
        $this->languageCode = session()->get('locale', 'vi');
        $this->fileStorageService = $fileStorageService;
    }

    // Bạn có thể thêm các phương thức riêng cho sản phẩm tại đây
    public function updateLanguageCode()
    {
        return $this->languageCode = session()->get('locale','vi');
    }
    public static function baseQuery()
    {
        return DB::table('products')
        ->join('product_image', 'products.id', '=', 'product_image.product_id')
        ->join('product_translations', 'products.id', '=', 'product_translations.product_id')
        ->join('category', 'products.cate_id', '=', 'category.id')
        ->select(
            'products.id',
            'products.slug',
            'products.price',
            'products.discount_percent',
            'product_translations.language_code',
            'product_translations.name as product_name',
            'category.cate_name as category_name',
            DB::raw('MIN(product_image.image_path) as product_image'), // Chọn ảnh đầu tiên theo thứ tự
            'products.noi_bat'
        )->groupBy(
            'products.id',
            'products.slug',
            'products.price',
            'products.discount_percent',
            'product_translations.language_code',
            'product_translations.name',
            'category.cate_name',
            'products.noi_bat'
        );
        //dùng groupBy đảm bảo mỗi sản phẩm xuất hiện 1 lần
    }
    //hàm lấy chi tiết
    private function formatProductDetail($product) {
        return [
            'id' => $product->id,
            'slug' => $product->slug,
            'price' => $product->price,
            'discount_percent' => $product->discount_percent,
            'noi_bat' => $product->noi_bat,
            'category' => [
                'cate_id' => $product->category->id,
                'cate_name' => $product->category->cate_name,
            ],
            'images' => $product->images->pluck('image_path')->all(),
            'translate' => $product->translations->mapWithKeys(function ($translation) {
                return [
                    $translation->language_code => [
                        'name' => $translation->name,
                        'description' => $translation->description,
                    ]
                ];
            })->all(),
        ];
    }

    /**
     * Hàm lấy chi tiết sản phẩm theo ID
     */
    public function getDetail($id) {
        $product = Product::with(['images', 'translations', 'category'])
            ->where('id', $id)
            ->first();

        if (!$product) {
            return abort(404); // Không tìm thấy sản phẩm
        }

        $data = $this->formatProductDetail($product);
        return new ProductDetail($data);
    }

    /**
     * Hàm lấy chi tiết sản phẩm theo slug
     */
    public function getDetailBySlug($slug) {
        $product = Product::with(['images', 'translations', 'category'])
            ->where('slug', $slug)
            ->first();

        if (!$product) {
            return abort(404); // Không tìm thấy sản phẩm
        }

        $data = $this->formatProductDetail($product);
        return new ProductDetail($data);
    }
    //lấy tất cả
    public function getAllProduct(){
        return self::baseQuery()
        ->where('product_translations.language_code', '=', $this->languageCode)
        ->orderBy('products.created_at', 'desc')
        ->paginate(10);
    }
    public static function getAllProductbyCate($categoryId, $lang){
        return self::baseQuery()
        ->where('product_translations.language_code', '=', $lang)
        ->where([
            ['products.cate_id', '=', $categoryId],
            ['products.noi_bat', '=', true],
        ])
        ->orderBy('products.created_at', 'desc')
        ->paginate(8);
    }
    //tìm kiếm
    public static function searchProduct($keyword, $lang){
        return self::baseQuery()
        ->where('product_translations.language_code', '=', $lang)
        ->where('product_translations.name', 'like', '%' . $keyword . '%')
        ->orderBy('products.created_at', 'desc')
        ->paginate(12);
    }
    //tạo data sản phẩm
    public function createProductData($data)
    {

        // Thực hiện transaction để lưu dữ liệu
        return DB::transaction(function () use ($data) {
            $now = Carbon::now();
            // Tạo sản phẩm
            $product = Product::create([
                'cate_id' => $data['cate_id'],
                'slug' => $data['slug'],
                'price' => intval($data['product_price']),
                'discount_percent' => intval($data['discount_percent']),
                'noi_bat' => true,
            ]);

            $this->addImageProduct($data, $product, $now);

            // Thêm bản dịch sản phẩm (sử dụng batch insert)
            $translationsData = [];
            foreach (['vi', 'en'] as $lang) {
                $translationsData[] = [
                    'id' => Str::uuid()->toString(),
                    'product_id' => $product->id,
                    'language_code' => $lang,
                    'name' => $data["product_name_{$lang}"],
                    'description' => htmlspecialchars($data["content{$lang}"], ENT_QUOTES, 'UTF-8'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            ProductTranslation::insert($translationsData);
        });
    }
    //xóa file ảnh sản phẩm
    public function deleteFileImage($data){

        $isDeleted = $this->fileStorageService->remove_file($data['file_name']);
        // dd($isDeleted);die();
        if($isDeleted){
            ProductImage::where('product_id', $data['id'])
            ->where('image_path', $data['file_name'])->delete();
        }
    }
    //update thông tin sản phẩm
    public function updateProductData($data,$product){
        // $product = $this->getById($id);

        return DB::transaction(function () use ($data,$product) {
            //update thông tin sản phẩm
            $product->update([
                'cate_id' => $data['cate_id'],
                'slug' => $data['slug'],
                'price' => intval($data['product_price']),
                'discount_percent' => intval($data['discount_percent']),
            ]);
            //update thông tin chi tiết sản phẩm translation
            foreach (['vi', 'en'] as $lang) {
                ProductTranslation::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'language_code' => $lang,
                    ],
                    [
                        'name' => $data["product_name_{$lang}"],
                        'description' => htmlspecialchars($data["content{$lang}"], ENT_QUOTES, 'UTF-8'),
                    ]
                );
            }
        });
    }
    //kiểm tra sản phẩm còn hình ảnh k
    public function checkImage($product){
        if ($product->images()->exists()) {
            // Product vẫn còn ảnh
            return true;
        } 
        return false;
    }
    //hàm thêm ảnh sản phẩm khi tồn tại file
    public function addImageProduct($data, $product, $now){
        $uploadedFilePaths = [];
    
        // Upload các tệp và lưu đường dẫn
        foreach ($data['files'] ?? [] as $file) {
            if ($file->isValid()) {
                $uploadedFilePaths[] = $this->fileStorageService->upload_file($file, 'product');
            }
        }
        
        // Thêm ảnh sản phẩm (sử dụng batch insert)
        $imagesData = array_map(function ($filePath) use ($product, $now) {
            return [
                'product_id' => $product->id,
                'image_path' => $filePath,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $uploadedFilePaths);

        if (!empty($imagesData)) {
            ProductImage::insert($imagesData);
        }
    }
    //xóa sản phẩm theo id
    public function delete($id){
        return DB::transaction(function () use ($id) {
            Product::findOrFail($id)->delete();
            ProductTranslation::where('product_id', $id)->delete();
            ProductImage::where('product_id', $id)->delete();
        });
    }
    //xóa sản phẩm theo danh sách id
    public function deleteSelectedIds($selectedIds){
        if (!empty($selectedIds)) {
            // Xóa các bài viết với các ID đã chọn
            return DB::transaction(function () use ($selectedIds) {
                Product::whereIn('id', $selectedIds)->delete();
                ProductTranslation::whereIn('product_id', $selectedIds)->delete();
                ProductImage::whereIn('product_id', $selectedIds)->delete();
            });
        }
    }

    public function getProductstoCart($id){
        return self::baseQuery()
        ->where('product_translations.language_code', $this->updateLanguageCode())
        ->where('products.id',$id)->first(); 
    }

    //related product
    public function getRelatedProduct($id,$cate_id){
        return self::baseQuery()
        ->where('products.id', '!=', $id)
        ->where('products.cate_id', '=' , $cate_id)
        ->where('product_translations.language_code', '=', $this->updateLanguageCode())
        ->limit(4)
        ->get();
    }
}
