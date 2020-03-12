<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Post;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class CategoriesController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $category = Category::find()->where(['id' => $id])->with('posts')->asArray()->one();
        $ids = ArrayHelper::getColumn($category['posts'], 'id');
        $posts = $posts = Post::find()->where(['IN', 'id', $ids]);
//        $posts = Post::findAll($ids);
        $dataProvider = new ActiveDataProvider([
            'query' => $posts,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
//        return $this->render('index',['category' => $category,'dataProvider' => $dataProvider]);
        return $this->render('index', [
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }

}
