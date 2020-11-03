<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministrativeLevel extends Model
{
    protected $table = "madministrativelevel";
    protected $fillable = ["nama_administrativelevel"];
    public $timestamps = false;
}
