<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimIdentMobil extends Model
{
    use HasFactory;

    protected $connection = 'sec_mysql';

    protected $table = 'dim_ident_mobil';
    protected $primaryKey = 'sk_ident';

    protected $fillable = [
        'brand',
        'tipe',
        'nama',
    ];

    // Relasi dengan fact_inventaris
    public function factInventaris()
    {
        return $this->hasMany(FactInventaris::class, 'sk_ident', 'sk_ident');
    }
}
