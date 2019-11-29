<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mkarakteristikitems extends Model
{
    protected $table = 'mkarakteristikitems';
    protected $fillable = ["no_urut", "nama_items", "mkarakteristik_id"];
    // public $timestamps = false;

    public function Mkarakteristik()
    {
        return $this->belongsTo('App\Mkarakteristik', 'mkarakteristik_id');
    }

}
