<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_120903_ru_cities extends Migration
{
    public function up()
    {
        $this->createTable('ru_cities', [
            'id' => Schema::TYPE_PK,
            'created_at' => Schema::TYPE_INTEGER . ' NULL DEFAULT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NULL DEFAULT NULL',
            'id_city' => Schema::TYPE_INTEGER . ' NULL DEFAULT NULL',
            'id_country' => Schema::TYPE_INTEGER . ' NULL DEFAULT NULL',
            'name' => Schema::TYPE_STRING . '(255) NULL DEFAULT NULL',
            'state' => Schema::TYPE_STRING . '(255) NULL DEFAULT NULL',
            'region' => Schema::TYPE_STRING . '(255) NULL DEFAULT NULL',
            'country' => Schema::TYPE_STRING . '(255) NULL DEFAULT NULL',
            'coord_lon' => Schema::TYPE_FLOAT . '(255) NULL DEFAULT NULL',
            'coord_lat' => Schema::TYPE_FLOAT . '(255) NULL DEFAULT NULL',
                
        ]);
    }

    public function down()
    {
        echo "m151126_120903_us_cities cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
