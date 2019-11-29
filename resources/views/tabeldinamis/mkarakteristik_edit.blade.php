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

                <h4 class="mt-0 header-title">Edit Karakteristik</h4><br/>

                <form id="editKarakteristikForm" action="{{route('tabeldinamis.editKarakteristik')}}" method="post" enctype="multipart/form-data">
                @csrf

                    <div class="form-group">
                        <label for="editKarakteristikIDKarakteristik">ID Karakteristik</label>
                        <input type="text" class="form-control" id="editKarakteristikIDKarakteristik" name="editKarakteristikIDKarakteristik" value="{{$karakteristik->id}}" readOnly />
                    </div>

                    <div class="form-group">
                        <label for="editKarakteristikNamaKarakteristik">Karakteristik</label>
                        <input type="text" class="form-control" id="editKarakteristikNamaKarakteristik" name="editKarakteristikNamaKarakteristik" value="{{$karakteristik->nama_karakteristik}}" />
                    </div>

                    <div class="form-group">
                        <a class="btn btn-success" href="{{route('tabeldinamis.getItemsKarakteristikForEdit', $karakteristik->id)}}">Edit Items Karakteristik</a>
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
