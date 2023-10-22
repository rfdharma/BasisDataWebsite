<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
        'id',
		'name',
		'start_date',
		'end_date',
		'address',
		'city',
		'zip',
		'status',
		'payment_status',
        'return_status',
		'total_price',
		'vehicle_id',
		'user_id'
	];

	protected $dates = [
		'start_date',
		'end_date'
	];


    public function vehicle()
	{
		return $this->belongsTo(Vehicle::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }


}
