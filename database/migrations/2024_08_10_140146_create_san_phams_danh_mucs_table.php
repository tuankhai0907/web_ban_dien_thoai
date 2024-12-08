<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanPhamsDanhMucsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('san_phams_danh_mucs')) {
            Schema::create('san_phams_danh_mucs', function (Blueprint $table) {
                $table->integer('ma_san_pham')->unsigned();
                $table->integer('ma_danh_muc')->unsigned();
                $table->primary(['ma_san_pham', 'ma_danh_muc']);
                $table->foreign('ma_san_pham')->references('ma_san_pham')->on('san_phams');
                $table->foreign('ma_danh_muc')->references('ma_danh_muc')->on('danh_mucs');
                $table->timestamps(); 
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('san_phams_danh_mucs');
    }
}
