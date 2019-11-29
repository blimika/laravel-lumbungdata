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

                <h4 class="mt-0 header-title">Kelola Master Subjek</h4><br/>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Subjek</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($msubjek as $subjek)
                        <tr>
                            <td>{{ $subjek->id }}</td>
                            <td>{{ $subjek->nama_subjek }}</td>
                            <td> 
                                <button class="btn btn-primary">Tambah</button>
                                <a class="btn btn-success" href="{{route('tabeldinamis.getSubjekForEdit', $subjek->id)}}" >Edit</a>
                                <a class="btn btn-danger" href="{{route('tabeldinamis.hapusSubjek', $subjek->id)}}">Hapus</a>
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
<div class="modal fade" id="tambahSubjekModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Subjek</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="tambahSubjekForm" action="{{route('tabeldinamis.addSubjek')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="tambahSubjekNamaSubjek">Subjek</label>
                <input type="text" class="form-control" id="tambahSubjekNamaSubjek" name="tambahSubjekNamaSubjek" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="editSubjekForEditModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Subjek</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="editSubjekForm" action="{{route('tabeldinamis.editSubjek')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="editSubjekNamaSubjek">Edit Subjek</label>
                <input type="text" class="form-control" id="editSubjekNamaSubjek" name="editSubjekNamaSubjek" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
      </div>

    </div>
  </div>
</div>

@endsection
