<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentalPlate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rental_plates';

    protected $fillable = [
        'booking_id',
        'vehicle_id',
        'plate',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function plate()
    {
        return $this->belongsTo(CarPlate::class, 'plate');
    }
}
