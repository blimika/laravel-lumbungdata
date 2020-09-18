<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mperiodeitems extends Model
{
    protected $table = 'mperiodewaktuitems';
    protected $fillable = ["no_urut", "nama_items", "mperiode_id"];
    public $timestamps = false;
}
