<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventories extends Model
{
    use HasFactory;

    protected $table = 'inventories';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'vehicle_id',
        'quantity',
        'available',
    ];
    // Definisikan relasi antara Inventories dan Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function rentalPlates()
    {
        return $this->hasMany(RentalPlate::class, 'vehicle_id', 'id');
    }


    public function calculateQuantity($decrement = false)
    {
        $vehicle = $this->vehicle;
        $rentalPlatesCount = $vehicle->rentalPlates()->withTrashed()->count();
        $carPlatesCount = $vehicle->carPlates()->count();

        if ($decrement) {
            $this->quantity -= 1;
        } else {
            if (is_null($rentalPlatesCount)) {
                $this->quantity = $carPlatesCount;
            } else {
                $this->quantity += 1;
            }
        }

        // Set 'available' based on the quantity
        $this->available = $this->quantity > 0;

        $this->save();
    }



}
