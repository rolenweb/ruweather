<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';

?>
<div class="container">
      <div class="row">
        <div class="col-sm-9">
          <div class="header">
            <div class="row">
              
              <div class="col-sm-12 title"><h1>Contact us</h1></div>
              
            </div>
          </div>
        </div>
        <div class="col-sm-3">
<?php
echo $this->render('list/_navbar',[
        
        'array_for_typeahead' => $array_for_typeahead,
        'model_search' => $model_search,
        ]);     
?>                          
          
            
         
        </div>
      </div>
      <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="content">
                
                    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

                    <div class="alert alert-success">
                        Thank you for contacting us. We will respond to you as soon as possible.
                    </div>

                    <?php else: ?>

                    <p>
                        If you have business inquiries or other questions, please fill out the following form to contact us.
                        Thank you.
                    </p>

                    

                            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                                <?= $form->field($model, 'name') ?>

                                <?= $form->field($model, 'email') ?>

                                <?= $form->field($model, 'subject') ?>

                                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

                                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                    'template' => '<div class="row"><div class="col-xs-4">{image}</div><div class="col-xs-8">{input}</div></div>',
                                ]) ?>

                                <div class="form-group text-right">
                                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                                </div>

                            <?php ActiveForm::end(); ?>

                       
    <?php endif; ?>
             
            
            
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

