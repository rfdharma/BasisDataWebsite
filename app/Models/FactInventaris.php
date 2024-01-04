<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactInventaris extends Model
{
    use HasFactory;
    protected $connection = 'sec_mysql';

    protected $table = 'fact_inventaris';
    protected $primaryKey = 'sk_inventaris';

    protected $fillable = [
        'sk_ident',
        'sk_spek',
        'jumlah_unit',
    ];

    // Relasi dengan dim_ident_mobil
    public function dimIdentMobil()
    {
        return $this->belongsTo(DimIdentMobil::class, 'sk_ident', 'sk_ident');
    }

    // Relasi dengan dim_spek
    public function dimSpek()
    {
        return $this->belongsTo(DimSpek::class, 'sk_spek', 'sk_spek');
    }

}
