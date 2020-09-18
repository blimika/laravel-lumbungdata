<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mindikator extends Model
{
    protected $table = 'mindikator';
    protected $fillable = ['nama_indikator', 'mbaris_id', 'mkarakteristik_id', 'mperiode_id', 'msatuan_id', 'msubjek_id', 'mseriesleveltabel_id'];
    public $timestamps = false;

    public function Mbaris()
    {
        return $this->hasOne('App\Mbaris', 'id', 'mbaris_id');
    }

    public function Mkarakteristik()
    {
        return $this->hasOne('App\Mkarakteristik', 'id', 'mkarakteristik_id');
    }

    public function Mperiode()
    {
        return $this->hasOne('App\Mperiode', 'id', 'mperiode_id');
    }

    public function Msatuan()
    {
        return $this->hasOne('App\Msatuan', 'id', 'msatuan_id');
    }

    public function Msubjek()
    {
        return $this->hasOne('App\Msubjek', 'id', 'msubjek_id');
    }
    public function TransaksiIndikator()
    {
        return $this->belongsTo('App\TransaksiIndikator','id','mindikator_id');
    }

}
