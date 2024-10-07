@extends('layouts.app')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/user" class="btn btn-flat btn-warning"><i class="fa fa-backward"></i> Kembali</a> <br /><br />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Laporan Monitoring</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/user/laporan/monitoring/{{$data->id}}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" value="{{\Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y')}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Cagar Budaya</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" value="{{$data->cagar->nama}}" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pengunjung</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="pengunjung_pria" placeholder="pria" value="{{$data->pengunjung_pria}}"  onkeypress="return hanyaAngka(event)" required>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="pengunjung_wanita" placeholder="wanita" value="{{$data->pengunjung_wanita}}"  onkeypress="return hanyaAngka(event)" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Hasil Monitoring</label>
                        <div class="col-sm-10">
                           <textarea id="summernote" name="hasil">{!! $data->hasil!!}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Foto Kondisi Saat Ini</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="foto">
                        </div>
                    </div>
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Update Data</button>
                </div>
                <!-- /.box-footer -->
            </form>
            
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection
@push('js')
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 400,
            lineHeights: [],
            callbacks: {
                onKeydown: function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault(); 
                        document.execCommand('insertLineBreak');
                    }
                },
                onKeyup: function(e) {
                        checkWordText();
                }
            }
        });

        function checkWordText() {
                const maxWords = 300;
                const content = $('#summernote').summernote('code').replace(/<\/?[^>]+(>|$)/g, ""); // Menghapus HTML tags
                const words = content.trim().split(/\s+/);
                const wordCountMsg = document.getElementById('wordCountTxt');
                const submitButton = document.getElementById('submitButton');
                
                if (words.length > maxWords) {
                    wordCountMsg.textContent = `Maksimal ${maxWords} kata saja.`;

                    document.getElementById("wordCountTxt").style.color = "red";
                    submitButton.disabled = true; // Nonaktifkan tombol submit
                } else {
                    wordCountMsg.textContent = `Jumlah kata: ${words.length}`;
                    document.getElementById("wordCountTxt").style.color = "green";
                    submitButton.disabled = false; // Aktifkan kembali jika di bawah batas
                }
            }
    });
  </script>
@endpush