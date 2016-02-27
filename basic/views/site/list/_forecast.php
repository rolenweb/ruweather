<?php
use yii\helpers\Html;
?>
                <div class="row">
                  <div class="col-xs-4">
                      <ul class="list-group">
                        <li class="list-group-item forecast">
                          <?= Html::a('2 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 2],['title' => '2 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                        <li class="list-group-item forecast">
                          <?= Html::a('3 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 3],['title' => '3 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                        <li class="list-group-item forecast">
                          <?= Html::a('4 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 4],['title' => '4 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                        <li class="list-group-item forecast">
                          <?= Html::a('5 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 5],['title' => '5 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                        <li class="list-group-item forecast">
                          <?= Html::a('6 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 6],['title' => '6 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                      </ul>
                  </div>
                  <div class="col-xs-4">
                      <ul class="list-group">
                        <li class="list-group-item forecast">
                          <?= Html::a('7 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 7],['title' => '7 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                        <li class="list-group-item forecast">
                          <?= Html::a('8 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 8],['title' => '8 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                        <li class="list-group-item forecast">
                          <?= Html::a('9 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 9],['title' => '9 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                        <li class="list-group-item forecast">
                          <?= Html::a('10 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 10],['title' => '10 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                        <li class="list-group-item forecast">
                          <?= Html::a('11 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 11],['title' => '11 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                      </ul>
                  </div>
                  <div class="col-xs-4">
                      <ul class="list-group">
                        <li class="list-group-item forecast">
                          <?= Html::a('12 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 12],['title' => '12 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                        <li class="list-group-item forecast">
                          <?= Html::a('13 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 13],['title' => '13 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                        <li class="list-group-item forecast">
                          <?= Html::a('14 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 14],['title' => '14 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                        <li class="list-group-item forecast">
                          <?= Html::a('15 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 15],['title' => '15 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                        <li class="list-group-item forecast">
                          <?= Html::a('16 days',['site/index', 'state' => strtolower($model_city->state), 'city' => $model_city->id_city, 'day' => 16],['title' => '16 day weather forecast '.$model_city->name.', '.$model_city->state]) ?>
                        </li>
                      </ul>
                  </div>
                </div>