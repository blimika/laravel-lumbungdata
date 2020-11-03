<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mindikator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataTmpl1Import;
use App\DataTmpl1;
use App\Mbaris;
use App\Mbarisitems;
use App\Mkarakteristik;
use App\Mkarakteristikitems;
use App\Mperiode;
use App\Mperiodeitems;
use App\Msatuan;
use App\TransaksiIndikator;
use App\Imports\DataTmpl2NewImport;
use App\Imports\DataTmpl1NewImport;
use App\Msubjek;

class InputTabelDinamis extends Controller
{
    public function showInputTabelDinamis()
    {
        // $mindikator = Mindikator::all();
        // return view('tabeldinamis.listindikator', ['mindikator' => $mindikator]);
        $turunanIndikator;
        
        if(Auth()->user()->IsSuperAdmin())
        {
            $turunanIndikator = Transaksiindikator::leftJoin('mindikator','mindikator.id','=','transaksiindikator.mindikator_id')->when(request('msubjek'),function($query){
                return $query->where('mindikator.msubjek_id',request('msubjek'));
            })->select('transaksiindikator.*')->get();
        }
        else
        {
            $turunanIndikator = Transaksiindikator::leftJoin('mindikator','mindikator.id','=','transaksiindikator.mindikator_id')->when(request('msubjek'),function($query){
                return $query->where('mindikator.msubjek_id',request('msubjek'));
            })->where('user_id' , Auth()->user()->id)->select('transaksiindikator.*')->get();
        }
        //dd($turunanIndikator);
        $data_subjek = Msubjek::get();
        return view('tabeldinamis.listindikator', ['turunanIndikator'=>$turunanIndikator,'dataSubjek'=>$data_subjek]);
    }

    public function getDataIndikator($id)
    {
        // $mindikator = Mindikator::where('id', "=", $id)->first();
        $turunanIndikator = Transaksiindikator::where('id', $id)->first();
        return view('tabeldinamis.uploaddatatabel', ['turunanIndikator' => $turunanIndikator]);
    }

    public function setTayangkan($turunanIndikator_id)
    {
        $isSuccessTayangkan = Transaksiindikator::updateOrCreate(
            ['id' => $turunanIndikator_id],
            ['status_tayang' => 1]
        );

        return redirect()->route('tabeldinamis.inputtabeldinamis');
    }

    public function setTurunTayang($turunanIndikator_id)
    {
        $isSuccessTurunTayang = Transaksiindikator::updateOrCreate(
            ['id' => $turunanIndikator_id],
            ['status_tayang' => 0]
        );

        return redirect()->route('tabeldinamis.inputtabeldinamis');
    }

    public function uploadDataIndikator(Request $request)
    {
        //dd($request->all());
        // $id_indikator = $request->uploaddataidindikator;
        $turunanIndikator_id = $request->uploaddataturunanindikator_id;
        $tahundata = $request->uploaddatatahun;
        $administrativeLevel = $request->uploaddataadministrativelevel;

        //Import Data Into Database
        // Excel::import(new DataTmpl1Import($id_indikator, $tahundata), request()->file('uploaddatafile'));
        if($administrativeLevel == 1)
        {
            Excel::import(new DataTmpl1NewImport($turunanIndikator_id , $tahundata), request()->file('uploaddatafile'));
            TransaksiIndikator::updateOrCreate(
                ['id' => $turunanIndikator_id , 'tahundata' => $tahundata],
                ['status_entri' => 1]
            );

            //=============================================
            //Untuk Keperluan Presentasi Sementara
            //=============================================
            //Excel::import(new DataTmpl1Import($turunanIndikator_id , $tahundata), request()->file('uploaddatafile'));
            //=============================================
            //Untuk Keperluan Presentasi Sementara
            //=============================================
        }

        if($administrativeLevel == 2)
        {
            Excel::import(new DataTmpl2NewImport($turunanIndikator_id , $tahundata), request()->file('uploaddatafile'));
            TransaksiIndikator::updateOrCreate(
                ['id' => $turunanIndikator_id , 'tahundata' => $tahundata],
                ['status_entri' => 1]
            );

            //=============================================
            //Untuk Keperluan Presentasi Sementara
            //=============================================
            //Excel::import(new DataTmpl1Import($turunanIndikator_id , $tahundata), request()->file('uploaddatafile'));
            //=============================================
            //Untuk Keperluan Presentasi Sementara
            //=============================================
        }
        
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

}
