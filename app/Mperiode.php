<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mperiode extends Model
{
    protected $table = 'mperiodewaktu';
    protected $fillable = ["nama_periode"];
    // public $timestamps = false;

    public function Mperiodeitems()
    {
        return $this->hasMany('App\Mperiodeitems', 'mperiode_id');
    }
}
