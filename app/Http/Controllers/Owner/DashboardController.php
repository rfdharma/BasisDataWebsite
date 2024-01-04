<?php

namespace App\Http\Controllers\Owner;

use App\Charts\BarCarCapacity;
use App\Charts\BarCarTransmission;
use App\Charts\BarCarYear;
use App\Charts\BrandCar;
use App\Charts\CapacityCar;
use App\Charts\CarYearCount;
use App\Charts\RevenuesBrandCar;
use App\Charts\RevenuesNameCar;
use App\Charts\TransmissionCarCount;
use App\Charts\TypeCar;
use App\Charts\UnitCarName;
use App\Http\Controllers\Controller;
use App\Models\FactInventaris;
use App\Models\DimIdentMobil;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(
        CarYearCount         $carYearCountChart,
        UnitCarName          $unitCarNameChart,
        TransmissionCarCount $carTransmissionCountChart,
        CapacityCar          $carCapacityChart,
        BrandCar             $BrandCarChart,
        TypeCar              $TypeCarChart,
        RevenuesBrandCar     $revenuesBrandCarChart,
        RevenuesNameCar $revenuesNameCarChart,
        BarCarYear $barCarYear,
        BarCarCapacity $barCarCapacity,
        BarCarTransmission $barCarTransmission,

    ) {

        $factInventoryBrand = FactInventaris::join('dim_ident_mobil', 'fact_inventaris.sk_ident', '=', 'dim_ident_mobil.sk_ident')
            ->groupBy('dim_ident_mobil.brand')
            ->selectRaw('dim_ident_mobil.brand, SUM(fact_inventaris.jumlah_unit) as total_unit')
            ->get();
        $unitCounts = $factInventoryBrand->pluck('total_unit')->toArray();
        $totalBrand = count($unitCounts);

        $factInventoryType = FactInventaris::join('dim_ident_mobil', 'fact_inventaris.sk_ident', '=', 'dim_ident_mobil.sk_ident')
            ->groupBy('dim_ident_mobil.tipe')
            ->selectRaw('dim_ident_mobil.tipe, SUM(fact_inventaris.jumlah_unit) as total_unit')
            ->get();
        $unitCounts = $factInventoryType->pluck('total_unit')->toArray();
        $totalType = count($unitCounts);

        $factInventoryAll = FactInventaris::all();
        $totalUnit = $factInventoryAll->sum('jumlah_unit');


//        Plot
        $carYearCountChart = $carYearCountChart->build();
        $unitCarNameChart = $unitCarNameChart->build();
        $carTransmissionCountChart = $carTransmissionCountChart->build();
        $carCapacityChart = $carCapacityChart->build();
        $BrandCarChart = $BrandCarChart->build();
        $TypeCarChart = $TypeCarChart->build();
        $revenuesBrandCarChart = $revenuesBrandCarChart->build();
        $revenuesNameCarChart = $revenuesNameCarChart->build();
        $barCarYear = $barCarYear->build();
        $barCarCapacity = $barCarCapacity->build();
        $barCarTransmission = $barCarTransmission->build();

        // Plot
        return view('owner.dashboard', compact(
            'carYearCountChart',
            'unitCarNameChart',
            'carTransmissionCountChart',
            'barCarYear',
            'barCarCapacity',
            'barCarTransmission',
            'carCapacityChart',
            'BrandCarChart',
            'TypeCarChart',
            'totalBrand',
            'totalType',
            'totalUnit',

            'revenuesBrandCarChart',
            'revenuesNameCarChart',

        ));
    }
}
