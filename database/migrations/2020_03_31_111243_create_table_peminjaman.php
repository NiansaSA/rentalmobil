<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_peminjaman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_petugas');
            $table->integer('id_penyewa');
            $table->date('tgl_pinjam');
            $table->date('deadline');
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
        Schema::dropIfExists('table_peminjaman');
    }
}
