<?php


namespace frontend\components;
use common\models\Category;
use common\models\Post;
use Yii;

use yii\base\Widget;
use yii\db\ActiveQuery;
use yii\db\Query;

class RelatedsWidget extends Widget
{
    public $model;
    public $count;
    public $visitedIds;
    public $title = 'Relateds';
    public function run()
    {
        $model = $this->model;
        if (!$model['categories']) {
            return 'Sorry, there are no posts for you';
        }
        $posts = Post::find()
            ->where(['NOT IN', 'posts.id', $this->visitedIds])
            ->innerJoinWith(['categoryPosts' => function (ActiveQuery $query) use ($model){
                $query->where(['category_id' => $model['categories'][0]['id']]);
            }])
            ->all();
        return $this->render('relateds',
            [
                'relateds' => $posts,
                'title' => $this->title,
            ]);
    }
}
