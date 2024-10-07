<?php

namespace App\Http\Controllers;

use App\Models\Cagar;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CagarController extends Controller
{
    public function index()
    {
        $data = Cagar::paginate(10);
        return view('admin.cagar.index', compact('data'));
    }
    public function create()
    {
        $kategori = Kategori::get();
        return view('admin.cagar.create', compact('kategori'));
    }
    public function delete($id)
    {
        Cagar::where('id', $id)->first()->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'foto' => 'required|max:2048',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Foto Maks 2MB');
            return back();
        }

        $check = Cagar::where('nama', $req->nama)->first();
        if ($check != null) {
            Session::flash('warning', 'Nama Sudah terdaftar');
            $req->flash();
            return back();
        } else {
            DB::beginTransaction();

            try {

                $image = $req->file('foto');

                $extension = $req->foto->getClientOriginalExtension();

                $filename = uniqid(Str::random(6)) . '.' . $extension;

                $image->move(public_path('storage') . '/foto', $filename);

                $n = new Cagar();
                $n->nama = $req->nama;
                $n->kategori_id = $req->kategori_id;
                $n->lokasi = $req->lokasi;
                $n->sejarah = $req->sejarah;
                $n->senin = $req->senin;
                $n->selasa = $req->selasa;
                $n->rabu = $req->rabu;
                $n->kamis = $req->kamis;
                $n->jumat = $req->jumat;
                $n->sabtu = $req->sabtu;
                $n->minggu = $req->minggu;
                $n->foto = $filename;
                $n->save();

                DB::commit();

                Session::flash('success', 'berhasil di simpan');
                return redirect('/superadmin/cagar');
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

        if ($req->foto == null) {
            $filename = Cagar::where('id', $id)->first()->foto;
        } else {
            $validator = Validator::make($req->all(), [
                'foto' => 'required|max:2048',
            ]);

            if ($validator->fails()) {
                Session::flash('error', 'Foto Maks 2MB');
                return back();
            }
            $image = $req->file('foto');

            $extension = $req->foto->getClientOriginalExtension();

            $filename = uniqid(Str::random(6)) . '.' . $extension;

            $image->move(public_path('storage') . '/foto', $filename);
        }

        $n = Cagar::where('id', $id)->first();
        $n->nama = $req->nama;
        $n->kategori_id = $req->kategori_id;
        $n->lokasi = $req->lokasi;
        $n->sejarah = $req->sejarah;
        $n->senin = $req->senin;
        $n->selasa = $req->selasa;
        $n->rabu = $req->rabu;
        $n->kamis = $req->kamis;
        $n->jumat = $req->jumat;
        $n->sabtu = $req->sabtu;
        $n->minggu = $req->minggu;
        $n->foto = $filename;
        $n->save();

        Session::flash('success', 'berhasil di simpan');
        return redirect('/superadmin/cagar');
    }

    public function edit($id)
    {
        $data = Cagar::find($id);
        $kategori = Kategori::get();
        return view('admin.cagar.edit', compact('data', 'kategori'));
    }
    public function cari()
    {
        $keyword = request()->get('cari');
        $data = Cagar::where('nik', 'LIKE', '%' . $keyword . '%')->orWhere('nama', 'LIKE', '%' . $keyword . '%')->paginate(10);
        request()->flash();
        return view('admin.cagar.index', compact('data'));
    }
}
