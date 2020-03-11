<?php


namespace frontend\controllers;

use common\models\Comment;
use Yii;
use yii\web\Controller;

class CommentsController extends Controller
{
    public function actionAdd($id)
    {
        $model = new Comment();
        if ($model->load(Yii::$app->request->post())) {
            $model->post_id = $id;
            if ($model->validate()) {
                $model->save();
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        else{
            $errors = $model->errors;
            return $this->redirect('posts/view' . http_build_query(['id' => $id]),['errors' => $errors]);
        }
    }

}
