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
        Schema::create('collection_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // liên kết với bảng 'products'
            $table->foreignId('collection_id')->constrained()->onDelete('cascade'); // liên kết với bảng 'collections'
            $table->timestamps();

            $table->unique(['product_id', 'collection_id']); // đảm bảo không có bản ghi trùng lặp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_product');
    }
};
