<?php
namespace App\Models;

class ProductDetail
{
    public $id;
    public $slug;
    public $price;
    public $discount_percent;
    public $noi_bat;
    public $category;
    public $images;
    public $translate;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->slug = $data['slug'];
        $this->price = $data['price'];
        $this->discount_percent = $data['discount_percent'];
        $this->noi_bat = $data['noi_bat'];
        $this->category = $data['category'];
        $this->images = $data['images'];
        $this->translate = $data['translate'];
    }

    // Bạn có thể thêm các phương thức hỗ trợ ở đây, ví dụ:
    public function getCategoryName()
    {
        return $this->category['cate_name'];
    }

    public function getTranslation($language)
    {
        return $this->translate[$language] ?? null;
    }
}
