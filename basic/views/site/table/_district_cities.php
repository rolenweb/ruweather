<?php
use yii\helpers\Html;

echo Html::beginTag('div',['class' => 'row']);
  if ($cities != NULL) {
    foreach ($cities as $city){   
      echo Html::beginTag('div',['class' => 'col-sm-4']);
        echo  Html::a($city->name,['site/index', 'region' => $region->id, 'district' => $district->id, 'city' => $city->city_id],['title' => 'Прогноз погоды '.$city->name.', '.$district->name.', '.$region->name, 'class' => 'btn btn-default top10']);
      echo Html::endTag('div');
    }
  }
echo Html::endTag('div');
?>