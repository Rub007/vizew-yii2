<?php

use yii\db\Migration;

/**
 * Class m200218_130928_category_post
 */
class m200218_130928_category_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_post}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'post_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey('category_post_posts', '{{%category_post}}', 'post_id', 'posts', 'id', 'CASCADE');
        $this->addForeignKey('category_post_categories', '{{%category_post}}', 'category_id', 'categories', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('category_post_posts','posts');
        $this->dropForeignKey('category_post_categories','categories');
        $this->dropTable('{{%category_post}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200218_130928_category_post cannot be reverted.\n";

        return false;
    }
    */
}
