<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Msubjek;
use App\Mindikator;
use App\Mkarakteristik;
use App\Mkarakteristikitems;
use App\Mbaris;
use App\Mbarisitems;
use App\Mperiode;
use App\Mperiodeitems;
use App\Msatuan;
use App\Mseriesleveltabel;
use App\TransaksiIndikator;
use App\User;
use App\AdministrativeLevel;
use App\Mtahundata;
use App\DataTmpl2New;
use App\DataTmpl1;
use App\DataTmpl1New;
use Session;

class TurunanIndikator extends Controller
{
    public function showMappingIndikator()
    {
        $mt_indikator = TransaksiIndikator::all();
        $mindikator = Mindikator::all();
        $administrativelevel = AdministrativeLevel::all();
        $tahun = Mtahundata::all();
        $muser = User::all();

        return view('tabeldinamis.maapingindikator', [
            'mt_indikator' => $mt_indikator,
            'mindikator' => $mindikator,
            'muser' => $muser,
            'administrativelevel' => $administrativelevel,
            'tahun' => $tahun,
            ]);
    }
    public function hapusmappingIndikator(Request $request)
    {
        //dd($request->all());
        //hapus ditabel transaksiindikator 
        //sesuai madministrativelevel_id
        //hapus ditabel sesuai level administrasi
        $dataIndikator = Transaksiindikator::where('id', '=', $request->trx_id)->count();
        if ($dataIndikator > 0) {
            
            $dataIndikator = Transaksiindikator::where('id', '=', $request->trx_id)->delete();
            /*
            if ($request->level_administrasi==1) {
                //tabel 1
                $dataLevelAdminis = DataTmpl1New::where('turunanindikator_id','=',$request->trx_id)->delete();
            } 
            else {
                //tabel 2
                $dataLevelAdminis = DataTmpl2New::where('turunanindikator_id','=',$request->trx_id)->delete();
            }
            */
            $dataLevelAdminis = DataTmpl1::where('turunanindikator_id','=',$request->trx_id)->delete();

            $pesan_error = "Mapping tabel berhasil di hapus";
            $warna_error = "primary";
        } else {
            //data tidak ada
            $pesan_error = "data tidak ada";
            $warna_error = "danger";
        }
        Session::flash('message', $pesan_error);
        Session::flash('message_type', $warna_error);
        return redirect()->route('tabeldinamis.showMappingIndikator');
    }
    public function mappingIndikator(Request $request)
    {
        $namaTurunanIndikator = $request->tambahMappingIndikatorNamaTurunanIndikator;
        $mindikator_id = $request->masterIndikator;
        $tahundata = $request->tahundata;
        $administrativeLevel = $request->administrativelevel;
        $produsendata = $request->produsendata;

        $isSuccessUpdateOrCreate = Transaksiindikator::updateOrCreate(
            ['nama_transaksi_indikator' => $namaTurunanIndikator, 'tahundata' => $tahundata,],[
            'mindikator_id' => $mindikator_id,
            'madministrativelevel_id' => $administrativeLevel,
            'user_id' => $produsendata,
            'tahundata' => $tahundata,
            ]
        );

        if($isSuccessUpdateOrCreate)
        {
            //Insert Into DataTmpl1 Table if Administrative Level of Tabel equals To 1
            /*
            if($administrativeLevel == 1)
            {
                $turunanIndikator = Transaksiindikator::where('nama_transaksi_indikator', $namaTurunanIndikator)->where('tahundata',$tahundata)->first();
                $mindikator = Mindikator::where('id', $turunanIndikator->mindikator_id)->first();
                $max_baris = Mbarisitems::where('mbaris_id', $mindikator->mbaris_id)->max('no_urut');
                $max_karakteristik = Mkarakteristikitems::where('mkarakteristik_id', $mindikator->mkarakteristik_id)->max('no_urut');
                $max_periode = Mperiodeitems::where('mperiode_id', $mindikator->mperiode_id)->max('no_urut');
                // dd($max_baris);

                $this->makeSkeleteonDataTmpl1($turunanIndikator->id, $tahundata, $max_baris, $max_karakteristik, $max_periode);
            }
    
            //Insert Into DataTmpl2 Table if Administrative Level of Tabel equals To 2
            if($administrativeLevel == 2)
            {
                // $baris_col = Transaksiindikator::where('nama_transaksi_indikator', $namaTurunanIndikator)->where('tahundata',$tahundata)->with('Mindikator.Mbaris.Mbarisitems')->first();
                // $max_baris = $baris_col->Mindikator->Mbaris->Mbarisitems->max('no_urut');
                // dd($max_baris);

                $turunanIndikator = Transaksiindikator::where('nama_transaksi_indikator', $namaTurunanIndikator)->where('tahundata',$tahundata)->first();
                $mindikator = Mindikator::where('id', $turunanIndikator->mindikator_id)->first();
                $max_baris = Mbarisitems::where('mbaris_id', $mindikator->mbaris_id)->max('no_urut');
                $max_karakteristik = Mkarakteristikitems::where('mkarakteristik_id', $mindikator->mkarakteristik_id)->max('no_urut');
                $max_periode = Mperiodeitems::where('mperiode_id', $mindikator->mperiode_id)->max('no_urut');
                // dd($max_baris);

                $this->makeSkeleteonDataTmpl2($turunanIndikator->id, $tahundata, $max_baris, $max_karakteristik, $max_periode);
            }
            */
            //dijadikan satu tabel saja
            $turunanIndikator = Transaksiindikator::where('nama_transaksi_indikator', $namaTurunanIndikator)->where('tahundata',$tahundata)->first();
                $mindikator = Mindikator::where('id', $turunanIndikator->mindikator_id)->first();
                $max_baris = Mbarisitems::where('mbaris_id', $mindikator->mbaris_id)->max('no_urut');
                $max_karakteristik = Mkarakteristikitems::where('mkarakteristik_id', $mindikator->mkarakteristik_id)->max('no_urut');
                $max_periode = Mperiodeitems::where('mperiode_id', $mindikator->mperiode_id)->max('no_urut');
                // dd($max_baris);

                $this->makeSkeleteonDataTmpl1Baru($turunanIndikator->id, $tahundata, $max_baris, $max_karakteristik, $max_periode);

        }

        $mt_indikator = TransaksiIndikator::all();
        $mindikator = Mindikator::all();
        $administrativelevel = AdministrativeLevel::all();
        $tahun = Mtahundata::all();
        $muser = User::all();

        // return view('tabeldinamis.maapingindikator', [
        //     'mt_indikator' => $mt_indikator,
        //     'mindikator' => $mindikator,
        //     'muser' => $muser,
        //     'administrativelevel' => $administrativelevel,
        //     'tahun' => $tahun,
        //     ]);

        return redirect()->route('tabeldinamis.showMappingIndikator', [
            'mt_indikator' => $mt_indikator,
            'mindikator' => $mindikator,
            'muser' => $muser,
            'administrativelevel' => $administrativelevel,
            'tahun' => $tahun,
            ]);
    }

    private function makeSkeleteonDataTmpl1($turunanindikator_id, $tahundata, $max_baris, $max_karakteristik, $max_periode)
    {
        for($baris=1; $baris <= $max_baris; $baris++)
        {
            for($karakteristik=1; $karakteristik <= $max_karakteristik; $karakteristik++)
            {
                for($periode=1; $periode <= $max_periode; $periode++)
                {
                    DataTmpl1New::firstOrCreate(
                        ['turunanindikator_id' => $turunanindikator_id, 
                        'nu_baris' => $baris,
                        'nu_karakteristik' => $karakteristik,
                        'nu_periode' => $periode,
                        'tahun' => $tahundata],
                        [
                            //No Value To Insert
                        ]
                    );
                }
            }
        }
    }

    private function makeSkeleteonDataTmpl2($turunanindikator_id, $tahundata, $max_baris, $max_karakteristik, $max_periode)
    {
        for($baris=1; $baris <= $max_baris; $baris++)
        {
            for($karakteristik=1; $karakteristik <= $max_karakteristik; $karakteristik++)
            {
                for($periode=1; $periode <= $max_periode; $periode++)
                {
                    DataTmpl2New::firstOrCreate(
                        ['turunanindikator_id' => $turunanindikator_id, 
                        'nu_baris' => $baris,
                        'nu_karakteristik' => $karakteristik,
                        'nu_periode' => $periode,
                        'tahun' => $tahundata],
                        [
                            //No Value To Insert
                        ]
                    );
                }
            }
        }
    }
    private function makeSkeleteonDataTmpl1Baru($turunanindikator_id, $tahundata, $max_baris, $max_karakteristik, $max_periode)
    {
        for($baris=1; $baris <= $max_baris; $baris++)
        {
            for($karakteristik=1; $karakteristik <= $max_karakteristik; $karakteristik++)
            {
                for($periode=1; $periode <= $max_periode; $periode++)
                {
                    DataTmpl1::firstOrCreate(
                        ['turunanindikator_id' => $turunanindikator_id, 
                        'nu_baris' => $baris,
                        'nu_karakteristik' => $karakteristik,
                        'nu_periode' => $periode,
                        'tahun' => $tahundata],
                        [
                            //No Value To Insert
                        ]
                    );
                }
            }
        }
    }
}
