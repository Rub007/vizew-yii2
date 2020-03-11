<?php

namespace common\models;

use http\Url;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;


/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $src
 * @property string|null $type
 * @property string|null $mime_type
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property PostCategory[] $categoryPosts
 * @property Comment[] $comments
 *
 */
class Post extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    /**
     * @var UploadedFile
     */
    public $imageFile;
//    public $categoryIds;
    public $selectedCategories;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['selectedCategories'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'src', 'type', 'mime_type'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'on' => self::SCENARIO_CREATE],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['description', 'created_at', 'name', 'src', 'imageFile', 'selectedCategories'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'src' => 'Src',
            'type' => 'Type',
            'mime_type' => 'Mime Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CategoryPosts]].
     *
     * @return ActiveQuery
     */
    public function getCategoryPosts()
    {
        return $this->hasMany(PostCategory::class, ['post_id' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->via('categoryPosts');
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            $path = 'uploads/'.date("Y-m-d-h-m-s") . '.' . $this->imageFile->extension;
            $fullPath = \yii\helpers\Url::to('@frontend/web/' ).$path;
            $this->imageFile->saveAs($fullPath);
            $this->imageFile = null;
            return $path;
        } else {
            return false;
        }
    }

    public function deleteImage($path)
    {
        $fullPath = \yii\helpers\Url::to('@frontend/web/' ).$path;
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    public function nextPost($id)
    {
        return $this->find()->where(['>', 'id', $id])->with('categories')->asArray()->one();
    }

    public function previousPost($id)
    {
        return $this->find()->where(['<', 'id', $id])->with('categories')->orderBy(['id' => SORT_DESC])->asArray()->one();

    }

    public function getSameCategoryPosts($post)
    {
        if (!$post['categories']){
            return [];
        }
        return $this->find()->where(['!=', 'id', $post['id']])->with(['categories' => function (ActiveQuery $query) use ($post) {
            $query->where(['id' => $post['categories'][0]['id']]);
        }])->limit(2)->all();
    }

    public static function firstPost()
    {
        return self::find()->with('categories')->one();
    }

    public static function postsWithCount($count)
    {
        return self::find()->with('categories')->orderBy(['rand()' => SORT_DESC])->limit($count)->all();
    }

    public static function randomPosts()
    {
        return self::find()->with('categories')->orderBy(['rand()' => SORT_DESC])->limit(4)->all();
    }
}
