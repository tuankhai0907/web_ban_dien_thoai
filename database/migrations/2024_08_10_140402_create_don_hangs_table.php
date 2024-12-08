<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonHangsTable extends Migration
{
    public function up()
    {
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->increments('ma_don_hang');
            $table->integer('ma_nguoi_dung')->unsigned();
            $table->date('ngay_dat_hang');
            $table->decimal('tong_tien', 10, 2);
            $table->timestamps(); 
            
            // Thêm index cho cột ma_nguoi_dung
            $table->index('ma_nguoi_dung');
            
            $table->foreign('ma_nguoi_dung')->references('ma_nguoi_dung')->on('nguoi_dungs');
        });
    }

    public function down()
    {
        Schema::dropIfExists('don_hangs');
    }
}
