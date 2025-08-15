<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    /** @use HasFactory<\Database\Factories\KurirFactory> */
    use HasFactory;

    protected $primaryKey = 'id_kurir';

    protected $fillable = [
        'nama_kurir',
        'id_umkm',
        'email',
        'password',
        'status',
        'nomor_telepon',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_umkm', 'id_umkm');
    }
}
