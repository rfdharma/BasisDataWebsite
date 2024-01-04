<?php

namespace App\Charts;

use App\Models\FactInventaris;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BarCarTransmission
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $factInventoryData = FactInventaris::join('dim_spek', 'fact_inventaris.sk_spek', '=', 'dim_spek.sk_spek')
            ->groupBy('dim_spek.transmisi')
            ->selectRaw('dim_spek.transmisi, SUM(fact_inventaris.jumlah_unit) as total_unit')
            ->orderBy('dim_spek.transmisi')
            ->get();

        $transmissions = $factInventoryData->pluck('transmisi')->toArray();
        $totalUnits = $factInventoryData->pluck('total_unit')->toArray();

        return $this->chart->barChart()
            ->setTitle('Total Car Units by Transmission Type')
            ->setSubtitle('Distribution of Car Units by Transmission Type')
            ->addData('Total Units', $totalUnits)
            ->setColors(['#303F9F'])
            ->setXAxis($transmissions);
    }
}
