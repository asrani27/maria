<?php

namespace App\Http\Controllers;

use App\Models\Cagar;
use App\Models\Jadwal;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JadwalController extends Controller
{
    public function index()
    {
        $data = Jadwal::paginate(10);
        return view('admin.jadwal.index', compact('data'));
    }
    public function create()
    {
        $cagar = Cagar::get();
        $petugas = Petugas::get();
        return view('admin.jadwal.create', compact('cagar', 'petugas'));
    }
    public function delete($id)
    {
        Jadwal::where('id', $id)->first()->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function store(Request $req)
    {
        $check = Jadwal::where('tanggal', $req->tanggal)->first();
        if ($check != null) {
            Session::flash('warning', 'Jadwal tanggal ini Sudah di Input');
            $req->flash();
            return back();
        } else {
            DB::beginTransaction();

            try {
                $n = new Jadwal;
                $n->tanggal = $req->tanggal;
                $n->cagar_id = $req->cagar_id;
                $n->petugas_id = $req->petugas_id;
                $n->save();

                DB::commit();

                Session::flash('success', 'berhasil di simpan');
                return redirect('/superadmin/jadwal');
                // all good
            } catch (\Exception $e) {

                DB::rollback();
                Session::flash('error', 'Gagal gabung');
                return back();
                // something went wrong
            }
        }
    }

    public function update(Request $req, $id)
    {

        $n = Jadwal::where('id', $id)->first();
        $n->tanggal = $req->tanggal;
        $n->cagar_id = $req->cagar_id;
        $n->petugas_id = $req->petugas_id;
        $n->save();

        Session::flash('success', 'berhasil di simpan');
        return redirect('/superadmin/jadwal');
    }

    public function edit($id)
    {
        $data = Jadwal::find($id);
        $cagar = Cagar::get();
        $petugas = Petugas::get();
        return view('admin.jadwal.edit', compact('data', 'cagar', 'petugas'));
    }
    public function cari()
    {
        $keyword = request()->get('cari');
        $data = Jadwal::where('nik', 'LIKE', '%' . $keyword . '%')->orWhere('nama', 'LIKE', '%' . $keyword . '%')->paginate(10);
        request()->flash();
        return view('admin.jadwal.index', compact('data'));
    }
}
