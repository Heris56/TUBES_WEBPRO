<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Umkm extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UmkmFactory> */
    use HasFactory, SoftDeletes, Notifiable, HasApiTokens;

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

    protected $hidden = ['password', 'remember_token', 'auth_code'];
}
