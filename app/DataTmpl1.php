<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataTmpl1 extends Model
{
    protected $table = "datatmpl1";
    protected $fillable = ["id_indikator", "tahun", "nu_karakteristik", "nu_baris", "nu_periode", "data"];
    // public $timestamps = false;
    // public $incrementing = true;
    // protected $keyType = 'int';
}
