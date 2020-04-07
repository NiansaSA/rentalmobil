<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePetugas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_petugas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_petugas', 100);
            $table->string('alamat', 100);
            $table->string('telp', 100);
            $table->string('username', 100);
            $table->string('password', 100);
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
        Schema::dropIfExists('table_petugas');
    }
}
