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
<script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/pages/datatables.init.js') }}"></script>  
@stop

@extends('layouts.horizontal')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Tabel Dinamis - Kelola Master Tabel</h4>
        </div>
    </div>
    <!-- end row -->
</div>

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <h4 class="mt-0 header-title">Kelola Master Indikator</h4><br/>

                <table id="datatable" class="table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Indikator</th>
                        <th>Subjek</th>
                        <th>Karakteristik</th>
                        <th>Judul Baris</th>
                        <th>Periode</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($mindikator as $indikator)
                        <tr>
                            <td>{{ $indikator->id }}</td>
                            <td>{{ $indikator->nama_indikator }}</td>
                            <td>{{ $indikator->Msubjek->nama_subjek }}</td>
                            <td>{{ $indikator->Mkarakteristik->nama_karakteristik }}</td>
                            <td>{{ $indikator->Mbaris->nama_baris }}</td>
                            <td>{{ $indikator->Mperiode->nama_periode }}</td>
                            <td>{{ $indikator->Msatuan->nama_satuan }}</td>
                            <td> 
                                <button class="btn btn-success" data-toggle="modal" data-target="#tambahIndikatorModal">Tambah</button>
                                <a class="btn btn-primary" href="{{route('tabeldinamis.getIndikatorForEdit', $indikator->id)}}" target="_blank">Edit</a>
                                <button class="btn btn-danger">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>


            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<!-- The Modal -->
<div class="modal fade" id="tambahIndikatorModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Indikator</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="tambahIndikatorForm" action="{{route('tabeldinamis.addIndikator')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="tambahIndikatorNamaIndikator">Indikator</label>
                <input type="text" class="form-control" id="tambahIndikatorNamaIndikator" name="tambahIndikatorNamaIndikator" />
            </div>

            <div class="form-group">
                <label for="tambahIndikatorSubjek">Subjek</label>
                <select id="tambahIndikatorSubjek" name="tambahIndikatorSubjek" class="form-control">
                    @foreach($msubjek as $subjek)
                        <option value="{{ $subjek->id }}"> {{ $subjek->nama_subjek }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tambahIndikatorKarakteristik">Karakteristik</label>
                <select id="tambahIndikatorKarakteristik" name="tambahIndikatorKarakteristik" class="form-control">
                    @foreach($mkarakteristik as $karakteristik)
                        <option value="{{ $karakteristik->id }}"> {{ $karakteristik->nama_karakteristik }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tambahIndikatorBaris">Judul Baris</label>
                <select id="tambahIndikatorBaris" name="tambahIndikatorBaris" class="form-control">
                    @foreach($mbaris as $baris)
                        <option value="{{ $baris->id }}"> {{ $baris->nama_baris }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tambahIndikatorPeriode">Periode</label>
                <select id="tambahIndikatorPeriode" name="tambahIndikatorPeriode" class="form-control">
                    @foreach($mperiode as $periode)
                        <option value="{{ $periode->id }}"> {{ $periode->nama_periode }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tambahIndikatorSatuan">Satuan</label>
                <select id="tambahIndikatorSatuan" name="tambahIndikatorSatuan" class="form-control">
                    @foreach($msatuan as $satuan)
                        <option value="{{ $satuan->id }}"> {{ $satuan->nama_satuan }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
      </div>

      <!-- Modal footer -->
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>
</div>

@endsection
