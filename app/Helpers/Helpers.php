<?php

use App\Models\Cagar;
use App\Models\Jadwal;
use App\Models\Kategori;
use App\Models\Petugas;

function petugas()
{
    return Petugas::count();
}

function cagar()
{
    return Cagar::count();
}

function jadwal()
{
    return Jadwal::count();
}

function kategori()
{
    return Kategori::count();
}
