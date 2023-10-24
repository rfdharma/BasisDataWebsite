<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments'; // Sesuaikan dengan nama tabel yang sesuai

    protected $fillable = [
        'photos_payment',
        'booking_id',
        'user_id',
    ];

    protected $casts = [
        'photos_payment' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
