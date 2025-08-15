<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    /** @use HasFactory<\Database\Factories\ProdukFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'harga',
        'stok',
        'berat',
        'nama_barang',
        'deskripsi_barang',
        'image_url',
        'tipe_barang',
        'id_umkm',
    ];

    protected $casts = [
        'harga' => 'float',
        'stok' => 'integer',
        'berat' => 'float',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_umkm', 'id_umkm');
    }
}
