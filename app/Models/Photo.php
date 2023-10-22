<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    use HasFactory;
//    protected $primaryKey = 'photo_id'; // Nama kolom primary key

    protected $fillable = [
        'photos', // Atribut untuk tautan (URL) gambar
    ];

    protected $casts = [
        'photos' => 'array'
    ];
    public function getThumbnailAttribute()
    {
        if ($this->photos) {
            return Storage::url(json_decode($this->photos)[0]);
        }

        return 'https://via.placeholder.com/800x600';
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
