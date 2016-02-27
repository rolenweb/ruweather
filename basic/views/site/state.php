<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = $model_state->name.' weather forecast';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'We specialize in servicing weather forecast and offer you weather forecast '.$model_state->name.'. 2-16 day weather forecast. Current weather forecast.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => '2 day weather forecast '.$model_state->name.'., 3 day weather forecast '.$model_state->name.'., 5 day weather forecast '.$model_state->name.'., 7 day weather forecast '.$model_state->name.'., 10 day weather forecast '.$model_state->name.'., 12 day weather forecast '.$model_state->name.'., 14 day weather forecast '.$model_state->name.'., 16 day weather forecast San '.$model_state->name.'.'
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
                        <h2><?= Html::encode($model_capital->name) ?></h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('img/'.Html::encode($img_wind),['class' => 'img-responsive', 'alt' => $weather_capital->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_capital->wind->speed->getValue()) ?> <?= $weather_capital->wind->speed->getUnit()  ?>
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_capital->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        <?= Html::img('img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_capital->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_capital->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        <?= Html::img('img/'.$weather_capital->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_capital->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_capital->weather->description)) ?>
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
        'model_city' => $model_capital,
        ]);     
  
?> 
              </div>
             </div>
              <div class="row top10">
              <div class="list-cities">
                <div class="title">
                  <h2>Weather forecast for cities of <?= Html::encode($model_state->name) ?></h2>
                </div>
<?php
echo $this->render('table/_state_cities',[
        'array_cities' => $array_cities,
        
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
<?php
echo $this->render('footer');     
?> 
      
      
      
    </div>
<?php



?>