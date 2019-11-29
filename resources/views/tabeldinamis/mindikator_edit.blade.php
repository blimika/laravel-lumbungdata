@section('css')
<!-- DataTables -->
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }} " rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }} " rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function() {
    $('#editIndikatorSubjek').val(parseInt("{{$ind->msubjek_id}}"));
    $('#editIndikatorKarakteristik').val(parseInt("{{$ind->mkarakteristik_id}}"));
    $('#editIndikatorBaris').val(parseInt("{{$ind->mbaris_id}}"));
    $('#editIndikatorPeriode').val(parseInt("{{$ind->mperiode_id}}"));
    $('#editIndikatorSatuan').val(parseInt("{{$ind->msatuan_id}}"));
});
</script>
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

                <h4 class="mt-0 header-title">Edit Master Indikator</h4><br/>

                <form id="editIndikatorForm" action="{{route('tabeldinamis.editIndikator')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="editIndikatorIdIndikator">ID Indikator</label>
                        <input type="text" class="form-control" id="editIndikatorIdIndikator" name="editIndikatorIdIndikator" value="{{$ind->id}}" readOnly />
                    </div>

                    <div class="form-group">
                        <label for="editIndikatorNamaIndikator">Indikator</label>
                        <input type="text" class="form-control" id="editIndikatorNamaIndikator" name="editIndikatorNamaIndikator" value="{{$ind->nama_indikator}}" readOnly />
                    </div>

                    <div class="form-group">
                        <label for="editIndikatorSubjek">Subjek</label>
                        <select id="editIndikatorSubjek" name="editIndikatorSubjek" class="form-control">
                            @foreach($msubjek as $subjek)
                                <option value="{{ $subjek->id }}"> {{ $subjek->nama_subjek }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editIndikatorKarakteristik">Karakteristik</label>
                        <select id="editIndikatorKarakteristik" name="editIndikatorKarakteristik" class="form-control">
                            @foreach($mkarakteristik as $karakteristik)
                                <option value="{{ $karakteristik->id }}"> {{ $karakteristik->nama_karakteristik }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editIndikatorBaris">Judul Baris</label>
                        <select id="editIndikatorBaris" name="editIndikatorBaris" class="form-control">
                            @foreach($mbaris as $baris)
                                <option value="{{ $baris->id }}"> {{ $baris->nama_baris }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editIndikatorPeriode">Periode</label>
                        <select id="editIndikatorPeriode" name="editIndikatorPeriode" class="form-control">
                            @foreach($mperiode as $periode)
                                <option value="{{ $periode->id }}"> {{ $periode->nama_periode }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editIndikatorSatuan">Satuan</label>
                        <select id="editIndikatorSatuan" name="editIndikatorSatuan" class="form-control">
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
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection
