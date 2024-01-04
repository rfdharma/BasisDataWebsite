<?php

namespace App\Charts;

use App\Models\FactRental;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class FeeProfitBrandCar
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $data = FactRental::select(
            'dim_mobil.brand',
            DB::raw('SUM(keuntungan_denda) as total_keuntungan_denda')
        )
            ->join('dim_mobil', 'fact_rental.sk_mobil', '=', 'dim_mobil.sk_mobil')
            ->groupBy('dim_mobil.brand')
            ->orderBy('total_keuntungan_denda', 'desc') // Optional: Untuk mengurutkan berdasarkan total_keuntungan_denda
            ->get();

        $brandNames = $data->pluck('brand')->toArray();
        $totalProfits = $data->pluck('total_keuntungan_denda')->toArray();

        return $this->chart->barChart()
            ->setTitle('Fine Profit by Brand')
            ->setSubtitle('Total Profit for each Brand')
            ->addData('Total Profit/Loss', $totalProfits)
            ->setColors(['#FFC107'])
            ->setXAxis($brandNames);
    }
}
