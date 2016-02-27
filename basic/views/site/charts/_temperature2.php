<?php
use yii\web\JsExpression;
use miloschuman\highcharts\Highcharts;
echo HighCharts::widget([
    'scripts' => [
       'highcharts-more',   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
       
    ],
    'options' => [
        //'colors' => $color_legend,
        'chart' => [
                //'type' => 'spline'
        ],
        'title' => [
             'text' => 'Temperature'
             ],
        'xAxis' => [

            'type' => 'datetime',
                'labels' => [
                'format' => $data_chart['format_date'],
                
            ],
            'crosshair' => true,
            
            

        ],
        'yAxis' => [
            'title' => [
                'text' => null
            ],
            'labels' => [
                'formatter' => new JsExpression('function () {return this.value + "F";}')
            ]
           
        ],
        'tooltip' => [
            'crosshairs' => true,
            'shared' => true,
            'valueSuffix' => 'F'
        ],
        
        'series' => [
                [
                    'name' => 'Temperature',
                    
                    'data' => $data_chart['averages'],
                    'zIndex' => 1,
                   
                ],
                [
                    'name' => 'Range',
                    'data' => $data_chart['ranger'],
                    'type' => 'arearange',
                    'lineWidth' => 0,
                    'linkedTo' => ':previous',
                    'color' => new JsExpression('Highcharts.getOptions().colors[0]'),
                    'fillOpacity' => 0.3,
                    'zIndex' => 0
                ]

            
            
        ]
    ]
]);                                
?>