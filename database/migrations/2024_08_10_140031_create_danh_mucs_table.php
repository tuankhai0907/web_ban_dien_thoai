<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanhMucsTable extends Migration
{
    public function up()
    {
        Schema::create('danh_mucs', function (Blueprint $table) {
            $table->increments('ma_danh_muc');
            $table->string('ten_danh_muc', 255);
            $table->timestamps(); 
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('danh_mucs');
    }
}
