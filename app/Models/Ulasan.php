<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    /** @use HasFactory<\Database\Factories\UlasanFactory> */
    use HasFactory;

    protected $primaryKey = 'id_ulasan';

    protected $fillable = [
        'id_pembeli',
        'id_produk',
        'username',
        'ulasan',
        'rating',
    ];

    protected $casts = [
        'rating' => 'float',
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
