<?php


namespace frontend\controllers;

use common\models\Category;
use common\models\Comment;
use common\models\Post;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class PostsController extends Controller

{
    public function actionIndex()
    {
//        Yii::$app->params['categories'] = Category::find()->asArray()->all();
        $query = Post::find()->with('categories');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => 3]);
        $posts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('posts-list', [
            'posts' => $posts,
            'pages' => $pages,
        ]);
    }

    public function actionView($id)
    {
        $cookies = Yii::$app->response->cookies;
        $cookiesRequest =Yii::$app->request->cookies;
        if (!$cookiesRequest->getValue('visited')){
            $cookie = [$id];
        }
        if (($cookiesRequest->get('visited')) !== null) {
            $cookie = $cookiesRequest->getValue('visited');
            $cookie[] = $id;
            $cookie = array_unique($cookie);

        }

        $cookie  = new \yii\web\Cookie([
            'name' => 'visited',
            'value' => $cookie,
            'expire' => time() + 86400 * 365,
        ]);
        Yii::$app->getResponse()->getCookies()->add($cookie);
        $visitedIds = $cookies->getValue('visited');
//        echo '<pre>';
//            print_r($cookies->getValue('visited'));
//        echo '<pre>';

        $comment = new Comment();
        $model = Post::find()->where(['id' => $id])->with('categories')->with('comments')->one();
        $next = $model->nextPost($id);
        $previous = $model->previousPost($id);
//        $relateds = $model->getSameCategoryPosts($model);
        $post = Post::findOne($id);
        $comments = $model['comments'];
        return $this->render('single-post', [
            'post' => $post,
            'next' => $next,
            'previous' => $previous,
//            'relateds' => $relateds,
            'comment' => $comment,
            'comments' => $comments,
            'visitedIds' => $visitedIds,
        ]);
    }
    public function setCookies($id){
        $cookies = Yii::$app->response->cookies;
        $cookiesRequest =Yii::$app->request->cookies;

        echo '<pre>';
        print_r($cookiesRequest);
        echo '<pre>';
        if (($vko = $cookiesRequest->get('visited')) !== null) {
            $cookies->remove('visited');
            echo '<pre>';
            print_r($vko);
            echo '<pre>';
        }
        $cookie  = new \yii\web\Cookie([
            'name' => 'visited',
            'value' => 'sadsad',
            'expire' => time() + 86400 * 365,
        ]);
        Yii::$app->getResponse()->getCookies()->add($cookie);

    }
}
