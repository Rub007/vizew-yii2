<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Post', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="posts-view">
    <div class="img-div">
    <h1><?= Html::encode($this->title) ?></h1>
        <img src="<?=Url::base('').'/'.$model->src?>" alt="" class="my-big-img">
        <img src="<?=Yii::$app->urlManagerFrontEnd->createUrl($model->src)?>" alt="" class="my-big-img">

    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'src',
            'created_at',
            'updated_at',
        ],
    ]) ?>
    <div>Categories</div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'color',
                'format' => 'html',
                'label' => 'color',
                'value' => function ($dataProvider) {
                    return "<div style='background-color:$dataProvider->color;width: 100%;height: 20px;'></div>";
                },
            ],
        ],
    ]) ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
