<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id'); // Thay đổi từ unsignedBigInteger sang unsignedInteger
            $table->unsignedInteger('san_pham_id'); // Thay đổi từ unsignedBigInteger sang unsignedInteger
            $table->integer('quantity')->default(1);
            $table->timestamps();
            
            $table->foreign('user_id')->references('ma_nguoi_dung')->on('users')->onDelete('cascade');
            $table->foreign('san_pham_id')->references('ma_san_pham')->on('san_phams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
