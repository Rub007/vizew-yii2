<?php

namespace common\models;

use Yii;
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
 * @property Comments[] $comments
 *
 */

class Post extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    /**
     * @var UploadedFile
     */
    public $imageFile;

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
                'class' => TimestampBehavior::className(),
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
            [['description'],'string'],
            [['created_at','updated_at'], 'integer'],
            [['name', 'src','type', 'mime_type'], 'string', 'max' => 255],
            [['imageFile'],'file','skipOnEmpty' => true,'extensions' => 'png, jpg'],
            [['imageFile'],'file','skipOnEmpty' => false,'extensions' => 'png, jpg','on' => self::SCENARIO_CREATE],
        ];
    }
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['description','created_at','name', 'src', 'imageFile'];
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
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPosts()
    {
        return $this->hasMany(PostCategory::className(), ['post_id' => 'id']);
    }

    public function getCategory(){
        return $this->hasMany(Category::className(),['id' => 'category_id'])->via('categoryPosts');
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['post_id' => 'id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            $path = 'uploads/'. date("Y-m-d-h-m-s") .'.'.$this->imageFile->extension;
            $this->imageFile->saveAs($path);
            $this->imageFile = null;
            return $path;
        } else {

            return false;
        }
    }

    public function deleteImage($path){
        if (file_exists($path)){
            unlink($path);
        }
    }

    public function nextPost($id){
        return $this->find()->where(['>','id',$id])->with('category')->asArray()->one();
    }

    public function previousPost($id){
        return $this->find()->where(['<','id',$id])->with('category')->asArray()->one();
    }

    public function getSameCategoryPosts($post){
        return $this->find()->where(['!=', 'id', $post['id']])->with(['category' => function (ActiveQuery $query) use($post) {
            $query->where([ 'id' => $post['category'][0]['id']]);
        }])->limit(2)->all();
    }

    public function firstPost(){
        return $this->find()->with('category')->one();
    }

    public function postsWithCount($count){
        return $this->find()->with('category')->orderBy(['rand()' => SORT_DESC])->limit($count)->all();
    }

    public function randomPosts(){
        return $this->find()->with('category')->orderBy(['rand()' => SORT_DESC])->limit(4)->all();
    }
}
