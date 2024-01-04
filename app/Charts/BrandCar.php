<?php

namespace App\Charts;

use App\Models\FactInventaris;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BrandCar
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $factInventoryData = FactInventaris::join('dim_ident_mobil', 'fact_inventaris.sk_ident', '=', 'dim_ident_mobil.sk_ident')
            ->groupBy('dim_ident_mobil.brand')
            ->selectRaw('dim_ident_mobil.brand, SUM(fact_inventaris.jumlah_unit) as total_unit')
            ->get();

        $years = $factInventoryData->pluck('brand')->toArray();
        $unitCounts = $factInventoryData->pluck('total_unit')->toArray();

        return $this->chart->barChart()
            ->setTitle('Total Number of Car Units by Brand')
            ->setSubtitle('Total Unit Distribution of Cars by Brand')
            ->addData('Jumlah Unit', $unitCounts)
            ->setColors(['#ff6384'])
            ->setXAxis($years);
    }
}
