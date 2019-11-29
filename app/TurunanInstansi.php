<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TurunanInstansi extends Model
{
    protected $table = "turunaninstansi";
    protected $fillable = ["nama_instansi", "minstansi_id", "madministrativelevel_id"];
    // public $timestamps = false;
}
