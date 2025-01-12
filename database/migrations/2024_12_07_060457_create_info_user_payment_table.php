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
        Schema::create('info_user_payment', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id'); // Khóa ngoại tới bảng users
            $table->string('order_id', 6);  
            $table->string('name'); // Tên người nhận
            $table->string('phone'); // Số điện thoại
            $table->string('address'); // Địa chỉ nhận hàng
            $table->text('note')->nullable(); // Ghi chú (có thể để trống)
            $table->timestamps();

            // Khóa ngoại liên kết tới bảng users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_user_payment');
    }
};
