<?php

// Model UPZ
namespace App\Models;
use App\Models\upzs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class upzs extends Model
{
    use HasFactory;

    protected $table = 'upzs';
    
    // Tambahkan kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_upz',
        'nama_ketua',
        'alamat_upz',
        'nomor_telepon',
        'tanggal_berlaku',
        'latitude',
        'longitude',
    ];
}
