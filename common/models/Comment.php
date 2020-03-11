<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int|null $post_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $message
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Posts $post
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'created_at', 'updated_at'], 'integer'],
            [['post_id', 'message', 'name','email'], 'required'],
            [['message'], 'string'],
            [['name', 'email'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'name' => 'Name',
            'email' => 'Email',
            'message' => 'Message',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
