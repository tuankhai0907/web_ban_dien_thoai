<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanPhamsTable extends Migration
{
    public function up()
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->increments('ma_san_pham');
            $table->string('ten_san_pham', 255);
            $table->string('thuong_hieu', 255);
            $table->decimal('gia', 10);
            $table->text('mo_ta');
            $table->string('duong_dan_hinh_anh', 255);
            $table->string('chi_tiet_1', 255);
            $table->string('chi_tiet_2', 255);
            $table->string('chi_tiet_3', 255);
            $table->string('chi_tiet_4', 255);
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('san_phams');
    }

    
}