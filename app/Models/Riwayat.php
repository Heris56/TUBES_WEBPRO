<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Riwayat extends Model
{
    /** @use HasFactory<\Database\Factories\RiwayatFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id_riwayat';

    protected $fillable = [
        'tanggal',
        'id_pesanan',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }
}
