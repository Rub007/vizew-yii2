<?php

use yii\db\Migration;

/**
 * Class m200219_104551_categories_posts
 */
class m200219_104551_categories_posts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts_categories}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'post_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey('posts_categories_posts', '{{%posts_categories}}', 'post_id', 'posts', 'id', 'CASCADE');
        $this->addForeignKey('posts_categories_categories', '{{%posts_categories}}', 'category_id', 'categories', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('posts_categories_posts','posts');
        $this->dropForeignKey('posts_categories_categories','categories');
        $this->dropTable('{{%posts_categories}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200219_104551_categories_posts cannot be reverted.\n";

        return false;
    }
    */
}
