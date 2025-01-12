<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_image', function (Blueprint $table) {
            $table->id();
            $table->uuid('product_id');          // Mã sản phẩm (FK liên kết với bảng products)
            $table->string('image_path');        // Đường dẫn hoặc tên file của ảnh
            $table->timestamps();
        
            // Thiết lập khóa ngoại cho product_id liên kết với bảng products
            $table->foreign('product_id')
                ->references('id')
                ->on('product')
                ->onDelete('cascade');   // Nếu sản phẩm bị xóa, tất cả ảnh liên quan sẽ bị xóa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_image');
    }
};
