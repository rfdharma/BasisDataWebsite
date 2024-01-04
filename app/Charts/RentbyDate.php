<?php

namespace App\Charts;

use App\Models\FactRental;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class RentbyDate
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $data = FactRental::select(
            DB::raw('SUM(total_unit_tersewa) as total_unit_tersewa'),
            DB::raw("DATE_FORMAT(dim_waktu.tanggal, '%M') as month_name")
        )
            ->join('dim_waktu', 'fact_rental.sk_waktu', '=', 'dim_waktu.sk_waktu')
            ->groupBy('month_name')
            ->get();

        $totalUnits = $data->sum('total_unit_tersewa');
        $percentages = $data->map(function ($item) use ($totalUnits) {
            return round(($item->total_unit_tersewa / $totalUnits) * 100, 3);
        });

        return $this->chart->pieChart()
            ->setTitle('Percentage of Total Units Rented by Month')
            ->setSubtitle('Distribution of Total Units Rented Across Months')
            ->setDataset($percentages->toArray())
            ->setLabels($data->pluck('month_name')->toArray());
    }


}
