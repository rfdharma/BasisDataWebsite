<?php

namespace App\Charts;

use App\Models\DimSpek;
use App\Models\FactInventaris;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class CarYearCount
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
            ->groupBy('dim_spek.tahun_produksi')
            ->selectRaw('dim_spek.tahun_produksi, SUM(fact_inventaris.jumlah_unit) as total_unit')
            ->get();

        $years = $factInventoryData->pluck('tahun_produksi')->toArray();
        $unitCounts = $factInventoryData->pluck('total_unit')->toArray();

        $percentages = array_map(function ($count) use ($totalUnits) {
            return ($totalUnits > 0) ? round(($count / $totalUnits) * 100, 3) : 0;
        }, $unitCounts);

        return $this->chart->pieChart()
            ->setTitle('Unit Car Year Percentage')
            ->setSubtitle('Percentage Distribution of Car Units by Production Year')
            ->addData($percentages)
            ->setColors(['#FFC107','#775dd0'])
            ->setLabels($years);
    }
}
