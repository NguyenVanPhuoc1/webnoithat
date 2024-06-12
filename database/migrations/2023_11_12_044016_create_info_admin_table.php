<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_admin', function (Blueprint $table) {
            $table->id();
            $table->string('info_name');//họ tên
            $table->string('hotline',10);//hotline
            $table->string('phone',10);//số điện thoại
            $table->string('gioitinh');// giới tinh
            $table->string('diachi');// địa chỉ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_admin');
    }
};
