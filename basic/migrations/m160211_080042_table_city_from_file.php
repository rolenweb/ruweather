<?php

use yii\db\Schema;
use yii\db\Migration;

class m160211_080042_table_city_from_file extends Migration
{
    public function up()
    {
        $this->createTable('city_from_file', [
            'id' => Schema::TYPE_PK,
            'created_at' => Schema::TYPE_INTEGER . ' NULL DEFAULT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NULL DEFAULT NULL',
            'id_city' => Schema::TYPE_INTEGER . ' NULL DEFAULT NULL',
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'state' => Schema::TYPE_STRING . '(255) NOT NULL',
            'coord_lon' => Schema::TYPE_FLOAT . '(255) NOT NULL',
            'coord_lat' => Schema::TYPE_FLOAT . '(255) NOT NULL',                    
                
        ]);
    }

    public function down()
    {
        echo "m160211_080042_table_city_from_file cannot be reverted.\n";

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
