<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{

    public function index()
    {
        $data = Kategori::paginate(10);
        return view('admin.kategori.index', compact('data'));
    }
    public function create()
    {
        return view('admin.kategori.create');
    }
    public function delete($id)
    {
        Kategori::where('id', $id)->first()->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function store(Request $req)
    {
        $check = Kategori::where('nama', $req->nama)->first();
        if ($check != null) {
            Session::flash('warning', 'Nama Sudah terdaftar');
            $req->flash();
            return back();
        } else {
            DB::beginTransaction();

            try {
                $n = new kategori;
                $n->nama = $req->nama;
                $n->save();

                DB::commit();

                Session::flash('success', 'berhasil di simpan');
                return redirect('/superadmin/kategori');
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

        $n = kategori::where('id', $id)->first();
        $n->nama = $req->nama;
        $n->save();

        Session::flash('success', 'berhasil di simpan');
        return redirect('/superadmin/kategori');
    }

    public function edit($id)
    {
        $data = kategori::find($id);
        return view('admin.kategori.edit', compact('data'));
    }
    public function cari()
    {
        $keyword = request()->get('cari');
        $data = kategori::where('nik', 'LIKE', '%' . $keyword . '%')->orWhere('nama', 'LIKE', '%' . $keyword . '%')->paginate(10);
        request()->flash();
        return view('admin.kategori.index', compact('data'));
    }
}
