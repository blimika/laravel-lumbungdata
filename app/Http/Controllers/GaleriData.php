<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransaksiIndikator;
use App\Mbaris;
use App\Mbarisitems;
use App\Mkarakteristik;
use App\Mkarakteristikitems;
use App\Mperiode;
use App\Mperiodeitems;
use App\Msatuan;
use App\Mindikator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataTmpl1NewExport;
use App\Exports\DataTmpl1ExportBaru;
use App\Exports\DataTmpl2NewExport;

class GaleriData extends Controller
{
    public function showGaleriData()
    {
        $galeriData = TransaksiIndikator::where('status_tayang', 1)->get();
        return view('galeridata.showGaleriData', ['galeridata' => $galeriData]);
    }

    public function viewData($id, $tahun, $admlevel)
    {
        $turunanIndikator_id = $id;
        $tahundata = $tahun;
        $administrativeLevel = $admlevel;

        //Get Data Parameter
        $turunanIndikator = TransaksiIndikator::where('id', $turunanIndikator_id)->where('tahundata',$tahundata)->first();
        $indId = Mindikator::where('id', $turunanIndikator->mindikator_id)->first();
        $max_baris = Mbarisitems::where('mbaris_id', $indId->mbaris_id)->max('no_urut');
        $barisitems = Mbarisitems::where('mbaris_id', $indId->mbaris_id)->get();
        $max_karakteristik = Mkarakteristikitems::where('mkarakteristik_id', $indId->mkarakteristik_id)->max('no_urut');
        $karakteristikitems = Mkarakteristikitems::where('mkarakteristik_id', $indId->mkarakteristik_id)->get();
        $max_periode = Mperiodeitems::where('mperiode_id', $indId->mperiode_id)->max('no_urut');
        $periodeitems = Mperiodeitems::where('mperiode_id', $indId->mperiode_id)->get();
        
        return view('tabeldinamis.viewuploadedtable',[
            'id_indikator' =>  $turunanIndikator->id,
            'madministrativelevel_id' => $turunanIndikator->madministrativelevel_id,
            'nama_indikator' => $turunanIndikator->nama_transaksi_indikator,
            'tahun' => $tahundata,
            'judul_baris' => $indId->Mbaris->nama_baris,
            'max_baris' => $max_baris,
            'barisitems' => $barisitems,
            'max_karakteristik' => $max_karakteristik,
            'karakteristikitems' => $karakteristikitems,
            'max_periode' => $max_periode,
            'periodeitems' => $periodeitems,
        ]);
    }

    public function downloadData($id, $tahun, $admlevel)
    {
        if($admlevel == 1)
        {
            return Excel::download(new DataTmpl1NewExport($id, $tahun, $admlevel), 'data.xlsx');
        }

        if($admlevel == 2)
        {
            return Excel::download(new DataTmpl2NewExport($id, $tahun, $admlevel), 'data.xlsx');
        }
        
    }
}
