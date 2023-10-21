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

    public function calculateQuantity()
    {
        $vehicle = $this->vehicle;
        $carPlatesCount = $vehicle->carPlates()->count();
        $this->quantity = $carPlatesCount;

        // Mengatur 'available' berdasarkan jumlah quantity
        $this->available = $this->quantity > 0;

        $this->save();
    }

}
