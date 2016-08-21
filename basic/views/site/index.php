<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Прогноз погоды в России';
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
              
              <div class="col-sm-12 title"><h1>Прогноз погоды в России</h1></div>
              
            </div>
          </div>
        </div>
        <div class="col-sm-3">
<?php
//echo $this->render('list/_navbar',[
        //'model_city' => $model_city,
        //'array_for_typeahead' => $array_for_typeahead,
        //'model_search' => $model_search,
   //     ]);     
?>                          
          
            
         
        </div>
      </div>
      <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="content">
              <div class="row">
                <div class="col-sm-12">
                  <?= Html::beginTag('form',['name' => 'search-city']) ?>
                  <?= Html::input('text', 'search', '', ['class' => 'form-control', 'placeholder' => 'Найти город']) ?>
                  <?= Html::endTag('form') ?>
                </div>
              </div>  
             <div class="row top20">
              <div class="col-sm-6">
                <div class="single-home">
                  <div class="row">
                    <div class="col-xs-9">
                      <div class="title-city">
                        <h2>Москва</h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('img/'.Html::encode($array_img_wind['moscow']),['class' => 'img-responsive', 'alt' => $weather_moscow->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_moscow->wind->speed->getValue()) ?> <?= $weather_moscow->wind->speed->getUnit()  ?>
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_moscow->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        
                        <?= Html::img('img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_moscow->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_moscow->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        
                        <?= Html::img('img/'.$weather_moscow->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_moscow->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_moscow->weather->description)) ?>
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
                        <h2>Новосибирск</h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('img/'.Html::encode($array_img_wind['novosib']),['class' => 'img-responsive', 'alt' => $weather_novosib->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_novosib->wind->speed->getValue()) ?> <?= $weather_novosib->wind->speed->getUnit()  ?>
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_novosib->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        
                        <?= Html::img('img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_novosib->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_novosib->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        
                        <?= Html::img('img/'.$weather_novosib->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_novosib->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_novosib->weather->description)) ?>
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
                        <h2>Санкт-Петербург</h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('img/'.Html::encode($array_img_wind['piter']),['class' => 'img-responsive', 'alt' => $weather_piter->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_piter->wind->speed->getValue()) ?> <?= $weather_piter->wind->speed->getUnit()  ?>
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_piter->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        
                        <?= Html::img('img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_piter->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_piter->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        
                        <?= Html::img('img/'.$weather_piter->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_piter->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_piter->weather->description)) ?>
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
                        <h2>Нижний Новгород</h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('img/'.Html::encode($array_img_wind['nizhny_novgorod']),['class' => 'img-responsive', 'alt' => $weather_nizhny_novgorod->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_nizhny_novgorod->wind->speed->getValue()) ?> <?= $weather_nizhny_novgorod->wind->speed->getUnit()  ?>
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_nizhny_novgorod->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        
                        <?= Html::img('img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_nizhny_novgorod->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_nizhny_novgorod->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        
                        <?= Html::img('img/'.$weather_nizhny_novgorod->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_nizhny_novgorod->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_nizhny_novgorod->weather->description)) ?>
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
                        <h2>Екатеринбург</h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('img/'.Html::encode($array_img_wind['eburg']),['class' => 'img-responsive', 'alt' => $weather_eburg->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_eburg->wind->speed->getValue()) ?> <?= $weather_eburg->wind->speed->getUnit()  ?>
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_eburg->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        
                        <?= Html::img('img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_eburg->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_eburg->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        
                        <?= Html::img('img/'.$weather_eburg->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_eburg->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_eburg->weather->description)) ?>
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
                        <h2>Самара</h2>  
                      </div>
                      
                    </div>
                    <div class="col-xs-3">
                      <div class="wind">
                        <div class="deg">
                          
                          <?= Html::img('img/'.Html::encode($array_img_wind['samara']),['class' => 'img-responsive', 'alt' => $weather_samara->wind->direction->getDescription()]) ?>                          
                        </div>
                        <div class="speed">
                          <?= floor($weather_samara->wind->speed->getValue()) ?> <?= $weather_samara->wind->speed->getUnit()  ?> 
                        </div>
                            
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <div class="temp">
                        <div class="number">
                          <?= floor($weather_samara->temperature->getValue()) ?>&deg;
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="thumbnail humidity">
                        
                        <?= Html::img('img/humidity.png',['class' => 'img-responsive', 'alt' => 'Humidity '.$weather_samara->humidity->getValue().'%']) ?> 
                        <div class="capimghome">
                          <?= floor($weather_samara->humidity->getValue()) ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="thumbnail">
                        
                        <?= Html::img('img/'.$weather_samara->weather->icon.'.png',['class' => 'img-responsive', 'alt' => $weather_samara->weather->description]) ?>
                        <div class="capimghome">
                          <?= Html::encode(ucfirst($weather_samara->weather->description)) ?>
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
        //'array_for_typeahead' => $array_for_typeahead,
        //'model_search' => $model_search,
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