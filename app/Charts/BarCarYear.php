<?php

namespace App\Charts;

use App\Models\FactInventaris;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BarCarYear
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $factInventoryData = FactInventaris::join('dim_spek', 'fact_inventaris.sk_spek', '=', 'dim_spek.sk_spek')
            ->groupBy('dim_spek.tahun_produksi')
            ->selectRaw('dim_spek.tahun_produksi, SUM(fact_inventaris.jumlah_unit) as total_unit')
            ->orderBy('dim_spek.tahun_produksi')
            ->get();

        $years = $factInventoryData->pluck('tahun_produksi')->toArray();
        $totalUnits = $factInventoryData->pluck('total_unit')->toArray();

        return $this->chart->barChart()
            ->setTitle('Total Car Units by Production Year')
            ->setSubtitle('Distribution of Car Units by Production Year')
            ->addData('Total Units', $totalUnits)
            ->setColors(['#FFC107', '#303F9F'])
            ->setXAxis($years);
    }
}
