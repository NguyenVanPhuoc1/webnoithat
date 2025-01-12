<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends AbstractCrud
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    // Bạn có thể thêm các phương thức riêng cho danh mục tại đây
    public static function baseQuery(){
        return Category::select('id','slug','cate_name','noi_bat');
    }
    public function getAll(){
        return self::baseQuery()
        ->orderBy('created_at', 'desc')
        ->paginate(5);
    }
    public function delete($id){
        $category = $this->getById($id);
        // dd($this->hasProducts($category));die();
        // Kiểm tra xem danh mục còn sản phẩm hay không
        if ($this->hasProducts($category)) {
            return back()->with('error', 'Danh mục này còn sản phẩm!');
        }
        $category->delete();
        return back()->with('success', 'Xóa thành công.');
    }

    public function deleteSelectedIds($selectedIds){
        if (!empty($selectedIds)) {
            // Xóa các bài viết với các ID đã chọn
            Category::whereIn('id', $selectedIds)->delete();
        }
    }

    protected function hasProducts($category)
    {
        // Kiểm tra xem danh mục có sản phẩm hay không
        return $category->products()->exists();
    }

    //add category
    public function createCateData($data){
        return DB::transaction(function () use ($data) {
            $cate = Category::create([
                'slug' => $data['slug'],
                'cate_name' => $data['cate_name_vi'],
                'noi_bat' => true,
            ]);
        });
    }
    public function updateCateData($data,$id){
        // Start transaction
        return DB::transaction(function () use ($data,$id) {
            $cate = $this->getById($id);
            // Create the News entry
            $cate->update([
                'slug' => $data['slug'],
                'cate_name' => $data['cate_name_vi'],
                'noi_bat' => true,
            ]);
        });
    }
}