<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimMobil extends Model
{
    use HasFactory;

    protected $connection = 'sec_mysql';

    protected $table = 'dim_mobil';
    protected $primaryKey = 'sk_mobil';

    protected $fillable = [
        'brand',
        'tipe',
        'nama',
        'plat',
    ];

    // Relasi dengan fact_rental
    public function factRental()
    {
        return $this->hasMany(FactRental::class, 'sk_mobil', 'sk_mobil');
    }

    // Relasi dengan fact_inventaris
    public function factInventaris()
    {
        return $this->hasMany(FactInventaris::class, 'sk_ident', 'sk_ident');
    }
}
