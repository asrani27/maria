<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';
    protected $guarded = ['id'];
    public function cagar()
    {
        return $this->belongsTo(Cagar::class, 'cagar_id');
    }
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }
}
