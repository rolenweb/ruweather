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
             'text' => 'Wind'
             ],
        'xAxis' => [

            'type' => 'datetime',
                'labels' => [
                    'format' => $data_wind['format_date'],
                ],
            'crosshair' => true,

        ],
        'yAxis' => [
            'title' => [
                'text' => 'Wind speed (mph)'
            ],
            'labels' => [
                'formatter' => new JsExpression('function () {return this.value + "";}')
            ],
            'minorGridLineWidth' => 0,
            'gridLineWidth' => 0,
            'alternateGridColor' => null,
            'plotBands' => [
                [
                    'from' => 0,
                    'to' => 2,
                    'color' => '#FFFFFF',
                    'label' => [
                        'text' => 'Calm',
                        'style' => [
                            'color' => '#606060',
                        ]
                    ],
                ],
                [
                    'from' => 2,
                    'to' => 4,
                    'color' => '#CCFFFF',
                    'label' => [
                        'text' => 'Light air',
                        'style' => [
                            'color' => '#606060',
                        ]
                    ],
                ],
                [
                    'from' => 4,
                    'to' => 8,
                    'color' => '#99FFCC',
                    'label' => [
                        'text' => 'Light breeze',
                        'style' => [
                            'color' => '#606060',
                        ]
                    ],
                ],
                [
                    'from' => 8,
                    'to' => 12,
                    'color' => '#99FF99',
                    'label' => [
                        'text' => 'Gentle breeze',
                        'style' => [
                            'color' => '#606060',
                        ]
                    ],
                ],
                [
                    'from' => 12,
                    'to' => 18,
                    'color' => '#99FF66',
                    'label' => [
                        'text' => 'Moderate breeze',
                        'style' => [
                            'color' => '#606060',
                        ]
                    ],
                ],
                [
                    'from' => 18,
                    'to' => 24,
                    'color' => '#99FF00',
                    'label' => [
                        'text' => 'Fresh breeze',
                        'style' => [
                            'color' => '#606060',
                        ]
                    ],
                ],
                [
                    'from' => 24,
                    'to' => 31,
                    'color' => '#CCFF00',
                    'label' => [
                        'text' => 'Strong breeze',
                        'style' => [
                            'color' => '#606060',
                        ]
                    ],
                ],
                [
                    'from' => 31,
                    'to' => 38,
                    'color' => '#FFFF00',
                    'label' => [
                        'text' => 'High wind, moderate gale, near gale',
                        'style' => [
                            'color' => '#606060',
                        ]
                    ],
                ],
                [
                    'from' => 38,
                    'to' => 46,
                    'color' => '#FFCC00',
                    'label' => [
                        'text' => 'Gale, fresh gale',
                        'style' => [
                            'color' => '#606060',
                        ]
                    ],
                ],
                [
                    'from' => 46,
                    'to' => 54,
                    'color' => '#FF9900',
                    'label' => [
                        'text' => 'Strong/severe gale',
                        'style' => [
                            'color' => '#606060',
                        ]
                    ],
                ],
                [
                    'from' => 54,
                    'to' => 63,
                    'color' => '#FF6600',
                    'label' => [
                        'text' => 'Storm, whole gale',
                        'style' => [
                            'color' => '#606060',
                        ]
                    ],
                ],
                [
                    'from' => 63,
                    'to' => 72,
                    'color' => '#FF3300',
                    'label' => [
                        'text' => 'Violent storm',
                        'style' => [
                            'color' => '#606060',
                        ]
                    ],
                ],
                [
                    'from' => 72,
                    'to' => 1000,
                    'color' => '#FF0000',
                    'label' => [
                        'text' => 'Hurricane force',
                        'style' => [
                            'color' => '#606060',
                        ]
                    ],
                ],
            ],

        ],
        'tooltip' => [
            'crosshairs' => true,
            'shared' => true,
            'valueSuffix' => ' mph'
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
                    'name' => 'Wind',
                    'data' => $data_wind['data_wind'],
                ]

            
            
        ]
    ]
]);                                
?>