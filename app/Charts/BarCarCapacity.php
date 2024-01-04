<?php

namespace App\Charts;

use App\Models\FactInventaris;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BarCarCapacity
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $factInventoryData = FactInventaris::join('dim_spek', 'fact_inventaris.sk_spek', '=', 'dim_spek.sk_spek')
            ->groupBy('dim_spek.kapasitas')
            ->selectRaw('dim_spek.kapasitas, SUM(fact_inventaris.jumlah_unit) as total_unit')
            ->orderBy('dim_spek.kapasitas')
            ->get();

        $capacities = $factInventoryData->pluck('kapasitas')->toArray();
        $totalUnits = $factInventoryData->pluck('total_unit')->toArray();

        return $this->chart->barChart()
            ->setTitle('Total Car Units by Capacity')
            ->setSubtitle('Distribution of Car Units by Capacity')
            ->addData('Total Units', $totalUnits)
            ->setXAxis($capacities);
    }
}
