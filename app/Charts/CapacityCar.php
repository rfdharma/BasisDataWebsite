<?php

namespace App\Charts;

use App\Models\FactInventaris;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class CapacityCar
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {

        $totalUnits = FactInventaris::sum('jumlah_unit');

        $factInventoryData = FactInventaris::join('dim_spek', 'fact_inventaris.sk_spek', '=', 'dim_spek.sk_spek')
            ->groupBy('dim_spek.kapasitas')
            ->selectRaw('dim_spek.kapasitas, SUM(fact_inventaris.jumlah_unit) as total_unit')
            ->get();

        $years = $factInventoryData->pluck('kapasitas')->toArray();
        $unitCounts = $factInventoryData->pluck('total_unit')->toArray();

        $percentages = array_map(function ($count) use ($totalUnits) {
            return ($totalUnits > 0) ? round(($count / $totalUnits) * 100, 3) : 0;
        }, $unitCounts);

        return $this->chart->pieChart()
            ->setTitle('Unit Car Capacity Percentage')
            ->setSubtitle('Percentage Distribution of Car Units by Capacity')
            ->addData($percentages)
            ->setColors(['#3490dc', '#FFC107', '#ff6384', '#775dd0'])
            ->setLabels($years);
    }
}
