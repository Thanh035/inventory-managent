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
            $table->id(); // Tạo khóa chính (ID)
            $table->string('productName')->nullable();
            $table->string('categoryName')->nullable();
            $table->string('supplierName')->nullable();
            $table->text('description')->nullable();
            $table->integer('quantity')->nullable()->default(0);
            $table->decimal('sellingPrice', 10, 2)->nullable();
            $table->decimal('comparePrice', 10, 2)->nullable();
            $table->decimal('capitalPrice', 10, 2)->nullable();
            $table->string('sku')->nullable()->unique();
            $table->string('barcode')->nullable()->unique();
            $table->boolean('allowOrders')->nullable();
            $table->timestamps(); // Tạo cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
