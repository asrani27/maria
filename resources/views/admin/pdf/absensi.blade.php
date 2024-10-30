<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
</head>
<body>
    <table width="100%">
        <tr>
            <td><img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('logo/pemko.png'))) }}" width="70px"></td>
            <td style="text-align: center">
                <span style="font-size: 14px; font-weight:bold"> PEMERINTAH KOTA BANJARMASIN</span><br/>
                <span style="font-size: 18px; font-weight:bold"> DINAS KEBUDAYAAN, KEPEMUDAAN, OLAHRAGA, DAN PARIWISATA</span><br/>
                <span style="font-size: 12px;">Jl Pangeran HIdayatullah RW 13 RT 01 Kel banua Anyar, Kec Banjarmasin Timur. <br/>Prov Kalsel
                Kodepos 70249 Telp/WA 0822 5399 1234</span>
            </td>
            <td></td>
        </tr>
    </table>
    <hr>
    <table width="100%">
        <tr style="text-align: center">
            <td><strong>LAPORAN ABSENSI</strong></td>
        </tr>
    </table>
<br/>
    <table width="100%" border=1 cellpadding="4" cellspacing="0">
        <tr style="text-align: center; font-weight:bold">
            <td>No</td>
            <td>Tanggal</td>
            <td>Cagar Budaya</td>
            <td>Petugas</td>
            <td>Lokasi</td>
        </tr>
        @foreach ($data as $key => $item)
            <tr style="font-size:14px">
                <td>{{$key + 1}}</td>
                <td>{{\Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y')}}</td>
                <td>{{$item->cagar == null ? '': $item->cagar->nama}}</td>
                <td>{{$item->petugas == null ? '': $item->petugas->nama}}</td>
                <td>{{$item->cagar == null ? '': $item->cagar->lokasi}}</td>
            </tr>
        @endforeach
    </table>
    <br/>
    <table width="100%">
        <tr>
            <td width="10%"></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Banjarmasin, {{\Carbon\Carbon::now()->translatedFormat('d F Y')}} 
                <br/>
                Kepala Bidang Kebudayaan<br/> Dinas Kebudayaan Kepemudaan Olahraga Dan Pariwisata
                <br/><br/><br/><br/>
                (..................................)
            </td>
        </tr>
    </table>
</body>
</html>