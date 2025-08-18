<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'alamat',
        'username',
        'email',
        'password',
        'role',
        'nama_usaha',
        'NIK_KTP',
        'is_verified',
        'auth_code',
        'reset_token',
        'reset_token_expiry',
        'profileImg',
    ];

    protected $hidden = [
        'password',
        'auth_code',
        'reset_token',
    ];
}
