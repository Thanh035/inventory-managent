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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id(); // Tạo khóa chính
            $table->string('name'); // Tên của supplier
            $table->string('contact_email')->unique(); // Email liên hệ của supplier
            $table->string('phone_number')->nullable(); // Số điện thoại của supplier (tùy chọn)
            $table->text('address')->nullable(); // Địa chỉ của supplier (tùy chọn)
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
