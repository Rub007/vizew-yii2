<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'src') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'mime_type') ?>

<!--    --><?php // echo $form->field($model, 'created_at') ?>
<!--    --><?php
    echo '<label class="control-label">Valid Dates</label>';
    echo DatePicker::widget([
        'name' => "PostSearch[created_at]",
        'type' => DatePicker::TYPE_INPUT,
        'value' => '',
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-M-yyyy'
        ]
    ]);
    ?>
    
    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <a href="<?= Url::to('/posts') ?>">Reset</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
