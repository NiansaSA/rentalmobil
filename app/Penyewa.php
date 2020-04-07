<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    protected $table="penyewa";
    protected $tableprimaryKey="id";
    public $timestamps=false;

    protected $fillable = [
        'nama_penyewa', 'alamat', 'telp', 'no_ktp', 'foto'
    ];

}
