<?php

namespace App\Charts;

use App\Models\FactRental;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class RevenuesbyMonth
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $data = FactRental::select(
            DB::raw('SUM(fact_rental.pendapatan_rental) as total_rental_income'),
            DB::raw("DATE_FORMAT(dim_waktu.tanggal, '%M') as month_name")
        )
            ->join('dim_waktu', 'fact_rental.sk_waktu', '=', 'dim_waktu.sk_waktu')
            ->groupBy('month_name')
            ->orderByRaw('MONTH(dim_waktu.tanggal) ASC')  // Menambahkan perintah orderByRaw untuk mengurutkan berdasarkan bulan
            ->get();

        $totalRentalIncome = $data->pluck('total_rental_income')->toArray();
        $labels = $data->pluck('month_name')->toArray();

        return $this->chart->barChart()
            ->setTitle('Total Rental Income by Month')
            ->setSubtitle('Monthly Overview of Total Rental Income')
            ->addData('Total Rental Income', $totalRentalIncome)
            ->setXAxis($labels);
    }

}
