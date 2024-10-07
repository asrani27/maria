<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PetugasController extends Controller
{
    public function index()
    {
        $data = Petugas::paginate(10);
        return view('admin.petugas.index', compact('data'));
    }
    public function create()
    {
        return view('admin.petugas.create');
    }
    public function delete($id)
    {
        Petugas::where('id', $id)->first()->user->delete();
        Petugas::where('id', $id)->first()->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function store(Request $req)
    {
        $check = Petugas::where('nip', $req->nip)->first();
        if ($check != null) {
            Session::flash('warning', 'NIP Sudah terdaftar');
            $req->flash();
            return back();
        } else {
            DB::beginTransaction();

            try {
                $n = new Petugas;
                $n->nip = $req->nip;
                $n->nama = $req->nama;
                $n->telp = $req->telp;
                $n->save();

                $role = Role::where('name', 'user')->first();

                $u = new User;
                $u->name = $req->nama;
                $u->username = $req->nip;
                $u->password = bcrypt('petugas');
                $u->petugas_id = $n->id;
                $u->save();

                $u->roles()->attach($role);

                DB::commit();

                Session::flash('success', 'berhasil di simpan');
                return redirect('/superadmin/petugas');
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

        $n = Petugas::where('id', $id)->first();
        $n->nama = $req->nama;
        $n->telp = $req->telp;
        $n->save();

        Session::flash('success', 'berhasil di simpan');
        return redirect('/superadmin/petugas');
    }

    public function edit($id)
    {
        $data = Petugas::find($id);
        return view('admin.petugas.edit', compact('data'));
    }
    public function cari()
    {
        $keyword = request()->get('cari');
        $data = Petugas::where('nik', 'LIKE', '%' . $keyword . '%')->orWhere('nama', 'LIKE', '%' . $keyword . '%')->paginate(10);
        request()->flash();
        return view('admin.petugas.index', compact('data'));
    }
}
