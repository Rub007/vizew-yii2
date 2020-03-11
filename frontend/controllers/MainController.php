<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Post;
use Yii;

class MainController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Post();
        $category = new Category();
        $categories = Category::find()->asArray()->all();
//        Yii::$app->params['categories'] = $categories;
        $firstPost = Post::firstPost();
        if (!$firstPost){
            return 'error';
        }
        $trendingPosts = Post::postsWithCount(3);
        $featuredPosts = Post::postsWithCount(2);
        $popularCategories = $category->popularCategories();
        $randomPosts = Post::randomPosts();
        return $this->render('index',
            [
                'firstPost' => $firstPost,
                'trendingPosts' => $trendingPosts,
                'featuredPosts' => $featuredPosts,
                'popularCategories' => $popularCategories,
                'randomPosts' => $randomPosts,
            ]);
    }
}
