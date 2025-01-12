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
        Schema::create('policy_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('policy_id'); // Tham chiếu tới bảng policies
            $table->string('language_code')->default('vi'); // Mã ngôn ngữ (ví dụ: vi, en)
            $table->string('poli_name'); // Tên chính sách
            $table->text('poli_desc')->nullable(); // Mô tả
            $table->timestamps();

            $table->foreign('policy_id')->references('id')->on('policies')->onDelete('cascade');
            $table->unique(['policy_id', 'language_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_translations');
    }
};
