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
             'text' => 'Humidity'
             ],
        'xAxis' => [

            'type' => 'datetime',
                'labels' => [
                    'format' => $data_humidity['format_date'],
                ],
            'crosshair' => true,
            
            
            

        ],
        'yAxis' => [
            'title' => [
                'text' => 'Humidity'
            ],
            'labels' => [
                'formatter' => new JsExpression('function () {return this.value + "%";}')
            ]
        ],
        'tooltip' => [
            'crosshairs' => true,
            'shared' => true,
            'valueSuffix' => '%'
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
                    'name' => 'Humidity',
                    
                    'data' => $data_humidity['data_humidity'],
                ]

            
            
        ]
    ]
]);                                
?>