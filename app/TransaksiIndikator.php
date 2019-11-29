<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiIndikator extends Model
{
    protected $table = "transaksiindikator";
    protected $fillable = ["nama_transaksi_indikator", "mindikator_id", "user_id", "tahundata", "madministrativelevel_id", "status_entri", "status_tayang"];
    // public $timestamps = false;

    public function Mindikator()
    {
        return $this->hasOne('App\Mindikator', 'id', 'mindikator_id');
    }

    public function Madministrativelevel()
    {
        return $this->hasOne('App\AdministrativeLevel', 'id', 'madministrativelevel_id');
    }

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
