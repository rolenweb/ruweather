<?php
use yii\web\JsExpression;
use miloschuman\highcharts\Highcharts;
echo HighCharts::widget([
    'options' => [
        //'colors' => $color_legend,
        'chart' => [
                'type' => 'column'
        ],
        'title' => [
             'text' => 'Pressure'
             ],
        'xAxis' => [

            'type' => 'datetime',
                'labels' => [
                    'format' => $data_pressure['format_date'],
                ],
            'crosshair' => true,
        ],
        'yAxis' => [
            'min' => $data_pressure['min'],
            'max' => $data_pressure['max'],
            'title' => [
                'text' => 'Pressure(hPa)'
            ],
            'labels' => [
                'formatter' => new JsExpression('function () {return this.value + "";}')
            ]
        ],
        'tooltip' => [
            'crosshairs' => true,
            'shared' => true,
            'valueSuffix' => 'hPa'
        ],
        'plotOptions' => [
            'spline' => [
                'marker' => [
                    'radius' => 1,
                    'lineColor' => '#DDDDDD',
                    'lineWidth' => 1
                ]
            ]
        ],
        'series' => [
                [
                    'name' => 'Pressure',
                    'data' => $data_pressure['data_pressure'],
                ]

            
            
        ]
    ]
]);                                
?>