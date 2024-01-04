<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimWaktu extends Model
{
    use HasFactory;

    protected $connection = 'sec_mysql';

    protected $table = 'dim_waktu';
    protected $primaryKey = 'sk_waktu';

    protected $fillable = [
        'bulan',
        'minggu',
        'hari',
        'tanggal',
    ];

    // Relasi dengan fact_rental
    public function factRental()
    {
        return $this->hasMany(FactRental::class, 'sk_waktu', 'sk_waktu');
    }
}
