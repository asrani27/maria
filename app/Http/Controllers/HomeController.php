<?php

namespace App\Http\Controllers;

use App\Models\Lurah;
use App\Models\Jadwal;
use App\Models\Tpermohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function superadmin()
    {

        return view('admin.home');
    }

    public function user()
    {
        $data = Jadwal::where('petugas_id', Auth::user()->petugas->id)->get();
        return view('user.home', compact('data'));
    }

    public function pemohon()
    {
        $permohonan = Tpermohonan::orderBy('id', 'DESC')->paginate(15);
        return view('pemohon.home', compact('permohonan'));
    }

    public function updatelurah(Request $request)
    {
        Lurah::first()->update($request->all());
        Session::flash('success', 'Berhasil Diupdate');
        return back();
    }
}
