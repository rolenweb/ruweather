<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city_from_weathe".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $id_city
 * @property string $name
 * @property string $country
 * @property double $coord_lon
 * @property double $coord_lat
 */
class CityFromWeathe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city_from_weathe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'id_city'], 'integer'],
            [['name', 'country', 'coord_lon', 'coord_lat'], 'required'],
            [['coord_lon', 'coord_lat'], 'number'],
            [['name', 'country'], 'string', 'max' => 255]
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
            'id_city' => 'Id City',
            'name' => 'Name',
            'country' => 'Country',
            'coord_lon' => 'Coord Lon',
            'coord_lat' => 'Coord Lat',
        ];
    }
}
