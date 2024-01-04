<?php

namespace App\Charts;

use App\Models\FactRental;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class RentbyType
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $data = FactRental::select(
            'dim_mobil.tipe',
            DB::raw('SUM(total_unit_tersewa) as total_unit_tersewa')
        )
            ->join('dim_mobil', 'fact_rental.sk_mobil', '=', 'dim_mobil.sk_mobil')
            ->groupBy('tipe')
            ->get();

        $totalUnits = $data->sum('total_unit_tersewa');
        $percentages = $data->map(function ($item) use ($totalUnits) {
            return round(($item->total_unit_tersewa / $totalUnits) * 100, 3);
        });

        return $this->chart->pieChart()
            ->setTitle('Percentage of Total Units Rented by Type')
            ->setSubtitle('Distribution of Total Units Rented by Car Type')
            ->addData($percentages->toArray())
            ->setLabels($data->pluck('tipe')->toArray());
    }
}
