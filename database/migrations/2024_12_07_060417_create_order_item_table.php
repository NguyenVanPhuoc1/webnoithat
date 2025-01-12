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
        Schema::create('order_item', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('order_id', 6);  
            $table->string('product_name');
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();

            //thiết lập khóa ngoại
            $table->foreign('order_id')
                ->references('id')
                ->on('order')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item');
    }
};
