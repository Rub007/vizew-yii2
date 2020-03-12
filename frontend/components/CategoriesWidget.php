<?php
namespace frontend\components;
use common\models\Category;
use Yii;
use yii\base\Widget;

//use Yii\base\Widget;
class CategoriesWidget extends Widget
{
    public static function categories()
    {
        return Category::find()->asArray()->all();
    }
}
