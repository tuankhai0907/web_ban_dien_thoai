<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('ma_nguoi_dung');
            $table->string('ten_nguoi_dung', 255);
            $table->string('password', 255);
            $table->string('email', 255);
            $table->string('dia_chi', 255);
            $table->string('so_dien_thoai', 20);
            $table->string('role')->default('user');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}