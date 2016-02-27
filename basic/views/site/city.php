<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Current Weather '.$model_city->name.', '.$model_city->state;
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'We specialize in servicing weather forecast and offer you weather forecast '.$model_city->name.', '.$model_city->state.'. 2-16 day weather forecast. Current weather forecast.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => '2 day weather forecast '.$model_city->name.', 3 day weather forecast '.$model_city->name.', 5 day weather forecast '.$model_city->name.', 7 day weather forecast '.$model_city->name.', 10 day weather forecast '.$model_city->name.', 12 day weather forecast '.$model_city->name.', 14 day weather forecast '.$model_city->name.', 16 day weather forecast '.$model_city->name.''
]);
$this->registerMetaTag([
    'name' => 'geo.placename',
    'content' => $model_city->name.', '.strtoupper($model_city->state).', USA',
]);
$this->registerMetaTag([
    'name' => 'geo.position',
    'content' => $model_city->coord_lat.', '.$model_city->coord_lon,
]);
$this->registerMetaTag([
    'name' => 'geo.region',
    'content' => 'US, '.strtoupper($model_city->state),
]);
$this->registerMetaTag([
    'name' => 'ICBM',
    'content' => $model_city->coord_lat.', '.$model_city->coord_lon,
]);


?>
<div class="container">
      <div class="row">
        <div class="col-sm-9">
          <div class="header">
            <div class="row">
              
              <div class="col-sm-12 title"><h1><?= Html::encode($this->title) ?></h1></div>
              
            </div>
          </div>
        </div>
        <div class="col-sm-3">
         
<?php
echo $this->render('list/_navbar',[
        'model_city' => $model_city,
        'array_for_typeahead' => $array_for_typeahead,
        'model_search' => $model_search,
        ]);     
?>
         
        </div>
      </div>
      <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="content">
             <div class="row">
              <div class="col-sm-6">
                <div class="single-home">
                  <div class="row">
                    <div class="col-xs-9">
                      <div class="title-city">
                        <h2><?= Html::encode($model_city->name) ?></h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('../img/'.Html::encode($img_wind_now),['class' => 'img-responsive', 'alt' => $weather_now->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_now->wind->speed->getValue()) ?> <?= $weather_now->wind->speed->getUnit()  ?>
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_now->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        <?= Html::img('../img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_now->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_now->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        <?= Html::img('../img/'.$weather_now->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_now->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_now->weather->description)) ?>
                        </div>
                      </div>   
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="visible-xs-block">
                  <div class="top20"></div>
                </div>
<?php
echo $this->render('list/_forecast',[
        'model_city' => $model_city,
        ]);     
  
?>                 
                
              </div>
             </div>
            <div class="row top10">
              <div class="col-sm-12">
<?php
echo $this->render('charts/_temperature2',[
        'data_chart' => $data_chart,
        ]);     
  
?>                 
              </div>
            </div>
            <div class="row top10">
              <div class="col-sm-12">
<?php
echo $this->render('charts/_pressure',[
        'data_pressure' => $data_pressure,
        ]);     
?>                 
              </div>
            </div>
            <div class="row top10">
              <div class="col-sm-12">
<?php
echo $this->render('charts/_humidity',[
        'data_humidity' => $data_humidity,
        ]);     
?>                 
              </div>
            </div>
            <div class="row top10">
              <div class="col-sm-12">
<?php
echo $this->render('charts/_wind',[
        'data_wind' => $data_wind,
        ]);     
?>                 
              </div>
            </div>
            <div class="row top10">
              <div class="col-sm-12">
<?php
echo $this->render('table/_near_city',[
        'near_city' => $near_city,
        'model_city' => $model_city,
        ]);     
?>                 
              </div>
            </div>
            </div>
          </div>
          
          <div class="visible-md-block visible-lg-block">
<?php
echo $this->render('sidebar/_sidebar',[
        'array_states' => $array_states,
        'array_for_typeahead' => $array_for_typeahead,
        'model_search' => $model_search,
        ]);     
?>            
            
          </div>
      </div>
      <div class="row footer">
        <div class="col-xs-12">
<?php
echo $this->render('footer');     
?>           
        </div>
      </div>
      
      
      
    </div>
<?php



?>