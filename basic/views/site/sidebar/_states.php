<?php
use yii\helpers\Html;
if ($array_states != NULL) {
	foreach ($array_states as $state) {
?>
				<div class="col-xs-6 border-b">
					
					<?= Html::a($state['name'],['site/index', 'region' => strtolower($state['id'])],['title' => 'Прогноз погоды '.$state['name']]) ?>

				</div>
<?php		
	}
}
?>

                
                  