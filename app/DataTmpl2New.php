<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataTmpl2New extends Model
{
    protected $table = "datatmpl2new";
    protected $fillable = ["turunanindikator_id", "tahun", "nu_karakteristik", "nu_baris", "nu_periode", "data"];
    public $timestamps = false;
}
