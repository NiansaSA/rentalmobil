<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePenyewa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_penyewa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_penyewa', 100);
            $table->string('alamat', 100);
            $table->string('telp', 100);
            $table->integer('no_ktp');
            $table->string('foto');
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
        Schema::dropIfExists('table_penyewa');
    }
}
