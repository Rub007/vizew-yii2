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
//        Yii::$app->params['categories'] = Category::find()->asArray()->all();
        $comment = new Comment();
        $model = Post::find()->where(['id' => $id])->with('categories')->with('comments')->one();
        $next = $model->nextPost($id);
        $previous = $model->previousPost($id);
        $relateds = $model->getSameCategoryPosts($model);
        $post = Post::findOne($id);
        $comments = $model['comments'];
        // @todo static methodner@ kanchel, model@ ogtagorcel ira relationnerov aranc havelyal queryinery
        // @todo find aneluc yete hnravora karch methodov kanchel karchov findOne, findAll
        return $this->render('single-post', [
            'post' => $post,
            'next' => $next,
            'previous' => $previous,
            'relateds' => $relateds,
            'comment' => $comment,
            'comments' => $comments,
        ]);
    }
}
