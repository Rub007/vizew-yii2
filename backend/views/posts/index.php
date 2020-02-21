<?php

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


    echo GridView::widget([
        'dataProvider' => $dataProvider,
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

                    return Html::img(Url::base('').'/'.$dataProvider['src'],
                        ['width' => '60px']);
                },
            ],

            [
                'attribute' => '',
                'format' => 'html',
                'label' => 'Categories',
                'value' => function ($data) {
                $category = $data->category;
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
