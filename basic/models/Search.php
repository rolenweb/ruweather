<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Search extends Model
{
    public $query;
    
   
    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            
            [['query'], 'string', 'max' => 255]
            
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'query' => 'Query',
            
        ];
    }

   
}
