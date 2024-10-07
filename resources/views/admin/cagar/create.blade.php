@extends('layouts.app')
@push('css')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/superadmin/cagar" class="btn btn-flat btn-warning"><i class="fa fa-backward"></i> Kembali</a> <br /> <br />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Tambah Data</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/superadmin/cagar/create" enctype="multipart/form-data">
                @csrf

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="kategori_id" required>
                                <option value="">-pilih-</option>
                                @foreach ($kategori as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Cagar Budaya</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Lokasi Cagar Budaya</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="lokasi" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sejarah Cagar Budaya</label>
                        <div class="col-sm-10">
                           <textarea id="summernote" name="sejarah"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <h3>JADWAL BUKA KUNJUNGAN CAGAR BUDAYA</h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Foto</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="foto" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Senin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="senin" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Selasa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="selasa" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rabu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="rabu" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kamis</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="kamis" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jumat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="jumat" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sabtu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sabtu" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">MInggu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="minggu" required>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right" ><i class="fa fa-save"></i> Simpan Data</button>
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

{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
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