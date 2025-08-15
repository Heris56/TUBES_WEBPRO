<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pesanan extends Model
{
    /** @use HasFactory<\Database\Factories\PesananFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'status_pesanan',
        'total_belanja',
        'id_keranjang',
        'histori_pesanan',
    ];

    protected $casts = [
        'total_belanja' => 'float',
        'histori_pesanan' => 'date',
    ];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'id_keranjang', 'id_keranjang');
    }
}
