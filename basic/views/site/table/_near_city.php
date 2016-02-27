<?php
use yii\helpers\Html;
if ($near_city != NULL) {
?>
				<h3>We Cover These Cities Near <?= Html::encode($model_city->name.', '.$model_city->state) ?></h3>
				<div class="btn-group" role="group" aria-label="Near cities">
<?php
	foreach ($near_city as $city) {
		echo Html::tag('div',Html::a($city->name.', '.$city->state,['site/index', 'state' => strtolower($city->state), 'city' => $city->id_city, 'day' => $n_days],['class' => 'btn btn-default ']),['class' => 'col-sm-3 top10']);
	}
?>				
				</div>
<?php	
}
?>