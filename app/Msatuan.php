<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msatuan extends Model
{
    protected $table = "msatuan";
    protected $fillable = ["nama_satuan"];
    public $timestamps = false;
}
