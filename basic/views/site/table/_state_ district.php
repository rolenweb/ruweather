<?php
use yii\helpers\Html;

echo Html::beginTag('div',['class' => 'row']);
  if ($region->districts != NULL) {
    foreach ($region->districts as $district){   
      echo Html::beginTag('div',['class' => 'col-sm-4']);
        echo  Html::a($district->name,['site/index', 'region' => $region->id, 'district' => $district->id],['title' => 'Прогноз погоды '.$district->name.', '.$region->name, 'class' => 'btn btn-default top10']);
      echo Html::endTag('div');
    }
  }
echo Html::endTag('div');
?>