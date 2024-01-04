<?php

namespace App\Charts;

use App\Models\FactRental;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RevenuesNameCar
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $data = FactRental::select(
            'dim_mobil.nama',
            DB::raw('SUM(pendapatan_rental) as total_pendapatan_rental'),
            DB::raw("DATE_FORMAT(dim_waktu.tanggal, '%M') as month_name")
        )
            ->join('dim_mobil', 'fact_rental.sk_mobil', '=', 'dim_mobil.sk_mobil')
            ->join('dim_waktu', 'fact_rental.sk_waktu', '=', 'dim_waktu.sk_waktu')
            ->groupBy('dim_mobil.nama', 'month_name')
            ->orderBy('dim_waktu.tanggal', 'asc') // Menambahkan pengurutan berdasarkan tanggal
            ->get();

        $chartData = [];
        $cars = $data->pluck('nama')->unique();

        foreach ($cars as $car) {
            $carData = $data->where('nama', $car)->pluck('total_pendapatan_rental')->toArray();
            $chartData[] = [
                'name' => $car,
                'data' => $carData,
            ];
        }

        $monthNames = collect($data->pluck('month_name')->unique()->toArray())->map(function ($month) {
            return Carbon::parse("2022-$month-01")->format('F'); // Format nama bulan menggunakan Carbon
        })->values()->toArray(); // Mengubah indeks kembali ke urutan bilangan bulan


        return $this->chart->lineChart()
            ->setTitle('Rental Revenues Car by Date')
            ->setSubtitle('Total Rental Revenues for each Car per Month')
            ->setXAxis($monthNames)
            ->setDataset($chartData);
    }
}
