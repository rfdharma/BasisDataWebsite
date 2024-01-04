<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FactRental extends Model
{
    use HasFactory;

    protected $connection = 'sec_mysql';

    protected $table = 'fact_rental';
    protected $primaryKey = 'sk_rental';

    protected $fillable = [
        'sk_mobil',
        'sk_waktu',
        'pendapatan_rental',
        'total_unit_tersewa',
        'keuntungan_denda',
        'total_denda_terjadi',
    ];

    public function dimMobil()
    {
        return $this->belongsTo(DimMobil::class, 'sk_mobil', 'sk_mobil');
    }

    // Relasi dengan dim_waktu
    public function dimWaktu()
    {
        return $this->belongsTo(DimWaktu::class, 'sk_waktu', 'sk_waktu');
    }

    public static function getTopRevenueCar()
    {
        return self::select('dim_ident_mobil.nama', 'fact_rental.pendapatan_rental')
            ->join('dim_ident_mobil', 'fact_rental.sk_mobil', '=', 'dim_ident_mobil.sk_ident')
            ->orderByDesc('fact_rental.pendapatan_rental')
            ->limit(1)
            ->first();
    }

}

