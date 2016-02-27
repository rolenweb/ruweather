<?php
use yii\helpers\Html;
?>
                <div class="table-responsive table-cities">
                  <table class="table table-bordered">
<?php
if ($array_cities != NULL) {
  for ($i=0; $i < count($array_cities); $i++) { 
?>
                    <tr>
                      <td>
<?php
  if ($array_cities[$i] != NULL) {
      echo  Html::a($array_cities[$i]['name'],['site/index', 'state' => strtolower($array_cities[$i]['state']), 'city' => $array_cities[$i]['id_city']],['title' => 'Weather forecast '.$array_cities[$i]['name'].', '.$array_cities[$i]['state']]);
      $i++; 
  } 
    
?>
                      </td>
                      <td>
<?php 
  if ($array_cities[$i] != NULL) {
      echo  Html::a($array_cities[$i]['name'],['site/index', 'state' => strtolower($array_cities[$i]['state']), 'city' => $array_cities[$i]['id_city']],['title' => 'Weather forecast '.$array_cities[$i]['name'].', '.$array_cities[$i]['state']]);
      $i++; 
  } 
?>                        
                      </td>
                      <td>
<?php 
  if ($array_cities[$i] != NULL) {
      echo  Html::a($array_cities[$i]['name'],['site/index', 'state' => strtolower($array_cities[$i]['state']), 'city' => $array_cities[$i]['id_city']],['title' => 'Weather forecast '.$array_cities[$i]['name'].', '.$array_cities[$i]['state']]);
      $i++; 
  } 
?>                        
                      </td>
                      <td>
<?php 
  if ($array_cities[$i] != NULL) {
      echo  Html::a($array_cities[$i]['name'],['site/index', 'state' => strtolower($array_cities[$i]['state']), 'city' => $array_cities[$i]['id_city']],['title' => 'Weather forecast '.$array_cities[$i]['name'].', '.$array_cities[$i]['state']]);
    
  }       
?>                        
                      </td>
                    </tr>
<?php    
  }
}
?>                  
                    
                  </table>
                </div>