@section('css')

@stop

@section('js')
<script type="text/javascript">
    var rsText = "{{$itemskarakteristik}}";
    var text = rsText.replace(/&quot;/g, '\"');
    var obj = JSON.parse(text);
    var len = obj.length;

    for(var i=0; i < len; i++)
    {
        tambah_form_value(obj[i].no_urut, obj[i].nama_items);
    }
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

                <h4 class="mt-0 header-title">Edit Items Karakteristik</h4><br/>

                <form id="editKarakteristikForm" action="{{route('tabeldinamis.editItemsKarakteristik')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="editKarakteristikIDKarakteristik">ID Karakteristik</label>
                        <input type="text" class="form-control" id="editKarakteristikIDKarakteristik" name="editKarakteristikIDKarakteristik" value="{{$karakteristik->id}}" readOnly/>
                    </div>

                    <div class="form-group">
                        <label for="editKarakteristikNamaKarakteristik">Karakteristik</label>
                        <input type="text" class="form-control" id="editKarakteristikNamaKarakteristik" name="editKarakteristikNamaKarakteristik" value="{{$karakteristik->nama_karakteristik}}" readOnly/>
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
 
                        </table>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<script type="text/javascript">


function tambah_form(){
        //mencari element dengan id "formku" (yaitu table)
    var target=document.getElementById("editItemsKarakteristik");
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
    tambah.setAttribute('name','edititemskarakteristik[]');
}

function tambah_form_value(no_urut, text_value){
        //mencari element dengan id "formku" (yaitu table)
    var target=document.getElementById("editItemsKarakteristik");
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
    tambah.setAttribute('name','edititemskarakteristik['+no_urut+']');

    tambah.setAttribute('value',text_value);
}

function kurangi_form(){
        // mencari element dengan id="formku" yaitu table
    var target=document.getElementById("editItemsKarakteristik");
        // mendapatkan element terakhir dari <table> yaitu <tr> terakhir
    var akhir=target.lastChild;
        // menghapus <tr> terakhir beserta element2 didalamnya
    target.removeChild(akhir);
}
</script>

@endsection
