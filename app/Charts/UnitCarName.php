<?php

namespace App\Charts;

use App\Models\FactInventaris;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UnitCarName
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {
        $factInventoryData = FactInventaris::join('dim_ident_mobil', 'fact_inventaris.sk_ident', '=', 'dim_ident_mobil.sk_ident')
            ->orderBy('fact_inventaris.jumlah_unit', 'desc')
            ->get(['dim_ident_mobil.nama', 'fact_inventaris.jumlah_unit']);

        $carNames = $factInventoryData->pluck('nama')->toArray();
        $jumlahUnit = $factInventoryData->pluck('jumlah_unit')->toArray();

        return $this->chart->horizontalBarChart()
            ->setTitle('Jumlah Unit Berdasarkan Nama Mobil')
            ->setSubtitle('Total Number of Units Based on Car Names')
            ->setColors(['#FFC107'])
            ->addData('Jumlah Unit', $jumlahUnit)
            ->setXAxis($carNames);
    }
}
