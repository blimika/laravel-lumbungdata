<form action="{{route('tabeldinamis.inputtabeldinamis')}}" method="GET" class="form-horizontal">
    <div class="form-group row">
        <label class="control-label text-right col-md-1">Filter</label>
        <div class="col-md-3">
            <select name="msubjek" id="msubjek" class="form-control">
             <option value="">Pilih Subyek</option>
             @foreach ($dataSubjek as $item)
                <option value="{{$item->id}}" @if (request('msubjek')==$item->id) selected @endif>{{$item->nama_subjek}}</option>
             @endforeach
            </select>
         </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success">Filter</button>
        </div>
    </div>
</form>