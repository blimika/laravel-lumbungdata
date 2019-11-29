@section('css')
<!-- DataTables -->
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }} " rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }} " rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('js')
<!-- Required datatable js -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Responsive examples -->
<script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script> 

<!-- Datatable init js -->
<script src="{{ asset('assets/pages/datatables.init.js') }}"></script>  

<!-- Input Tabel Dinamis -->
<!-- <script src="{{ asset('js/tabeldinamis/inputtabeldinamis.js') }}"></script>   -->
@stop

@if($madministrativelevel_id == 1)
    @inject('data', 'App\DataTmpl1New')
@endif

@if($madministrativelevel_id == 2)

    @inject('data', 'App\DataTmpl2New')
@endif



@extends('layouts.horizontal')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Tabel Dinamis - View Uploaded Data</h4>
        </div>
    </div>
    <!-- end row -->
</div>

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <h4 class="mt-0 header-title">View Uploaded Data</h4><br/>
                <div class="table-responsive">
                    <table style="text-align:center" class="table table-bordered">
                        <thead >
                        <tr>
                            <th rowspan="4" style="text-align:center">{{$judul_baris}}</th>
                            <th colspan="{{$max_karakteristik*$max_periode}}" style="text-align:center">{{$tahun}}</th>
                        </tr>
                        <tr>
                            <th colspan="{{$max_karakteristik*$max_periode}}" style="text-align:center">{{$nama_indikator}}</th>
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
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
