<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msubjek extends Model
{
   protected $table = "msubjek";
   protected $fillable = ["nama_subjek"];
   public $timestamps = false;
}
