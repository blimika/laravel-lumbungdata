<?php

namespace App\Exports;

use App\DataTmpl1;
use App\TransaksiIndikator;
use App\Mbaris;
use App\Mbarisitems;
use App\Mkarakteristik;
use App\Mkarakteristikitems;
use App\Mperiode;
use App\Mperiodeitems;
use App\Msatuan;
use App\Mindikator;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class DataTmpl1ExportBaru implements FromView
{
    private $turunanIndikator;
    private $tahundata;
    private $administrativeLevel;

    private $indId;
    private $max_baris;
    private $barisitems;
    private $max_periode;
    private $periodeitems;
    private $max_karakteristik;
    private $karakteristikitems;

    public function __construct($id, $tahun, $admlevel)
    {
        $turunanIndikator_id = $id;
        $this->tahundata = $tahun;
        $this->administrativeLevel = $admlevel;

        //Get Data Parameter
        $this->turunanIndikator = TransaksiIndikator::where('id', $turunanIndikator_id)->where('tahundata',$this->tahundata)->first();
        $this->indId = Mindikator::where('id', $this->turunanIndikator->mindikator_id)->first();
        $this->max_baris = Mbarisitems::where('mbaris_id', $this->indId->mbaris_id)->max('no_urut');
        $this->barisitems = Mbarisitems::where('mbaris_id', $this->indId->mbaris_id)->get();
        $this->max_karakteristik = Mkarakteristikitems::where('mkarakteristik_id', $this->indId->mkarakteristik_id)->max('no_urut');
        $this->karakteristikitems = Mkarakteristikitems::where('mkarakteristik_id', $this->indId->mkarakteristik_id)->get();
        $this->max_periode = Mperiodeitems::where('mperiode_id', $this->indId->mperiode_id)->max('no_urut');
        $this->periodeitems = Mperiodeitems::where('mperiode_id', $this->indId->mperiode_id)->get();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function view(): View
    {
        
        return view('data.downloadtabel',[
            'id_indikator' =>  $this->turunanIndikator->id,
            'madministrativelevel_id' => $this->turunanIndikator->madministrativelevel_id,
            'nama_indikator' => $this->turunanIndikator->nama_transaksi_indikator,
            'tahun' => $this->tahundata,
            'judul_baris' => $this->indId->Mbaris->nama_baris,
            'max_baris' => $this->max_baris,
            'barisitems' => $this->barisitems,
            'max_karakteristik' => $this->max_karakteristik,
            'karakteristikitems' => $this->karakteristikitems,
            'max_periode' => $this->max_periode,
            'periodeitems' => $this->periodeitems,
        ]);

    }
}
