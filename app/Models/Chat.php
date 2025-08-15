<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    /** @use HasFactory<\Database\Factories\ChatFactory> */
    use HasFactory;

    protected $primaryKey = 'id_chat';

    protected $fillable = [
        'message',
        'sent_at',
        'is_read',
        'id_umkm',
        'id_pembeli',
        'id_kurir',
        'receiver_type',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'sent_at' => 'datetime',
    ];

    public function umkm()
    {
        return $this->belongsTo(Pembeli::class, 'id_umkm', 'id_umkm');
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'id_pembeli', 'id_pembeli');
    }

    public function kurir()
    {
        return $this->belongsTo(Pembeli::class, 'id_kurir', 'id_kurir');
    }
}
