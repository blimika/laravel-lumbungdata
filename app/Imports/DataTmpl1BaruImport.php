<?php

namespace App\Imports;

use App\DataTmpl1;
use App\Mindikator;
use App\Mbarisitems;
use App\Mkarakteristikitems;
use App\Mperiodeitems;
use App\TransaksiIndikator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DataTmpl1BaruImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $tid_indikator;
    private $ttahundata;
    private $tnu_baris;
    private $tnu_karakteristik;
    private $tnu_periode;

    private $max_baris;
    private $max_periode;
    private $max_karakteristik;

    public function __construct($id_indikator, $tahundata){

        $turunanIndikator = TransaksiIndikator::where('id', $id_indikator)->where('tahundata',$tahundata)->first();

        $indId = Mindikator::where('id', $turunanIndikator->mindikator_id)
                                ->get();

        $this->tid_indikator = $id_indikator;
        $this->ttahundata = $tahundata;

        $this->max_baris = Mbarisitems::where('mbaris_id', $indId[0]->mbaris_id)
                            ->max('no_urut');

        $this->max_karakteristik = Mkarakteristikitems::where('mkarakteristik_id', $indId[0]->mkarakteristik_id)
                            ->max('no_urut');

        $this->max_periode = Mperiodeitems::where('mperiode_id', $indId[0]->mperiode_id)
                            ->max('no_urut');

    }

    public function collection(Collection $rows)
    {
        $c_baris = 1;
        $idxCol = 1;

        for($baris=1; $baris < $this->max_baris+4; $baris++)
        {
            if($baris >= 4){
                for($kar=1; $kar <= $this->max_karakteristik; $kar++)
                {
                    for($per=1; $per <= $this->max_periode; $per++)
                    {

                        $isUpSuccess = DataTmpl1::updateOrCreate(
                            ['turunanindikator_id'=> $this->tid_indikator, 'tahun'=> $this->ttahundata,'nu_karakteristik'=> $kar,'nu_baris'=> $c_baris,'nu_periode'=> $per],
                            ['data' => $rows[$baris][$idxCol]]
                        );

                        $isUpSuccess->save();

                        $idxCol++;
                    }
                }
                
            }

            if($baris >= 4)
            {
                $c_baris++;
            }

            $idxCol = 1;
        }


    }
}
