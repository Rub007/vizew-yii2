<?php


namespace frontend\controllers;


use common\models\Category;
use common\models\Messages;
use Yii;
use yii\web\Controller;

class ContactController extends Controller
{
    public function actionIndex(){
        $categories = Category::find()->asArray()->all();
        Yii::$app->params['categories'] = $categories;
        $model = new Messages();
        return $this->render('index',['model' => $model]);
    }

    public function actionSend()
    {
        $model = new Messages();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            $categories = Category::find()->asArray()->all();
            Yii::$app->params['categories'] = $categories;
            $errors = $model->errors;
            return $this->render('index', ['model' => $model, 'errors' => $errors]);
        }
    }
}
