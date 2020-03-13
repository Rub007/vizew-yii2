<?php


namespace frontend\components;
use common\models\Category;
use common\models\Post;
use Yii;

use yii\base\Widget;
use yii\db\ActiveQuery;

class RelatedsWidget extends Widget
{

    public static function getRelateds($model,$count,$visitedIds,$title = 'Relateds')
    {
        if (!$model['categories']) {
            return 'Sorry, there are no posts for you';
        }
        $posts =  Post::find()->where(['not in', 'id', $visitedIds])->with(['categories' => function (ActiveQuery $query) use ($model) {
            $query->where(['id' => $model['categories'][0]['id']]);
        }])->limit($count)->all();
        return Yii::$app->getView()->render('@frontend/components/views/relateds',
            [
                'relateds' => $posts,
                'title' => $title,
            ]);
    }
}
