<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200311_140609_create_gallery_manager
 */
class m200311_140609_create_gallery_manager extends Migration
{
    /**
     * {@inheritdoc}
     */
    public $tableName = '{{%gallery_image}}';

    public function up()
    {

        $this->createTable(
            $this->tableName,
            array(
                'id' => Schema::TYPE_PK,
                'type' => Schema::TYPE_STRING,
                'ownerId' => Schema::TYPE_STRING . ' NOT NULL',
                'rank' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'name' => Schema::TYPE_STRING,
                'description' => Schema::TYPE_TEXT
            )
        );
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200311_140609_create_gallery_manager cannot be reverted.\n";

        return false;
    }
    */
}
