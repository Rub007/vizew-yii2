<?php

namespace frontend\controllers;

use common\models\Category;
use Yii;

class CategoriesController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $categories = Category::find()->asArray()->all();
        Yii::$app->params['categories'] = $categories;
        $category = Category::find()->where(['id' => $id])->with('posts')->one();
        return $this->render('index',['category' => $category]);
    }

}
