<?php
use yii\helpers\Html;

$this->title = $n_days.' day weather forecast '.$model_city->name.', '.$model_city->state;
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'We specialize in servicing weather forecast and offer you weather forecast '.$model_city->name.', '.$model_city->state.'. '.$n_days.' day weather forecast.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $n_days.' day weather forecast '.$model_city->name.', '.$model_city->state,
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
if ($n_days < 6) {
  echo $this->render('charts/_humidity',[
        'data_humidity' => $data_humidity,
        ]);       
}

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
echo $this->render('list/_forecast2',[
        'model_city' => $model_city,
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
        'n_days' => $n_days,
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
