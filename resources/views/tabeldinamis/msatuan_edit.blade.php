@section('css')

@stop

@section('js')

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

                <h4 class="mt-0 header-title">Edit Master Satuan</h4><br/>

                <form action="{{route('tabeldinamis.editSatuan')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="msatuan_id"></label>
                        <input type="text" class="form-control" id="msatuan_id" name="msatuan_id" value="{{$satuan->id}}" readOnly/>
                    </div>

                    <div class="form-group">
                        <label for="msatuan_nama_satuan"></label>
                        <input type="text" class="form-control" id="msatuan_nama_satuan" name="msatuan_nama_satuan" value="{{$satuan->nama_satuan}}" />
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
