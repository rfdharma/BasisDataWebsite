<?php

namespace App\Charts;

use App\Models\FactRental;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TopRentCar
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {
        $topCars = FactRental::select(
            'dim_mobil.nama',
            DB::raw('SUM(total_unit_tersewa) as total_units'),
            DB::raw("DATE_FORMAT(dim_waktu.tanggal, '%M') as month_name")
        )
            ->join('dim_mobil', 'fact_rental.sk_mobil', '=', 'dim_mobil.sk_mobil')
            ->join('dim_waktu', 'fact_rental.sk_waktu', '=', 'dim_waktu.sk_waktu')
            ->groupBy('dim_mobil.nama', 'month_name')
            ->orderBy('month_name', 'asc')
            ->get();

        $carNames = $topCars->pluck('nama')->unique()->toArray();
        $months = $topCars->pluck('month_name')->unique()->toArray();
        $datasets = [];

        foreach ($months as $month) {
            $units = $topCars->where('month_name', $month)->pluck('total_units')->toArray();
            $datasets[] = [
                'name' => $month,
                'data' => $units,
            ];
        }

        return $this->chart->horizontalBarChart()
            ->setTitle('Top Rented Cars Monthly')
            ->setSubtitle('Based on Total Units Rented')
            ->setColors(['#FFC107', '#775dd0', '#4caf50', '#2196f3', '#f44336', '#ff9800', '#607d8b']) // Adjust colors as needed
            ->setXAxis($carNames)
            ->setDataset($datasets);

    }
}
