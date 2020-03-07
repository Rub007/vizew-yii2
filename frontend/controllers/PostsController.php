<?php


namespace frontend\controllers;
use common\models\Category;
use common\models\Comment;
use common\models\Post;
use Yii;
use yii\data\Pagination;
use yii\db\ActiveQuery;

class PostsController extends \yii\web\Controller

{
    public function actionIndex(){
        Yii::$app->params['categories'] = Category::find()->asArray()->all();
        $query = Post::find()->with('category');
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => 3]);
            $posts = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
            return $this->render('posts-list', [
                'posts' => $posts,
                'pages' => $pages,
            ]);
    }
    public function actionView($id){
        Yii::$app->params['categories'] = Category::find()->asArray()->all();
        $comment = new Comment();
        $model  = new Post();
        $next = $model->nextPost($id);
        $previous = $model->previousPost($id);
        $post = Post::find()->where(['id' => $id])->with('category')->one();
        $relateds = $model->getSameCategoryPosts($post);
        $comments = Comment::find()->where(['post_id' => $id])->all();
        return $this->render('single-post',[
            'post' => $post,
            'next' => $next,
            'previous' => $previous,
            'relateds' => $relateds,
            'comment' => $comment,
            'comments' => $comments,
        ]);
    }
}
