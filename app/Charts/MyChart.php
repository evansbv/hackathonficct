<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class MyChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function My_Chart(){
        $chart = new Chart();
        $chart->labels(['Informatica', 'Sistemas', 'Redes']);
        $chart->dataset('Participantes x Carrera', 'bar', [12, 15, 9 ]);
        $chart->dataset('Participantes x Sexo', 'bar', [10, 18, 8 ]);
        return $chart;
    }
}
