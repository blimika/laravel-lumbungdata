@section('css')
<!-- DataTables -->
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }} " rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }} " rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('js')
@include('tabeldinamis.jsKarakteristik')
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

                <h4 class="mt-0 header-title">Kelola Master Karakteristik</h4><br/>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Karakteristik</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($mkarakteristik as $karakteristik)
                        <tr>
                            <td>{{ $karakteristik->id }}</td>
                            <td>{{ $karakteristik->nama_karakteristik }}</td>
                            <td> 
                                <button class="btn btn-success" data-toggle="modal" data-target="#tambahKarakteristikModal">Tambah</button>
                                <a class="btn btn-primary" href="{{route('tabeldinamis.getKarakteristikForEdit', $karakteristik->id)}}">Edit</a>
                                <a class="btn btn-danger" href="{{route('tabeldinamis.hapusKarakteristik', $karakteristik->id)}}">Hapus</a>
                                <!--<a href="" class="btn btn-info" data-toggle="modal" data-target="#itemKaViewModal" data-mkarid="{{ $karakteristik->id }}">View</a>-->
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
<div class="modal fade" id="tambahKarakteristikModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Karakteristik</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="tambahKarakteristikForm" action="{{route('tabeldinamis.addKarakteristik')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="tambahKarakteristikNamaKarakteristik">Karakteristik</label>
                <input type="text" class="form-control" id="tambahKarakteristikNamaKarakteristik" name="tambahKarakteristikNamaKarakteristik" />
            </div>

            <div class="form-group">

            </div>

            <div class="form-group">
                <label for="tambahItemsKarakteristik">Items Karakteristik</label>
                <div class="form-group">
                    <!-- apabila link "Add" diklik maka akan menjalankan function tambah_form -->
                    <a href='#' onclick="tambah_form(); return false;" class="btn btn-success">Add Items</a>
                    <!-- apabila link "Remove" diklik maka akan menjalankan function kurangi_form -->
                    <a href='#' onclick="kurangi_form(); return false;" class="btn btn-danger">Remove Items</a>
                </div>
                <table id="tambahItemsKarakteristik">
                    <tr>
                        <td>
                            <input type="text" name="itemskarakteristik[]"  class="form-control">
                        </td>
                    </tr>
                </table>
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

<!-- The Modal -->
<div class="modal fade" id="editKarakteristikModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Karakteristik</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="editKarakteristikForm" action="#" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="editKarakteristikIDKarakteristik">ID Karakteristik</label>
                <input type="text" class="form-control" id="editKarakteristikIDKarakteristik" name="editKarakteristikIDKarakteristik" />
            </div>

            <div class="form-group">
                <label for="editKarakteristikNamaKarakteristik">Karakteristik</label>
                <input type="text" class="form-control" id="editKarakteristikNamaKarakteristik" name="editKarakteristikNamaKarakteristik" />
            </div>

            <div class="form-group">

            </div>

            <div class="form-group">
                <label for="editItemsKarakteristik">Items Karakteristik</label>
                <div class="form-group">
                    <!-- apabila link "Add" diklik maka akan menjalankan function tambah_form -->
                    <a href='#' onclick="tambah_form(); return false;" class="btn btn-success">Add Items</a>
                    <!-- apabila link "Remove" diklik maka akan menjalankan function kurangi_form -->
                    <a href='#' onclick="kurangi_form(); return false;" class="btn btn-danger">Remove Items</a>
                </div>
                <table id="editItemsKarakteristik">
                    <tr>
                        <td>
                            <input type="text" name="edititemskarakteristik[]"  class="form-control">
                        </td>
                    </tr>
                </table>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
      </div>

    </div>
  </div>
</div>

<script>
function tambah_form(){
        //mencari element dengan id "formku" (yaitu table)
    var target=document.getElementById("tambahItemsKarakteristik");
        // membuat element <tr>
    var tabel_row=document.createElement("tr");
        // membuat element <td>
    var tabel_col=document.createElement("td");
        // membuat element input untuk menambah form inputan
    var tambah=document.createElement("input");
        // menambahkan element <tr> pada tag table
    target.appendChild(tabel_row);
        // menambahkan element <td> pada tag <tr>
    tabel_row.appendChild(tabel_col);
        // menambahkan element input pada tag <td>
    tabel_col.appendChild(tambah);
        // kemudian memberikan attribute type="text" untuk form inputan
    tambah.setAttribute('type','text');
        // kemudian memberikan attribute type="class" untuk form inputan
    tambah.setAttribute('class','form-control');
        // lalu memberikan attribute name="inputan[]" untuk form inputan
    tambah.setAttribute('name','itemskarakteristik[]');
}

function kurangi_form(){
        // mencari element dengan id="formku" yaitu table
    var target=document.getElementById("tambahItemsKarakteristik");
        // mendapatkan element terakhir dari <table> yaitu <tr> terakhir
    var akhir=target.lastChild;
        // menghapus <tr> terakhir beserta element2 didalamnya
    target.removeChild(akhir);
}
</script>
<!--modal view-->
<div id="itemKaViewModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="itemKaViewModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Items Karakteristik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table" id="tabelitemkar">
                        <thead>
                            <tr>
                                <th width="7%">#</th>
                                <th>Nama Karakteristik</th>
                                <th>Items</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--batas modal view-->
@endsection
