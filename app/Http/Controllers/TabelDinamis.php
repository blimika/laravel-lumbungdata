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

class TabelDinamis extends Controller
{
    public function showMsubjek()
    {
        $msubjek = Msubjek::all();
        return view('tabeldinamis.msubjek', ['msubjek' => $msubjek]);
    }

    public function getSubjekForEdit($id)
    {
        $subjek = Msubjek::find($id);
        return view('tabeldinamis.msubjek_edit', ['subjek' => $subjek]);
    }

    public function showMindikator()
    {
        $msubjek = Msubjek::all();
        $mindikator = Mindikator::all();
        $mkarakteristik = Mkarakteristik::all();
        $mbaris = Mbaris::all();
        $mperiode = Mperiode::all();
        $msatuan = Msatuan::all();

        return view('tabeldinamis.mindikator', 
                    [
                        'msubjek' => $msubjek,
                        'mindikator' => $mindikator,
                        'mkarakteristik' => $mkarakteristik,
                        'mbaris' => $mbaris,
                        'mperiode' => $mperiode,
                        'msatuan' => $msatuan,
                    ]);
    }

    public function getIndikatorForEdit($id)
    {
        $ind = Mindikator::find($id);
        $msubjek = Msubjek::all();
        $mindikator = Mindikator::all();
        $mkarakteristik = Mkarakteristik::all();
        $mbaris = Mbaris::all();
        $mperiode = Mperiode::all();
        $msatuan = Msatuan::all();

        return view('tabeldinamis.mindikator_edit', 
                    [
                        'msubjek' => $msubjek,
                        'mindikator' => $mindikator,
                        'mkarakteristik' => $mkarakteristik,
                        'mbaris' => $mbaris,
                        'mperiode' => $mperiode,
                        'msatuan' => $msatuan,
                        'ind' => $ind,
                    ]);
    }

    public function showMkarakteristik()
    {
        $mkarakteristik = Mkarakteristik::all();
        return view('tabeldinamis.mkarakteristik', ['mkarakteristik' => $mkarakteristik]);
    }

    public function getKarakteristikForEdit($id)
    {
        $karakteristik = Mkarakteristik::find($id);
        return view('tabeldinamis.mkarakteristik_edit', ['karakteristik' => $karakteristik]);
    }

    public function getItemsKarakteristikForEdit($id)
    {
        $karakteristik = Mkarakteristik::find($id);
        $itemsKarakteristik = Mkarakteristikitems::where('mkarakteristik_id', $id)->get()->toJson();

        return view('tabeldinamis.mkarakteristik_edit_items', ['karakteristik' => $karakteristik, 'itemskarakteristik' => $itemsKarakteristik]);
    }

    public function showMbaris()
    {
        $mbaris = Mbaris::all();
        return view('tabeldinamis.mbaris', ['mbaris' => $mbaris]);
    }

    public function getBarisForEdit($id)
    {
        $baris = Mbaris::find($id);
        return view('tabeldinamis.mbaris_edit', ['baris' => $baris]);
    }

    public function getItemsBarisForEdit($id)
    {
        $baris = Mbaris::find($id);
        $itemsBaris = Mbarisitems::where('mbaris_id', $id)->get()->toJson();

        return view('tabeldinamis.mbaris_edit_items', ['baris' => $baris, 'itemsbaris' => $itemsBaris]);
    }

    public function showMperiode()
    {
        $mperiode = Mperiode::all();
        return view('tabeldinamis.mperiode', ['mperiode' => $mperiode]);
    }

    public function getPeriodeForEdit($id)
    {
        $periode = Mperiode::find($id);
        return view('tabeldinamis.mperiode_edit', ['periode' => $periode]);
    }

    public function getItemsPeriodeForEdit($id)
    {
        $periode = Mperiode::find($id);
        $itemsPeriode = Mperiodeitems::where('mperiode_id', $id)->get()->toJson();

        return view('tabeldinamis.mperiode_edit_items', ['periode' => $periode, 'itemsperiode' => $itemsPeriode]);
    }

    public function showMsatuan()
    {
        $msatuan = Msatuan::all();
        return view('tabeldinamis.msatuan', ['msatuan' => $msatuan]);
    }

    public function getSatuanForEdit($id)
    {
        $satuan = Msatuan::find($id);
        return view('tabeldinamis.msatuan_edit', ['satuan' => $satuan]);
    }

    public function addSubjek(Request $request)
    {
        $nama_subjek = $request->tambahSubjekNamaSubjek;
        $isInsertSuccess = Msubjek::firstOrCreate(
            ['nama_subjek' => $nama_subjek]
        );

        $msubjek = Msubjek::all();
        // return view('tabeldinamis.msubjek', ['msubjek' => $msubjek]);

        return redirect()->route('tabeldinamis.msubjek', ['msubjek' => $msubjek]);
    }

    public function editSubjek(Request $request)
    {
        $msubjek_id = $request->msubjek_id;
        $msubjek_nama_subjek = $request->msubjek_nama_subjek;

        Msubjek::updateOrCreate(
            ['id' => $msubjek_id],
            ['nama_subjek' => $msubjek_nama_subjek]
        );

        return redirect()->route('tabeldinamis.msubjek');
    }

    public function hapusSubjek($id)
    {
        Msubjek::where('id', $id)->delete();
        return redirect()->route('tabeldinamis.msubjek');
    }

    public function addIndikator(Request $request)
    {
        $nama_indikator = $request->tambahIndikatorNamaIndikator;
        $msubjek_id = $request->tambahIndikatorSubjek;
        $mkarakteristik_id = $request->tambahIndikatorKarakteristik;
        $mbaris_id = $request->tambahIndikatorBaris;
        $mperiode_id = $request->tambahIndikatorPeriode;
        $msatuan_id = $request->tambahIndikatorSatuan;

        $isInsertSuccess = Mindikator::firstOrCreate(
            ['nama_indikator' => $nama_indikator],
            ['msubjek_id' => $msubjek_id , 
            'mkarakteristik_id' => $mkarakteristik_id, 
            'mbaris_id' => $mbaris_id, 
            'mperiode_id' => $mperiode_id, 
            'msatuan_id' => $msatuan_id,
            ]
        );

        $msubjek = Msubjek::all();
        $mindikator = Mindikator::all();
        $mkarakteristik = Mkarakteristik::all();
        $mbaris = Mbaris::all();
        $mperiode = Mperiode::all();
        $msatuan = Msatuan::all();

        // return view('tabeldinamis.mindikator', 
        //             [
        //                 'msubjek' => $msubjek,
        //                 'mindikator' => $mindikator,
        //                 'mkarakteristik' => $mkarakteristik,
        //                 'mbaris' => $mbaris,
        //                 'mperiode' => $mperiode,
        //                 'msatuan' => $msatuan,
        //             ]);

        return redirect()->route('tabeldinamis.mindikator', 
        [
            'msubjek' => $msubjek,
            'mindikator' => $mindikator,
            'mkarakteristik' => $mkarakteristik,
            'mbaris' => $mbaris,
            'mperiode' => $mperiode,
            'msatuan' => $msatuan,
        ]);

    }

    public function editIndikator(Request $request)
    {
        $id_indikator = $request->editIndikatorIdIndikator;
        $nama_indikator = $request->editIndikatorNamaIndikator;
        $msubjek_id = $request->editIndikatorSubjek;
        $mkarakteristik_id = $request->editIndikatorKarakteristik;
        $mbaris_id = $request->editIndikatorBaris;
        $mperiode_id = $request->editIndikatorPeriode;
        $msatuan_id = $request->editIndikatorSatuan;

        $isInsertSuccess = Mindikator::updateOrCreate(
            ['id' => $id_indikator],
            ['msubjek_id' => $msubjek_id , 
            'nama_indikator' => $nama_indikator,
            'mkarakteristik_id' => $mkarakteristik_id, 
            'mbaris_id' => $mbaris_id, 
            'mperiode_id' => $mperiode_id, 
            'msatuan_id' => $msatuan_id,
            ]
        );

        $msubjek = Msubjek::all();
        $mindikator = Mindikator::all();
        $mkarakteristik = Mkarakteristik::all();
        $mbaris = Mbaris::all();
        $mperiode = Mperiode::all();
        $msatuan = Msatuan::all();

        return redirect()->route('tabeldinamis.mindikator', 
        [
            'msubjek' => $msubjek,
            'mindikator' => $mindikator,
            'mkarakteristik' => $mkarakteristik,
            'mbaris' => $mbaris,
            'mperiode' => $mperiode,
            'msatuan' => $msatuan,
        ]);
    }

    public function addKarakteristik(Request $request)
    {
        $nama_karakteristik = $request->tambahKarakteristikNamaKarakteristik;
        $items_karakteristik = $request->itemskarakteristik;

        Mkarakteristik::firstOrCreate(
            ["nama_karakteristik" => $nama_karakteristik]
        );

        $id_karakteristik = Mkarakteristik::where('nama_karakteristik', $nama_karakteristik)->first();

        for($x=0; $x < count($items_karakteristik); $x++)
        {
            Mkarakteristikitems::insert(
                ['no_urut' => $x+1, 'nama_items' => $items_karakteristik[$x], 'mkarakteristik_id'=>$id_karakteristik->id]
            );
        }

        $mkarakteristik = Mkarakteristik::all();

        return redirect()->route('tabeldinamis.mkarakteristik', ['mkarakteristik' => $mkarakteristik]);
        
    }

    public function editKarakteristik(Request $request)
    {
        $edit_id_karakteristik = $request->editKarakteristikIDKarakteristik;
        $edit_items_karakteristik = $request->editKarakteristikNamaKarakteristik;

        Mkarakteristik::updateOrCreate(
            ['id' => $edit_id_karakteristik],
            [
                'nama_karakteristik' => $edit_items_karakteristik
            ]
        );

        $mkarakteristik = Mkarakteristik::all();
        return view('tabeldinamis.mkarakteristik', ['mkarakteristik' => $mkarakteristik]);
    }

    public function hapusKarakteristik($id)
    {
        Mkarakteristik::where('id', $id)->delete();
        Mkarakteristikitems::where('id', $id)->delete();

        $mkarakteristik = Mkarakteristik::all();
        return view('tabeldinamis.mkarakteristik', ['mkarakteristik' => $mkarakteristik]);
    }

    public function editItemsKarakteristik(Request $request)
    {
        $edit_id_karakteristik = $request->editKarakteristikIDKarakteristik;
        $edit_items_karakteristik = $request->edititemskarakteristik;

        //Delete Old Items
        Mkarakteristikitems::where('mkarakteristik_id', $edit_id_karakteristik)->delete();

        //Add New Items Karakteristik
        foreach($edit_items_karakteristik as $key => $items)
        {
            Mkarakteristikitems::updateOrCreate(
                ['mkarakteristik_id' => $edit_id_karakteristik, 'no_urut' => $key, 'nama_items'=>$items],
                [
                    //NO VALUE TO UPDATE
                ]
            );
        }

        $mkarakteristik = Mkarakteristik::all();

        return redirect()->route('tabeldinamis.mkarakteristik', ['mkarakteristik' => $mkarakteristik]);
        
    }

    public function addBaris(Request $request)
    {
        $nama_baris = $request->tambahBarisNamaBaris;
        $items_baris = $request->itemsbaris;

        Mbaris::firstOrCreate(
            ["nama_baris" => $nama_baris]
        );

        $id_baris = Mbaris::where('nama_baris', $nama_baris)->first();

        for($x=0; $x < count($items_baris); $x++)
        {
            Mbarisitems::insert(
                ['no_urut' => $x+1, 'nama_items' => $items_baris[$x], 'mbaris_id'=>$id_baris->id]
            );
        }

        $mbaris = Mbaris::all();
        // return view('tabeldinamis.mbaris', ['mbaris' => $mbaris]);

        return redirect()->route('tabeldinamis.mbaris', ['mbaris' => $mbaris]);
    }

    public function editBaris(Request $request)
    {
        $edit_id_baris = $request->editBarisIDBaris;
        $edit_items_baris = $request->editBarisNamaBaris;

        Mbaris::updateOrCreate(
            ['id' => $edit_id_baris],
            [
                'nama_baris' => $edit_items_baris
            ]);

        $mbaris = Mbaris::all();
        return view('tabeldinamis.mbaris', ['mbaris' => $mbaris]);
    }

    public function hapusBaris($id)
    {
        Mbaris::where('id', $id)->delete();
        Mbarisitems::where('mbaris_id', $id)->delete();

        $mbaris = Mbaris::all();
        return view('tabeldinamis.mbaris', ['mbaris' => $mbaris]);
    }

    public function editItemsBaris(Request $request)
    {
        $edit_id_baris = $request->editBarisIDBaris;
        $edit_items_baris = $request->edititemsbaris;

        //Delete Old Items
        Mbarisitems::where('mbaris_id', $edit_id_baris )->delete();

        //Add New Items Baris
        foreach($edit_items_baris as $key => $items)
        {
            Mbarisitems::updateOrCreate(
                ['mbaris_id' => $edit_id_baris, 'no_urut' => $key, 'nama_items'=>$items],
                [
                    //NO VALUE TO UPDATE
                ]
            );
        }

        $mbaris = Mbaris::all();
        return redirect()->route('tabeldinamis.mbaris', ['mbaris' => $mbaris]);
        
    }

    public function addPeriode(Request $request)
    {
        $nama_periode = $request->tambahPeriodeNamaPeriode;
        $items_periode = $request->itemsperiode;

        Mperiode::firstOrCreate(
            ["nama_periode" => $nama_periode]
        );

        $id_periode = Mperiode::where('nama_periode', $nama_periode)->first();

        for($x=0; $x < count($items_periode); $x++)
        {
            Mperiodeitems::insert(
                ['no_urut' => $x+1, 'nama_items' => $items_periode[$x], 'mperiode_id'=>$id_periode->id]
            );
        }

        $mperiode = Mperiode::all();
        // return view('tabeldinamis.mperiode', ['mperiode' => $mperiode]);

        return redirect()->route('tabeldinamis.mperiode', ['mperiode' => $mperiode]);
    }

    public function editPeriode(Request $request)
    {
        $edit_id_periode = $request->editPeriodeIDPeriode;
        $edit_items_periode = $request->editPeriodeNamaPeriode;

        Mperiode::updateOrCreate(
            ['id' => $edit_id_periode],
            [
                'nama_periode' => $edit_items_periode
            ]
        );

        $mperiode = Mperiode::all();
        return view('tabeldinamis.mperiode', ['mperiode' => $mperiode]);
    }

    public function hapusPeriode($id)
    {
        Mperiode::where('id',$id)->delete();
        Mperiodeitems::where('mperiode_id', $id)->delete();

        $mperiode = Mperiode::all();
        return view('tabeldinamis.mperiode', ['mperiode' => $mperiode]);
    }

    public function editItemsPeriode(Request $request)
    {
        $edit_id_periode = $request->editPeriodeIDPeriode;
        $edit_items_periode = $request->edititemsperiode;

        //Delete Old Items
        Mperiodeitems::where('mperiode_id', $edit_id_periode)->delete();

        //Add New Items Periode
        foreach($edit_items_periode as $key => $items)
        {
            Mperiodeitems::updateOrCreate(
                ['mperiode_id' => $edit_id_periode, 'no_urut' => $key, 'nama_items'=>$items],
                [
                    //NO VALUE TO UPDATE
                ]
            );
        }

        $mperiode = Mperiode::all();

        return redirect()->route('tabeldinamis.mperiode', ['mperiode' => $mperiode]);
        
    }

    public function addSatuan(Request $request)
    {
        $nama_satuan = $request->tambahSatuanNamaSatuan;

        Msatuan::firstOrCreate(
            ["nama_satuan" => $nama_satuan]
        );

        $msatuan = Msatuan::all();
        // return view('tabeldinamis.msatuan', ['msatuan' => $msatuan]);

        return redirect()->route('tabeldinamis.msatuan', ['msatuan' => $msatuan]);
    }

    public function editSatuan(Request $request)
    {
        $msatuan_id = $request->msatuan_id;
        $msatuan_nama_satuan = $request->msatuan_nama_satuan;

        Msatuan::updateOrCreate(
            ['id' => $msatuan_id],
            ['nama_satuan' => $msatuan_nama_satuan]
        );

        return redirect()->route('tabeldinamis.msatuan');
    }

    public function hapusSatuan($id)
    {
        Msatuan::where('id', $id)->delete();
        return redirect()->route('tabeldinamis.msatuan');
    }

    //show item karakteristik
    public function showItemsKarakteristik($id)
    {
        $count = Mkarakteristikitems::where('mkarakteristik_id','=',$id)->count();
        $arr = array('hasil' => 'Data tidak tersedia', 'status' => false);
        if ($count>0) {
            //items ada
            $dataItemKarakteristik = Mkarakteristikitems::where('mkarakteristik_id','=',$id)->get();
            $i=1;
            $arrItem = array();
            foreach ($dataItemKarakteristik as $item) {
                $arrItem[] = array(
                    'urutan' => $i,
                    'id' => $item->id,
                    'no_urut' => $item->no_urut,
                    'nama_items' => $item->nama_items,
                    'mkarakteristik_id' => $item->mkarakteristik_id,
                    'metadata_id' => $item->metadata_id,
                    'nama_karakteristik' => $item->Mkarakteristik->nama_karakteristik
                );
                $i++;
            }
            $arr = array(
                'jumlah_item' => $i-1,
                'hasil' => $arrItem, 
                'status' => true
            );
        }
        return Response()->json($arr);
    }

}
