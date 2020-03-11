<?php

use kartik\date\DatePicker;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Post';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php

    // Multiple Dates Selection
//     echo $this->render('_search', ['model' => $searchModel]);


    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'description',

                'format' => 'html',

                'label' => 'Description',

                'value' => function ($dataProvider) {
                    return Html::decode($dataProvider['description']);
                }
            ],
            [

                'attribute' => 'img',

                'format' => 'html',

                'label' => 'Image',

                'value' => function ($dataProvider) {

                    return Html::img(Yii::$app->urlManagerFrontEnd->createUrl($dataProvider['src']),
                        ['width' => '60px']);
                },
            ],

            [
                'attribute' => '',
                'format' => 'html',
                'label' => 'Categories',
                'value' => function ($data) {
                $category = $data->categories;
                $arrayDataProvider = new ArrayDataProvider(['allModels' => $category,]);
                    return ListView::widget([
                        'dataProvider' => $arrayDataProvider,
                        'options' => [
                            'id',
                            'name'
                        ],
                        'layout' => "{items}",
                        'itemView' => function ($category) {
                            return "<div style='background-color:$category->color'>$category->name</div>";
                        },
                    ]);
                },
            ],
            [
                'attribute' => 'created_at',
                  'format' => ['date', 'php:d-M-Y H:i:s'],
                'filter' => DatePicker::widget([
                     'name' => "PostSearch[created_at]",
                     'type' => DatePicker::TYPE_INPUT,
                     'value' => '',
                     'pluginOptions' => [
                         'autoclose'=>true,
                         'format' => 'dd-M-yyyy'
                     ]
                 ])
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <a href="<?= Url::to('/posts') ?>">Reset</a>
<!--    <img src="--><?//=Url::toRoute('/uploads/2020-03-11-10-03-54.png')?><!--" alt="">-->
    <img src="/uploads/2020-03-11-10-03-54.png" alt="">
<!--    http://yii-application.loc/uploads/2020-03-11-10-03-54.png-->
<!--    --><?//=Yii::$app->urlManagerFrontEnd->createUrl()?>


</div>
