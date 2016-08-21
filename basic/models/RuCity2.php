<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "ru_city2".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $city_id
 * @property string $name
 * @property string $district
 * @property string $region
 * @property double $lon
 * @property double $lat
 */
class RuCity2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ru_city2';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'city_id'], 'integer'],
            [['lon', 'lat'], 'number'],
            [['name', 'district', 'region'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'city_id' => 'City ID',
            'name' => 'Name',
            'district' => 'District',
            'region' => 'Region',
            'lon' => 'Lon',
            'lat' => 'Lat',
        ];
    }

    public function findBySearch($search1, $search2 = NULL, $search3 = NULL)
    {
        if ($search1 != NULL && $search2 != NULL && $search3 != NULL) {
            return $this->find()->where(['and',['like', 'name', $search1],['like', 'district', $search2],['like', 'region', $search3]])->orderBy(['name' => SORT_ASC, 'district' => SORT_ASC, 'region' => SORT_ASC])->asArray()->all();
        }elseif ($search1 != NULL && $search2 != NULL) {
            return $this->find()->where(['and',['like', 'name', $search1],['or',['like', 'district', $search2],['like', 'region',                                                                                                                                                                                                                                $search2]]])->orderBy(['name' => SORT_ASC, 'district' => SORT_ASC, 'region' => SORT_ASC])->asArray()->all();
        }
        else{
            return $this->find()->where(['like', 'name', $search1])->orderBy(['name' => SORT_ASC, 'district' => SORT_ASC, 'region' => SORT_ASC])->asArray()->all();   
        }
        
    }
}
