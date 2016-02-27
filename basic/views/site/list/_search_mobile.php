<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\typeahead\TypeaheadBasic;
use kartik\typeahead\Typeahead;
  
?>
			
			<div class="input-group search search-typeahead">
<?php
$form = ActiveForm::begin([
                                    'id' => $id_activeform,
                                    'method' => 'get',
                                    'action' => ['site/index'],
                                    'options' =>[
                                        //'class' => 'form-inline',
                                        //'data-pjax' => true
                                        ]  
                                    ]);
?>			
                
                <div class="col-xs-10">
                  <?= $form->field($model_search, 'query')->widget(TypeaheadBasic::classname(), [
                                                    'data' => $array_for_typeahead,
                                                    'options' => [
                                                        'placeholder' => 'Type city',
                                                        'id' => 'typeahead_'.$id_activeform,
                                                        //'class' => 'form-control',
                                                    ],
                                                    'pluginOptions' => ['highlight'=>true, 'minLength' => 0],
                                                    'scrollable' => true,
                                                    'dataset' => [
                                                        'limit' => 10,

                                                        
                                                    ]
                                                ])->label(false); ?>
                     
                  </div>  
                  <div class="col-xs-2">
                    <?= Html::submitButton(Html::tag('i','',['class' => 'fa fa-search go']), ['class' => 'btn btn-default top10']) ?>
                  </div>
 <?php
                         ActiveForm::end();

?>                 
            </div>
        