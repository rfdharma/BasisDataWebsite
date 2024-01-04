<?php

namespace App\Http\Controllers\Owner;

use App\Charts\BrandCar;
use App\Charts\CapacityCar;
use App\Charts\CarYearCount;
use App\Charts\FeeProfitBrandCar;
use App\Charts\FeeProfitCar;
use App\Charts\RentbyBrand;
use App\Charts\RentbyDate;
use App\Charts\RentbyType;
use App\Charts\RevenuesbyMonth;
use App\Charts\RevenuesBrandCar;
use App\Charts\RevenuesNameCar;
use App\Charts\RevenuesRentFees;
use App\Charts\TopRentCar;
use App\Charts\TransmissionCarCount;
use App\Charts\TypeCar;
use App\Charts\UnitCarName;
use App\Http\Controllers\Controller;
use App\Models\DimMobil;
use App\Models\FactInventaris;
use App\Models\FactRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DRentalController extends Controller
{
    public static function getTopRevenueCar()
    {
        return self::select('dim_ident_mobil.nama', 'fact_rental.pendapatan_rental')
            ->join('dim_ident_mobil', 'fact_rental.sk_mobil', '=', 'dim_ident_mobil.sk_mobil')
            ->orderByDesc('fact_rental.pendapatan_rental')
            ->limit(1)
            ->first();
    }

    public function index(
        RevenuesBrandCar $revenuesBrandCarChart,
        RevenuesNameCar  $revenuesNameCarChart,
        RentbyBrand      $RentbyBrandChart,
        RentbyType       $RentbyTypeChart,
        RentbyDate       $RentbyDateChart,
        RevenuesbyMonth  $rentFeeHappened,
        TopRentCar $topRentCar,
        FeeProfitCar $feeProfitCar,
        FeeProfitBrandCar $feeProfitBrandCar,
    ) {

        $factrentalData = FactRental::all();
        $totalrevenues = $factrentalData->sum('pendapatan_rental');

        $topRevenueCar = FactRental::select('dim_mobil.nama')
            ->join('dim_mobil', 'fact_rental.sk_mobil', '=', 'dim_mobil.sk_mobil')
            ->join('dim_waktu', 'fact_rental.sk_waktu', '=', 'dim_waktu.sk_waktu')
            ->groupBy('dim_mobil.nama')
            ->orderByDesc(DB::raw('AVG(fact_rental.pendapatan_rental)'))
            ->value('nama');

        $mostFrequentSkMobil = FactRental::select('fact_rental.sk_mobil')
            ->join('dim_mobil', 'fact_rental.sk_mobil', '=', 'dim_mobil.sk_mobil')
            ->groupBy('fact_rental.sk_mobil')
            ->orderByDesc(DB::raw('SUM(fact_rental.total_unit_tersewa) / COUNT(DISTINCT fact_rental.sk_waktu)'))
            ->value('fact_rental.sk_mobil');


        $mostFrequentCar = DimMobil::where('sk_mobil', $mostFrequentSkMobil)->value('nama');

        $carWithHighestPenalty = FactRental::select(
            'dim_mobil.nama',
            DB::raw('SUM(fact_rental.keuntungan_denda) as total_penalties')
        )
            ->join('dim_mobil', 'fact_rental.sk_mobil', '=', 'dim_mobil.sk_mobil')
            ->groupBy('dim_mobil.nama')
            ->orderByDesc('total_penalties')
            ->first();

        $carNameWithHighestPenalty = $carWithHighestPenalty ? $carWithHighestPenalty->nama : null;






        $revenuesBrandCarChart = $revenuesBrandCarChart->build();
        $revenuesNameCarChart = $revenuesNameCarChart->build();
        $RentbyBrandChart = $RentbyBrandChart->build();
        $RentbyTypeChart = $RentbyTypeChart->build();
        $RentbyDateChart = $RentbyDateChart->build();
        $rentFeeHappened = $rentFeeHappened->build();
        $topRentCar = $topRentCar->build();
        $feeProfitCar = $feeProfitCar->build();
        $feeProfitBrandCar = $feeProfitBrandCar->build();

        // Plot
        return view('owner.dashboard_rental', compact(
            'revenuesBrandCarChart',
            'revenuesNameCarChart',
            'RentbyBrandChart',
            'RentbyTypeChart',
            'RentbyDateChart',
            'rentFeeHappened',
            'totalrevenues',
            'topRevenueCar',
            'mostFrequentCar',
            'topRentCar',
            'feeProfitCar',
            'feeProfitBrandCar',
            'carNameWithHighestPenalty'

        ));

    }
}
