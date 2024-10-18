<?php

namespace App\Http\Controllers;

use App\Models\RT;
use App\Models\SM;
use Carbon\Carbon;
use App\Models\Kasi;
use App\Models\Role;
use App\Models\User;
use App\Models\Arsip;
use App\Models\Cagar;
use App\Models\Surat;
use App\Models\Kepala;
use App\Models\Absensi;
use App\Models\Petugas;
use App\Models\Kategori;
use App\Models\Penyedia;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pendaftar;
use App\Models\Registrasi;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Models\KoordinatorTPS;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function user()
    {
        $data = User::orderBy('id', 'DESC')->paginate(15);
        return view('admin.user.index', compact('data'));
    }
    public function user_create()
    {
        return view('admin.user.create');
    }
    public function user_edit($id)
    {
        $data = User::find($id);

        return view('admin.user.edit', compact('data'));
    }
    public function user_delete($id)
    {
        if (Auth::user()->id == $id) {
            Session::flash('error', 'Tidak bisa di hapus, karena sedang digunakan');
            return back();
        } else {
            $data = User::find($id)->delete();
            Session::flash('success', 'Berhasil Dihapus');
            return back();
        }
    }
    public function user_store(Request $req)
    {
        $checkUser = User::where('username', $req->username)->first();
        $role = Role::where('name', $req->role)->first();
        if ($checkUser == null) {
            if ($req->password1 != $req->password2) {
                Session::flash('error', 'Password Tidak Sama');
                return back();
            } else {

                $n = new User();
                $n->name = $req->name;
                $n->username = $req->username;
                $n->password = bcrypt($req->password1);
                $n->save();

                $n->roles()->attach($role);
                Session::flash('success', 'Berhasil Disimpan, Password : ' . $req->password1);
                return redirect('/superadmin/user');
            }
        } else {
            Session::flash('error', 'Username ini sudah pernah di input');
            return back();
        }
    }
    public function user_update(Request $req, $id)
    {
        $role = Role::where('name', $req->role)->first();
        $data = User::find($id);
        if ($req->password1 == null) {
            //update tanpa password

            $data->name = $req->name;
            $data->save();
            $data->roles()->sync($role);
            Session::flash('success', 'Berhasil Diupdate');
            return redirect('/superadmin/user');
        } else {
            // update beserta password
            if ($req->password1 != $req->password2) {
                Session::flash('error', 'Password Tidak Sama');
                return back();
            } else {

                $data->password = bcrypt($req->password1);
                $data->name = $req->name;
                $data->save();
                $data->roles()->sync($role);
                Session::flash('success', 'Berhasil Diupdate, password : ' . $req->password1);
                return redirect('/superadmin/user');
            }
        }
    }

    public function absensi()
    {
        $data = Absensi::orderBy('id', 'DESC')->paginate(15);
        return view('admin.absensi.index', compact('data'));
    }
    public function absensi_create()
    {
        $cagar = Cagar::get();
        $petugas = Petugas::get();
        return view('admin.absensi.create', compact('cagar', 'petugas'));
    }
    public function absensi_edit($id)
    {
        $data = Absensi::find($id);
        $cagar = Cagar::get();
        $petugas = Petugas::get();
        return view('admin.absensi.edit', compact('data', 'cagar', 'petugas'));
    }
    public function absensi_delete($id)
    {
        $data = Absensi::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function absensi_store(Request $req)
    {

        $check = Absensi::where('tanggal', $req->tanggal)->where('petugas_id', $req->petugas_id)->first();
        if ($check == null) {
            $n = new Absensi();
            $n->tanggal = $req->tanggal;
            $n->cagar_budaya_id = $req->cagar_budaya_id;
            $n->petugas_id = $req->petugas_id;
            $n->save();

            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/superadmin/absensi');
        } else {
            Session::flash('error', 'absensi ini sudah pernah di input');
            return back();
        }
    }
    public function absensi_update(Request $req, $id)
    {
        $data = Absensi::find($id);
        $data->tanggal = $req->tanggal;
        $data->cagar_budaya_id = $req->cagar_budaya_id;
        $data->petugas_id = $req->petugas_id;
        $data->save();
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/absensi');
    }

    public function kelurahan()
    {
        $data = Kelurahan::orderBy('id', 'DESC')->paginate(15);
        return view('admin.kelurahan.index', compact('data'));
    }


    public function laporan()
    {
        return view('admin.laporan.index');
    }
    public function laporan_absensi()
    {
        $filename = Carbon::now()->format('d-m-Y-H-i-s') . '_absensi.pdf';

        $pdf = Pdf::loadView('admin.pdf.absensi');
        return $pdf->stream($filename);
    }
    public function print()
    {
        $kelurahan = Kelurahan::get();
        $kelurahan_id = request()->get('kelurahan_id');
        $rt = request()->get('rt');

        $nama_kelurahan = Kelurahan::find($kelurahan_id)->nama;

        $data = Pendaftar::where('kelurahan_id', $kelurahan_id)->where('rt', $rt)->get();

        return view('admin.laporan.hasil', compact('kelurahan', 'data', 'nama_kelurahan', 'rt', 'koordinator'));
    }
    public function print2()
    {
        $kelurahan = Kelurahan::get();
        $pendaftar_id = request()->get('pendaftar_id');
        $rt = request()->get('rt');

        $koordinator = Pendaftar::find($pendaftar_id);

        $data = Pendaftar::where('pendaftar_id', $pendaftar_id)->get();

        return view('admin.laporan.hasil2', compact('kelurahan', 'data', 'rt', 'koordinator'));
    }

    public function lap_petugas()
    {
        $data = Petugas::get();
        return view('admin.laporan.lap_petugas', compact('data'));
    }
    public function lap_pemeriksaan()
    {
        $data = Pemeriksaan::get();
        return view('admin.laporan.lap_pemeriksaan', compact('data'));
    }
    public function lap_rekapitulasi()
    {
        $bulan = request()->get('bulan');
        $tahun = request()->get('tahun');

        $data = Pemeriksaan::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();

        $namabulan = Carbon::createFromFormat('m', $bulan)->translatedFormat('F');

        return view('admin.laporan.lap_rekapitulasi', compact('data', 'namabulan', 'tahun'));
    }
    public function lap_registrasi()
    {
        $data = Registrasi::get();
        return view('admin.laporan.lap_registrasi', compact('data'));
    }
    // public function lap_arsip()
    // {
    //     $data = Arsip::get()->sortBy('tanggal');
    //     return view('admin.laporan.lap_arsip', compact('data'));
    // }


    public function pemeriksaan_cetak($id)
    {
        $data = Pemeriksaan::find($id);
        return view('admin.laporan.lap_rincian', compact('data'));
    }
}
