<?php

use yii\db\Migration;

/**
 * Class m200218_132426_comments
 */
class m200218_132426_comments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'name' => $this->string(),
            'email' => $this->string(),
            'message' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey('comments_posts', '{{%comments}}', 'post_id', 'posts', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('comments_posts','posts');
        $this->dropTable('{{%comments}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200218_132426_comments cannot be reverted.\n";

        return false;
    }
    */
}
