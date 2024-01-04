<?php

namespace App\Charts;

use App\Models\FactRental;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RevenuesBrandCar
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $data = FactRental::select(
            'brand',
            DB::raw('SUM(pendapatan_rental) as total_pendapatan_rental'),
            DB::raw("DATE_FORMAT(dim_waktu.tanggal, '%M') as month_name")
        )
            ->join('dim_mobil', 'fact_rental.sk_mobil', '=', 'dim_mobil.sk_mobil')
            ->join('dim_waktu', 'fact_rental.sk_waktu', '=', 'dim_waktu.sk_waktu')
            ->groupBy('brand', 'month_name')
            ->orderBy('dim_waktu.tanggal', 'asc')
            ->get();

        $chartData = [];
        $brands = $data->pluck('brand')->unique();

        foreach ($brands as $brand) {
            $brandData = $data->where('brand', $brand)->pluck('total_pendapatan_rental')->toArray();
            $chartData[] = [
                'name' => $brand,
                'data' => $brandData,
            ];
        }

        $monthNames = collect($data->pluck('month_name')->unique()->toArray())->map(function ($month) {
            return Carbon::parse("2022-$month-01")->format('F');
        })->values()->toArray();

        return $this->chart->lineChart()
            ->setTitle('Car Rental Revenues by Brand')
            ->setSubtitle('Total Rental Revenues for each Brand per Month')
            ->setXAxis($monthNames)
            ->setDataset($chartData);
    }
}
