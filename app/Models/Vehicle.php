<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Vehicle extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
        'name',
        'brand_id',
        'type_id',
        'transmission',
        'price',
        'capacity',
        'features',
        'year',
		'star',
		'review'
	];


	public function brand()
	{
		return $this->belongsTo(Brand::class, 'brand_id');
	}

	public function type()
	{
		return $this->belongsTo(Type::class,'type_id');
	}

	public function bookings()
	{
		return $this->hasMany(Booking::class);
	}

    public function photos()
    {
        return $this->hasMany(Photo::class, 'vehicle_id');
    }

    public function carPlates()
    {
        return $this->hasMany(CarPlate::class, 'vehicles_id', 'id');
    }


    public function inventory()
    {
        return $this->hasOne(Inventories::class, 'vehicle_id');
    }

}
