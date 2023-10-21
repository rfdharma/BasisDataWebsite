<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarPlate extends Model
{
    use HasFactory;

    protected $table = 'car_plates'; // Sesuaikan dengan nama tabel yang sesuai

    protected $primaryKey = 'plate'; // Jadikan 'plate' sebagai primary key

    public $incrementing = false; // Primary key tidak auto-increment

    protected $keyType = 'string'; // Tipe data primary key

    protected $fillable = [
        'plate',
        'vehicles_id', // Kolom foreign key yang merujuk ke tabel 'vehicles'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicles_id', 'id')->withDefault([
            'vehicles_id' => null,
        ]);
    }

}
