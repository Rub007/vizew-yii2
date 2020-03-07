<?php namespace backend\controllers;


use common\models\Messages;
use common\models\Post;
use common\models\UploadForm;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ContactController extends Controller
{
    public function actionIndex(){
        $messages = Messages::find()->all();
        $count = Messages::find()->count();
        return $this->render('index',[
            'messages' => $messages,
            'count' => $count,
        ]);
    }

    public function actionDelete($id){
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Messages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
