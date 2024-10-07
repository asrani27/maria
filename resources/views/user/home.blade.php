@extends('layouts.app2')
@push('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
crossorigin=""/>
<style>
  #map { height: 800px; }
</style>
@endpush
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-user"></i> Selamat Datang, {{Auth::user()->petugas->nama}}!</h4>
      di bawah ini adalah detail jadwal monitoring anda, silahkan klik tombol laporan untuk mengisi hasil monitoring anda pada cagar budaya
    </div>
      <div class="box box-danger">
        <div class="box-header">
          <i class="fa fa-users"></i><h3 class="box-title">Berikut Ini Jadwal Monitorig Anda</h3>

          <div class="box-tools">
            {{-- <a href="/user/sm/create" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-plus"></i> Input Data</a> --}}
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Nama Cagar</th>
              <th>Jumlah Pengunjung</th>
              <th>Foto Kondisi</th>
              <th>Ringkasan Laporan</th>
              <th>Aksi</th>
            </tr>
            @foreach ($data as $key=> $item)
                <tr>
                  <td>{{$key + 1}}</td>
                  <td>{{\Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y')}}</td>
                  <td>{{$item->cagar->nama}}</td>
                  <td>{{$item->pengunjung_pria}} pria | {{$item->pengunjung_wanita}} wanita</td>
                  <td><a href="/storage/foto/{{$item->foto}}" target="_blank"><img src="/storage/foto/{{$item->foto}}" width="100px"></a></td>
                  <td>{!!$item->hasil!!}</td>
                  <td>
                    <a href="/user/laporan/monitoring/{{$item->id}}" class="btn btn-sm btn-primary">Laporan</a>
                  </td>
                </tr>
            @endforeach
            
          </tbody>
        </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>


@endsection
@push('js')
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
crossorigin=""></script>
<script>
  var map = L.map('map').setView([-3.327460, 114.588515], 14);
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 24,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
</script>
@endpush
