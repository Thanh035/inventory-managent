<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('code')->unique()->after('name'); // Mã vai trò
            $table->text('note')->nullable()->after('code'); // Ghi chú
            $table->unsignedBigInteger('created_by')->nullable()->after('note'); // Người tạo
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null'); // Khóa ngoại
        });
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn(['code', 'note', 'created_by']);
        });
    }
};
