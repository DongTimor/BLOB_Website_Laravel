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
        Schema::table('comment', function (Blueprint $table) {
            // Xóa ràng buộc khóa ngoại hiện tại
            $table->dropForeign(['content_id']);
            // Thêm lại với cascade on delete
            $table->foreign('content_id')->references('id')->on('contents')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comment', function (Blueprint $table) {
            // Xóa ràng buộc khóa ngoại đã thêm trong up()
            $table->dropForeign(['content_id']);
            // Thêm lại ràng buộc khóa ngoại ban đầu
            $table->foreign('content_id')->references('id')->on('contents');
        });
    }
};
