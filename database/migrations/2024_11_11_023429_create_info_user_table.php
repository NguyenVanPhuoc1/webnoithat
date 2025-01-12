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
        Schema::create('info_user', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('hotline',10);//hotline
            $table->string('phone',10);//số điện thoại
            $table->string('gender');// giới tinh
            $table->string('address');// địa chỉ
            $table->timestamps();
             //thiết lập khóa ngoại id bảng users và from_id bảng chat_messages
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            //cascade: xóa a -> b xóa theo
            //restrict: xóa a- > b: bị chặn và báo lỗi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_user');
    }
};
