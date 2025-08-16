<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembeli extends Model
{
    /** @use HasFactory<\Database\Factories\PembeliFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id_pembeli';

    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'alamat',
        'username',
        'email',
        'password',
        'profileImg',
        'auth_code',
        'is_verified',
        'reset_token',
        'reset_token_expiry',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'reset_token_expiry' => 'datetime',
    ];
}
