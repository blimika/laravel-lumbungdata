<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\IndikatorAPI;
use App\Mindikator;
use App\TransaksiIndikator;

class IndikatorAPIController extends Controller
{

    public function tampilkan(Request $request, $idIndikator) {
        $indikator = new IndikatorAPI();

        /*
        $rsIndikator = Mindikator::where('id', $idIndikator)->whereHas('TransaksiIndikator', function ($query){
            $query->where('status_tayang', '=', 1);
        })->first();
        */
        $rsIndikator = TransaksiIndikator::where('id',$idIndikator)->first();
        $indikator->id = $rsIndikator->id;
        $indikator->nama = $rsIndikator->nama_transaksi_indikator .' Tahun '. $rsIndikator->tahundata;
        $indikator->deskripsi = $rsIndikator->Mindikator->deskripsi_indikator;
        $indikator->keterangan = $rsIndikator->Mindikator->keterangan_indikator;
        $indikator->level_administrasi = $rsIndikator->madministrativelevel_id;
        //$rsSatuan = DB::table('msatuan')->where('id', $rsIndikator->msatuan_id)->first();
        $indikator->satuan = $rsIndikator->Mindikator->Msatuan->nama_satuan;

        $rsItemBaris = DB::table('mbarisitems')->select('no_urut as id', 'nama_items as nama')
            ->where('mbaris_id', $rsIndikator->Mindikator->mbaris_id)->orderBy('no_urut','asc')->get();
        // foreach ($rsItemBaris as $rsBaris) {
        //     $indikator->itemBaris[$rsBaris->no_urut] = $rsBaris->nama_items;
        // }
        $indikator->itemBaris = $rsItemBaris;

        $rsItemKarakteristik = DB::table('mkarakteristikitems')->select('no_urut as id', 'nama_items as nama', 'metadata_id as metadata')
            ->where('mkarakteristik_id', $rsIndikator->Mindikator->mkarakteristik_id)->orderBy('no_urut','asc')->get();
        // foreach ($rsItemKarakteristik as $rsKarakteristik) {
        //     $indikator->itemKarakteristik[$rsKarakteristik->no_urut] = $rsKarakteristik->nama_items;
        // }
        $indikator->itemKarakteristik = $rsItemKarakteristik;

        $rsItemWaktu = DB::table('mperiodewaktuitems')->select('no_urut as id', 'nama_items as nama')->where('mperiode_id', $rsIndikator->Mindikator->mperiode_id)->orderBy('no_urut','desc')->get();
        // foreach ($rsItemWaktu as $rsWaktu) {
        //     $indikator->itemWaktu[$rsWaktu->no_urut] = $rsWaktu->nama_items;
        // }
        $indikator->itemWaktu = $rsItemWaktu;
        if ($rsIndikator->madministrativelevel_id==1)
        {
            //datatmpl1new
            $rsItemTahun = DB::table('datatmpl1new')->distinct()->where('turunanindikator_id', $idIndikator)->limit(5)->orderBy('tahun', 'desc')->get('tahun');
            foreach ($rsItemTahun as $rsTahun) {
                $indikator->itemTahun[] = $rsTahun->tahun;
            }

            $rsData = DB::table('datatmpl1new')->
                select('tahun','nu_karakteristik','nu_baris','nu_periode','data')->
                where('turunanindikator_id', $idIndikator)->get();
            }
        else {
            //datatmpl2new
            $rsItemTahun = DB::table('datatmpl2new')->distinct()->where('turunanindikator_id', $idIndikator)->limit(5)->orderBy('tahun', 'desc')->get('tahun');
            foreach ($rsItemTahun as $rsTahun) {
                $indikator->itemTahun[] = $rsTahun->tahun;
            }

            $rsData = DB::table('datatmpl2new')->
                select('tahun','nu_karakteristik','nu_baris','nu_periode','data')->
                where('turunanindikator_id', $idIndikator)->get();
            
        }        

        $indikator->data = $rsData;

        return response()->json($indikator);
    }

    public function indikatorTerakhir(Request $request){
        $indikatorTerakhir = array();
        /*
        $rsIndikator = Mindikator::whereHas('TransaksiIndikator', function ($query){
            $query->where('status_tayang', '=', 1);
        })->orderBy('id', 'desc')->limit(7)->get(); */
        $rsIndikator = TransaksiIndikator::where('status_tayang',1)->orderBy('id', 'desc')->limit(9)->get();
        foreach ($rsIndikator as $latestIndikator) {
            $indikator = new IndikatorAPI();
            $indikator->id = $latestIndikator->id;
            $indikator->nama = $latestIndikator->nama_transaksi_indikator .' Tahun '. $latestIndikator->tahundata;
            $indikator->level_administrasi = $latestIndikator->madministrativelevel_id;

            array_push($indikatorTerakhir, $indikator);
        }

        return response()->json($indikatorTerakhir);
    }

    public function cari(Request $request){
        $rsHasilCari = [];

        $q = $request->get('q');
        if(strlen($q)>3){
            //$rsCari = DB::table('mindikator')->where('nama_indikator', 'like', '%'.$q.'%')->get();
            $rsCari = TransaksiIndikator::where('nama_transaksi_indikator','like', '%'.$q.'%')->get();
            foreach ($rsCari as $rsIndikator) {
                $indikator = new IndikatorAPI();
                $indikator->id = $rsIndikator->id;
                $indikator->nama = $rsIndikator->nama_transaksi_indikator .' Tahun '. $rsIndikator->tahundata;
                $indikator->satuan = $rsIndikator->Mindikator->Msatuan->nama_satuan;
                $indikator->level_administrasi = $rsIndikator->madministrativelevel_id;
                $rsHasilCari[] = $indikator;
            }
            
        } return response()->json($rsHasilCari);
        
    }

    public function semuaSubjek(Request $request) {
        $rsSemuaSubjek = DB::table('msubjek')->select('id', 'nama_subjek as nama')->get();
        return response()->json($rsSemuaSubjek);
    }

    public function tampilkanBySubjek(Request $request, $idSubjek) {
        //dd($idSubjek);
        $subjek = new Subjek();
        $subjek->id = $idSubjek;

        $rsSubjek = DB::table('msubjek')->where('id', $idSubjek)->first();
        $subjek->nama = $rsSubjek->nama_subjek;

        $indikatorTerakhir = array();

        /*
        $rsIndikator = Mindikator::where('msubjek_id', $idSubjek)->whereHas('TransaksiIndikator', function ($query){
            $query->where('status_tayang', '=', 1);
        })->orderBy('created_at', 'desc')->get(); 
        */
        $rsIndikator = TransaksiIndikator::where('status_tayang',1)->whereHas('Mindikator',function ($query) use($idSubjek){
            $query->where('msubjek_id',$idSubjek);
        })->orderBy('created_at', 'desc')->get();
        foreach ($rsIndikator as $latestIndikator) {
            $indikator = new IndikatorAPI();
            $indikator->id = $latestIndikator->id;
            $indikator->nama = $latestIndikator->nama_transaksi_indikator .' Tahun '. $latestIndikator->tahundata;
            $indikator->satuan = $latestIndikator->Mindikator->Msatuan->nama_satuan;
            $indikator->level_administrasi = $latestIndikator->madministrativelevel_id;
            array_push($indikatorTerakhir, $indikator);
        }

        $subjek->lisIndikator = $indikatorTerakhir;
        return response()->json($subjek);
    }

    public function lihatMetadata(Request $request, $idMetadata) {
        $rsMetadata = DB::table('metadata')->where('id', $idMetadata)->first();
        return response()->json($rsMetadata);
    }
}

class Subjek
{
    var $id;
    var $nama;
    var $lisIndikator = array();
}