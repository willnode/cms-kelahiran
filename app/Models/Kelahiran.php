<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelahiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_anak', 'nama_ayah', 'nama_ibu',
        'periode_id', 'desa_id', 'umur_ibu',
        'rt', 'rw', 'tanggal_lahir', 'tempat_lahir',
        'jumlah_anak_hidup',
    ];

    protected $table = 'kelahiran';
}
