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
        Schema::create('news_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('news_id'); // Tham chiếu tới bảng news
            $table->string('language_code')->default('vi'); // Mã ngôn ngữ (ví dụ: 'vi', 'en')
            $table->string('news_name');
            $table->text('news_desc')->nullable(); // mô tả
            $table->timestamps();
        
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->unique(['news_id', 'language_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_translations');
    }
};
