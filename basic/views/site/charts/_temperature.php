<?php
use yii\web\JsExpression;
use miloschuman\highcharts\Highcharts;
echo HighCharts::widget([
    'options' => [
        //'colors' => $color_legend,
        'chart' => [
                'type' => 'spline'
        ],
        'title' => [
             'text' => 'Temperature'
             ],
        'xAxis' => [

            'categories' => $data_chart['cat'],
            'crosshair' => true,
            
            

        ],
        'yAxis' => [
            'title' => [
                'text' => 'Temperature'
            ],
            'labels' => [
                'formatter' => new JsExpression('function () {return this.value + "°";}')
            ]
        ],
        'tooltip' => [
            'crosshairs' => true,
            'shared' => true,
            'valueSuffix' => 'F'
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
                    'name' => 'Temperature',
                    
                    'data' => $data_chart['data_temp'],
                ]

            
            
        ]
    ]
]);                                
?>