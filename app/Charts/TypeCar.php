<?php

namespace App\Charts;

use App\Models\FactInventaris;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TypeCar
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $factInventoryData = FactInventaris::join('dim_ident_mobil', 'fact_inventaris.sk_ident', '=', 'dim_ident_mobil.sk_ident')
            ->groupBy('dim_ident_mobil.tipe')
            ->selectRaw('dim_ident_mobil.tipe, SUM(fact_inventaris.jumlah_unit) as total_unit')
            ->get();

        $years = $factInventoryData->pluck('tipe')->toArray();
        $unitCounts = $factInventoryData->pluck('total_unit')->toArray();

        return $this->chart->barChart()
            ->setTitle('Total Number of Car Units by Type')
            ->setSubtitle('Total Unit Distribution of Cars by Type')
            ->addData('Jumlah Unit', $unitCounts)
            ->setXAxis($years);
    }
}
