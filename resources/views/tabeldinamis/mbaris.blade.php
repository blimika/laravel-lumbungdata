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

                <h4 class="mt-0 header-title">Kelola Master Judul Baris</h4><br/>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Judul Baris</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($mbaris as $baris)
                        <tr>
                            <td>{{ $baris->id }}</td>
                            <td>{{ $baris->nama_baris }}</td>
                            <td> 
                                <button class="btn btn-success" data-toggle="modal" data-target="#tambahBarisModal">Tambah</button>
                                <a class="btn btn-primary" href="{{route('tabeldinamis.getBarisForEdit', $baris->id)}}">Edit</a>
                                <a class="btn btn-danger" href="{{route('tabeldinamis.hapusBaris', $baris->id)}}">Hapus</a>
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
<div class="modal fade" id="tambahBarisModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Baris</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="tambahBarisForm" action="{{route('tabeldinamis.addBaris')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="tambahBarisNamaBaris">Baris</label>
                <input type="text" class="form-control" id="tambahBarisNamaBaris" name="tambahBarisNamaBaris" />
            </div>

            <div class="form-group">

            </div>

            <div class="form-group">
                <label for="tambahItemsBaris">Items Baris</label>
                <div class="form-group">
                    <!-- apabila link "Add" diklik maka akan menjalankan function tambah_form -->
                    <a href='#' onclick="tambah_form(); return false;" class="btn btn-success">Add Items</a>
                    <!-- apabila link "Remove" diklik maka akan menjalankan function kurangi_form -->
                    <a href='#' onclick="kurangi_form(); return false;" class="btn btn-danger">Remove Items</a>
                </div>
                <table id="tambahItemsBaris">
                    <tr>
                        <td>
                            <input type="text" name="itemsbaris[]"  class="form-control">
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

<script>
function tambah_form(){
        //mencari element dengan id "formku" (yaitu table)
    var target=document.getElementById("tambahItemsBaris");
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
    tambah.setAttribute('name','itemsbaris[]');
}

function kurangi_form(){
        // mencari element dengan id="formku" yaitu table
    var target=document.getElementById("tambahItemsBaris");
        // mendapatkan element terakhir dari <table> yaitu <tr> terakhir
    var akhir=target.lastChild;
        // menghapus <tr> terakhir beserta element2 didalamnya
    target.removeChild(akhir);
}
</script>
@endsection
