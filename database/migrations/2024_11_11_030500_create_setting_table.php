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
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('key')->unique(); // Key cấu hình, ví dụ: site_logo, favicon
            $table->string('value'); // Giá trị của cấu hình, ví dụ: đường dẫn ảnh
            $table->enum('type', ['image', 'text', 'number'])->default('text'); // Kiểu dữ liệu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};
