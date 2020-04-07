<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetailPeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_detail_peminjaman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_pinjam');
            $table->integer('id_mobil');
            $table->integer('denda');
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
        Schema::dropIfExists('table_detail_peminjaman');
    }
}
