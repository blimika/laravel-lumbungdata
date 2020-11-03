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

@extends('layouts.horizontal')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Tabel Dinamis - Input Data Tabel</h4>
        </div>
    </div>
    <!-- end row -->
</div>

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                @include('tabeldinamis.filterindikator')
                <h4 class="mt-0 header-title">Pilih Indikator</h4><br/>

                <table id="datatable" class="table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Turunan Indikator</th>
                        <th>Tahun Data</th>
                        <th>Master Indikator</th>
                        <th>Status Tayang</th>
                        <th>Status Entri</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($turunanIndikator as $tindikator)
                        <tr>
                            <td>{{ $tindikator->id }}</td>
                            <td>{{ $tindikator->nama_transaksi_indikator }}</td>
                            <td>{{ $tindikator->tahundata}}</td>
                            <td>{{ $tindikator->Mindikator->nama_indikator }}</td>
                            <td>
                                @if($tindikator->status_tayang == '0')
                                <span class="badge badge-pill badge-danger">Turun Tayang</span>
                                @else
                                <span class="badge badge-pill badge-success">Tayang</span>
                                @endif
                            </td>
                            <td>
                                @if($tindikator->status_entri == '0')
                                <span class="badge badge-pill badge-danger">Belum Entri</span>
                                @else
                                <span class="badge badge-pill badge-success">Sudah Entri</span>
                                @endif
                            </td>
                            <td> 
                                <a href="{{route('tabeldinamis.getDataIndikator', $tindikator->id)}}" class="btn btn-primary" target="_blank">Entri Data</a>
                                @if($tindikator->status_tayang == '0')
                                    <a href="{{ route('tabeldinamis.setTayangkan', $tindikator->id) }}" class="btn btn-success my-1" target="_self">Tayangkan</a>
                                @else
                                    <a href="{{ route('tabeldinamis.setTurunTayang', $tindikator->id) }}" class="btn btn-danger my-1" target="_self">Turun Tayang</a>
                                @endif
                                
                            </td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
