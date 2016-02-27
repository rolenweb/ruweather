<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Weather forecast USA';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'We specialize in servicing weather forecast and offer you weather forecast USA. 2-16 day weather forecast. Current weather forecast.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => '2 day weather forecast New Your, 3 day weather forecast Los Angeles, 5 day weather forecast Chicago, 7 day weather forecast Houston, 10 day weather forecast Philadelphia, 12 day weather forecast Phoenix, 14 day weather forecast San Antonio, 16 day weather forecast San Diego'
]);
?>
<div class="container">
      <div class="row">
        <div class="col-sm-9">
          <div class="header">
            <div class="row">
              
              <div class="col-sm-12 title"><h1>Weather forecast USA</h1></div>
              
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
                        <h2>New York</h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('img/'.Html::encode($array_img_wind['new_york']),['class' => 'img-responsive', 'alt' => $weather_new_york->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_new_york->wind->speed->getValue()) ?> <?= $weather_new_york->wind->speed->getUnit()  ?>
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_new_york->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        
                        <?= Html::img('img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_new_york->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_new_york->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        
                        <?= Html::img('img/'.$weather_new_york->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_new_york->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_new_york->weather->description)) ?>
                        </div>
                      </div>   
                    </div>
                  </div>
                </div>
              </div>
              <div class="visible-xs-block">
                <div class="top20"></div>
              </div>
              <div class="col-sm-6">
                <div class="single-home">
                  <div class="row">
                    <div class="col-xs-9">
                      <div class="title-city">
                        <h2>Los Angeles</h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('img/'.Html::encode($array_img_wind['los_angeles']),['class' => 'img-responsive', 'alt' => $weather_los_angeles->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_los_angeles->wind->speed->getValue()) ?> <?= $weather_new_york->wind->speed->getUnit()  ?>
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_los_angeles->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        
                        <?= Html::img('img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_los_angeles->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_los_angeles->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        
                        <?= Html::img('img/'.$weather_los_angeles->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_los_angeles->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_los_angeles->weather->description)) ?>
                        </div>
                      </div>   
                    </div>
                  </div>
                </div>
              </div>
              <!--
             </div>
             <div class="row top20">
             -->
              <div class="visible-xs-block">
                <div class="top20"></div>
              </div>
              <div class="col-xs-12 top20"></div>
              <div class="col-sm-6">
                <div class="single-home">
                  <div class="row">
                    <div class="col-xs-9">
                      <div class="title-city">
                        <h2>Chicago</h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('img/'.Html::encode($array_img_wind['chicago']),['class' => 'img-responsive', 'alt' => $weather_chicago->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_chicago->wind->speed->getValue()) ?> <?= $weather_new_york->wind->speed->getUnit()  ?>
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_chicago->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        
                        <?= Html::img('img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_chicago->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_chicago->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        
                        <?= Html::img('img/'.$weather_chicago->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_chicago->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_chicago->weather->description)) ?>
                        </div>
                      </div>   
                    </div>
                  </div>
                </div>
              </div>
              <div class="visible-xs-block">
                <div class="top20"></div>
              </div>
              <div class="col-sm-6">
                <div class="single-home">
                  <div class="row">
                    <div class="col-xs-9">
                      <div class="title-city">
                        <h2>Houston</h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('img/'.Html::encode($array_img_wind['houston']),['class' => 'img-responsive', 'alt' => $weather_houston->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_houston->wind->speed->getValue()) ?> <?= $weather_new_york->wind->speed->getUnit()  ?>
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_houston->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        
                        <?= Html::img('img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_houston->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_houston->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        
                        <?= Html::img('img/'.$weather_houston->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_houston->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_houston->weather->description)) ?>
                        </div>
                      </div>   
                    </div>
                  </div>
                </div>
              </div>
              <div class="visible-xs-block">
                <div class="top20"></div>
              </div>
              <div class="col-xs-12 top20"></div>
              <div class="col-sm-6">
                <div class="single-home">
                  <div class="row">
                    <div class="col-xs-9">
                      <div class="title-city">
                        <h2>Philadelphia</h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('img/'.Html::encode($array_img_wind['philadelphia']),['class' => 'img-responsive', 'alt' => $weather_philadelphia->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_philadelphia->wind->speed->getValue()) ?> <?= $weather_new_york->wind->speed->getUnit()  ?>
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_philadelphia->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        
                        <?= Html::img('img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_philadelphia->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_philadelphia->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        
                        <?= Html::img('img/'.$weather_philadelphia->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_philadelphia->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_philadelphia->weather->description)) ?>
                        </div>
                      </div>   
                    </div>
                  </div>
                </div>
              </div>
              <div class="visible-xs-block">
                <div class="top20"></div>
              </div>
               <div class="col-sm-6">
                <div class="single-home">
                  <div class="row">
                    <div class="col-xs-9">
                      <div class="title-city">
                        <h2>Phoenix</h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('img/'.Html::encode($array_img_wind['phoenix']),['class' => 'img-responsive', 'alt' => $weather_phoenix->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_phoenix->wind->speed->getValue()) ?> <?= $weather_new_york->wind->speed->getUnit()  ?> 
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_phoenix->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        
                        <?= Html::img('img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_phoenix->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_phoenix->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        
                        <?= Html::img('img/'.$weather_phoenix->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_phoenix->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_phoenix->weather->description)) ?>
                        </div>
                      </div>   
                    </div>
                  </div>
                </div>
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