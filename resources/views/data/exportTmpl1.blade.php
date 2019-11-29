@inject('indikator', 'App\Mindikator')
@inject('data', 'App\DataTmpl1')
<table style="text-align:center">
    <thead >
    <tr>
        <th rowspan="4" style="text-align:center">Kabupaten/Kota</th>
        <th colspan="{{$max_karakteristik*$max_periode}}" style="text-align:center">2011</th>
    </tr>
    <tr>
        <th colspan="{{$max_karakteristik*$max_periode}}" style="text-align:center">Luas Lahan Tanam Menurut Jenis Sawah</th>
    </tr>
    <tr>
        @foreach($karakteristikitems as $kitems)
            <th colspan="{{$max_periode}}" style="text-align:center">{{$kitems->nama_items}}</th>
        @endforeach
    </tr>
    <tr>
        @php
            for($x=0; $x < $max_karakteristik; $x++)
            {
                for($y=0; $y < $max_periode; $y++)
                {
                    echo "<th style='text-align:center'>".$periodeitems[$y]->nama_items."</th>";
                }
            }
        @endphp
        
    </tr>
    </thead>
    <tbody>
            @php
            $vData = "";
            $tData = "";
            for($b=0; $b < $max_baris; $b++)
            {
                echo '<tr>';
                echo '<td>'.$barisitems[$b]->nama_items.'</td>';

                for($k=0; $k < $max_karakteristik; $k++)
                {
                    for($p=0; $p < $max_periode; $p++)
                    {
                        $tData  = $data->where("turunanindikator_id", $id_indikator)
                                        ->where("tahun", $tahun)
                                        ->where("nu_baris", $b+1)
                                        ->where("nu_karakteristik", $k+1)
                                        ->where("nu_periode", $p+1)
                                        ->select("data")
                                        ->first();
                                            
                        if($tData == null)
                        {
                            $vData = "N/A";
                        }else{
                            $vData = $tData->data;
                        }

                        echo '<td>'.$vData.'</td>';
                    }
                }
                echo '</tr>';
            }
            @endphp
    </tbody>
</table>