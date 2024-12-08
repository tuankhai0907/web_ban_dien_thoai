<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChiTiet1ToSanPhamsTable extends Migration
{
    public function up()
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->string('chi_tiet_1')->nullable();
            $table->string('chi_tiet_2')->nullable();
            $table->string('chi_tiet_3')->nullable();
            $table->string('chi_tiet_4')->nullable();
        });
    }

    public function down()
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->dropColumn('chi_tiet_1');
            $table->dropColumn('chi_tiet_2');
            $table->dropColumn('chi_tiet_3');
            $table->dropColumn('chi_tiet_4');
        });
    }
}