@extends('layouts.app')
@push('css')
    
<link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Laporan</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <a href="/superadmin/laporan/absensi" class="btn btn-md btn-success" target="_blank">LAPORAN ABSENSI</a>
            <a href="/superadmin/laporan/cagar" class="btn btn-md btn-success" target="_blank">LAPORAN CAGAR BUDAYA</a>
            <a href="/superadmin/laporan/jadwal" class="btn btn-md btn-success" target="_blank">LAPORAN JADWAL MONITORING</a>
            <a href="/superadmin/laporan/hasil" class="btn btn-md btn-success" target="_blank">LAPORAN HASIL MONITORING</a>
            <a href="/superadmin/laporan/pengunjung" class="btn btn-md btn-success" target="_blank">LAPORAN PENGUNJUNG</a>
            {{-- <form method="get" action="/laporan/print" target="_blank">
              @csrf
              <select name="kelurahan_id" class="form-control select2" required>
                <option value="">-pilih-</option>
                @foreach ($kelurahan as $item)
                    <option value="{{$item->id}}">{{$item->nama}}</option>
                @endforeach
              </select>
              <br/>
              <br/>
              <input type="text" name="rt" class="form-control" required  onkeypress="return hanyaAngka(event)" placeholder="no RT">
              <br/>
              <button type="submit" class='btn btn-primary btn-flat' target="_blank"><i class="fa fa-print"></i> Print</button>
            </form> --}}
          </div>
          <!-- /.box-body -->
        </div>
        
        <!-- /.box -->
      </div>
</div>
@endsection
@push('js')

<script src="/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    });
</script>
<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
</script>
@endpush
