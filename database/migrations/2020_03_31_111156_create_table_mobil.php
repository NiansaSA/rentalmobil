<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMobil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_mobil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plat_mobil', 100);
            $table->string('merk', 100);
            $table->string('foto');
            $table->string('keterangan', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_mobil');
    }
}
