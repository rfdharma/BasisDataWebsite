<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LateFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'days_late',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
