            <div class="col-md-3">
              <aside>
<?php
echo $this->render('_search',[
        'array_for_typeahead' => $array_for_typeahead,
        'model_search' => $model_search,
        'id_activeform' => 'search',
        ]);     
?>                       
                
                <div class="row top20 state-home">
<?php
echo $this->render('_states',[
        'array_states' => $array_states,
        ]);     
?>                 
                  
                </div>
               
              
              </aside>    
          
            </div>