<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimSpek extends Model
{
    use HasFactory;

    protected $connection = 'sec_mysql';

    protected $table = 'dim_spek';
    protected $primaryKey = 'sk_spek';

    protected $fillable = [
        'tahun_produksi',
        'transmisi',
        'kapasitas',
    ];

    // Relasi dengan fact_inventaris
    public function factInventaris()
    {
        return $this->hasMany(FactInventaris::class, 'sk_spek', 'sk_spek');
    }
}
