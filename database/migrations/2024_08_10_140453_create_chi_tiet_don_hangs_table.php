<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietDonHangsTable extends Migration
{
    public function up()  
    {  
        if (!Schema::hasTable('chi_tiet_don_hangs')) {  
            Schema::create('chi_tiet_don_hangs', function (Blueprint $table) {  
                $table->increments('ma_chi_tiet_don_hang');  
                $table->integer('ma_don_hang')->unsigned();  
                $table->integer('ma_san_pham');  
                $table->integer('so_luong');  
                $table->decimal('thanh_tien', 10, 2);  
                $table->index('ma_don_hang');  
                $table->foreign('ma_don_hang')->references('ma_don_hang')->on('don_hangs');  
                $table->foreign('ma_san_pham')->references('ma_san_pham')->on('san_phams');  
                $table->timestamps();   
            });  
        }  
    }

    public function down()
    {
        Schema::dropIfExists('chi_tiet_don_hangs');
    }
}
