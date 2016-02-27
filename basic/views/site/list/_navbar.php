<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <?= Html::a(Html::tag('i','',['class' => 'fa fa-home fa-lg home']),Url::home(),['class' => 'navbar-brand']) ?>
                  <?= Html::a(Html::tag('i','',['class' => 'fa fa-envelope-o']),['site/contact'],['class' => 'navbar-brand']) ?>
                </div>
                
                
                
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  
                  <div class="visible-xs-block">
                    
<?php
echo $this->render('_search_mobile',[
        'array_for_typeahead' => $array_for_typeahead,
        'model_search' => $model_search,
        'id_activeform' => 'search_mobile',
        ]);     
?>                     
                    

                  </div>
                  <div class="social">
                    
                  </div>
                </div><!-- /.navbar-collapse -->
                
              </div><!-- /.container-fluid -->
            </nav>
