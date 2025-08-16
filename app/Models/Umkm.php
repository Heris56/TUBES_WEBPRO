<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Umkm extends Model
{
    /** @use HasFactory<\Database\Factories\UmkmFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id_umkm';

    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'alamat',
        'username',
        'email',
        'password',
        'nama_usaha',
        'NIK_KTP',
        'is_verified',
        'auth_code',
        'reset_token',
        'reset_token_expiry',
    ];

    // Casts
    protected $casts = [
        'is_verified' => 'boolean',
        'reset_token_expiry' => 'datetime',
    ];
}
