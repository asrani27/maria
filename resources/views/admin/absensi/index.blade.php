@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data Absensi</h3>

            <div class="box-tools">
              <a href="/superadmin/absensi/create" class="btn btn-flat btn-sm btn-warning"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Cagar</th>
                <th>Petugas</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{\Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y')}}</td>
                <td>{{$item->cagar == null ? '': $item->cagar->nama}}</td>
                <td>{{$item->petugas == null ? '': $item->petugas->nama}}</td>
                <td>
                  <a href="/superadmin/absensi/edit/{{$item->id}}" class="btn btn-flat btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/superadmin/absensi/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-danger" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        {{$data->links()}}
        <!-- /.box -->
      </div>
</div>

@endsection
@push('js')

@endpush
