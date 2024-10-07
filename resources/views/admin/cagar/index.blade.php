@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data Cagar Budaya</h3>

            <div class="box-tools">
              <a href="/superadmin/cagar/create" class="btn btn-flat btn-sm btn-warning"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody>
              <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Cagar Budaya</th>
                <th>Kategori</th>
                <th>Jadwal</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td><img src="/storage/foto/{{$item->foto}}" width="150px"></td>
                <td>{{$item->nama}}</td>
                <td>{{$item->kategori == null ? null : $item->kategori->nama}}</td>
                <td>
                  Senin : {{$item->senin}}  <br/>
                  Selasa : {{$item->selasa}}<br/>
                  Rabu : {{$item->rabu}}<br/>
                  Kamis : {{$item->kamis}}<br/>
                  Jumat : {{$item->jumat}}<br/>
                  Sabtu : {{$item->sabtu}}<br/>
                  Minggu : {{$item->minggu}}
                </td>
                <td>
                  <a href="/superadmin/cagar/edit/{{$item->id}}" class="btn btn-flat btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/superadmin/cagar/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-danger" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
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
