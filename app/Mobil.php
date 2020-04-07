<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table="mobil";
    protected $tableprimaryKey="id";
    public $timestamps=false;

    protected $fillable = [
        'plat_mobil', 'merk', 'foto', 'keterangan'
    ];

}
