<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    /** @use HasFactory<\Database\Factories\KeranjangFactory> */
    use HasFactory;

    protected $primaryKey = 'id_keranjang';

    protected $fillable = [
        'total',
        'kuantitas',
        'status',
        'id_pembeli',
        'id_produk',
        'id_batch',
    ];

    protected $casts = [
        'total' => 'float',
        'kuantitas' => 'integer',
        'id_batch' => 'integer',
    ];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'id_pembeli', 'id_pembeli');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
