<?php

namespace App\Charts;

use App\Models\DimSpek;
use App\Models\FactInventaris;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TransmissionCarCount
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
            ->groupBy('dim_spek.transmisi')
            ->selectRaw('dim_spek.transmisi, SUM(fact_inventaris.jumlah_unit) as total_unit')
            ->get();

        $transmissions = $factInventoryData->pluck('transmisi')->toArray();
        $unitCounts = $factInventoryData->pluck('total_unit')->toArray();

        $percentages = array_map(function ($count) use ($totalUnits) {
            return ($totalUnits > 0) ? round(($count / $totalUnits) * 100, 3) : 0;
        }, $unitCounts);

        return $this->chart->pieChart()
            ->setTitle('Unit Car Transmission Percentage')
            ->setSubtitle('Percentage Distribution of Cars by Transmission Type')
            ->addData($percentages)
            ->setColors(['#00E396', '#0077B5'])
            ->setLabels($transmissions);
    }
}
