<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Прогноз погоды: '.$district->name.', '.$region->name;
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
/*echo $this->render('list/_navbar',[
        'model_city' => $model_city,
        'array_for_typeahead' => $array_for_typeahead,
        'model_search' => $model_search,
        ]);     */
?>
         
        </div>
      </div>
      <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="content">
             
              <div class="row">
              <div class="list-cities">
                <div class="title">
                  <h2><?= Html::encode($district->name) ?> - прогноз погоды для населенных пунктов </h2>
                </div>
<?php
echo $this->render('table/_district_cities',[
        'cities' => $cities, 
        'district' => $model_district,
        'region' => $model_region,
        
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