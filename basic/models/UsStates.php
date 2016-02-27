<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "us_states".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $code
 * @property string $name
 * @property string $capital
 */
class UsStates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'us_states';
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
            [['created_at', 'updated_at'], 'integer'],
            [['code', 'name', 'capital'], 'string', 'max' => 255]
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
            'code' => 'Code',
            'name' => 'Name',
            'capital' => 'Capital'
        ];
    }

    public function getCities()
    {
        return $this->hasMany(UsCities::className(), ['state' => 'code']);
    }

    public function getCity($namecity)
    {
        return $this->hasOne(UsCities::className(), ['state' => 'code'])
            ->where('name = :namecity', [':namecity' => $namecity]);
    }
}
