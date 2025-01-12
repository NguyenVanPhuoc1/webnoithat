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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cate_id'); // Tham chiếu tới bảng danh mục
            $table->string('slug')->unique(); // Slug chung
            $table->integer('price'); // Giá
            $table->integer('discount_percent'); // Giảm giá
            $table->boolean('noi_bat'); // Nổi bật
            $table->timestamps();
            // Thiết lập khóa ngoại cho product_id liên kết với bảng products
            $table->foreign('cate_id')
                ->references('id')
                ->on('category')
                ->onDelete('restrict');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
