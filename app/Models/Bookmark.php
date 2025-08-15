<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    /** @use HasFactory<\Database\Factories\BookmarkFactory> */
    use HasFactory;
    
    protected $primaryKey = 'id_bookmark';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'start_date',
        'end_date',
        'status',
        'id_umkm',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_umkm', 'id_umkm');
    }
}
