<?php

namespace backend\controllers;

use common\models\Category;
use common\models\Post;
use common\models\UploadForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * PostsController implements the CRUD actions for Post model.
 */
class PostsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->with('category'),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $categories = $this->findModel($id)->category;
        $dataProvider = new ArrayDataProvider(['allModels' => $categories]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $model->scenario = Post::SCENARIO_CREATE;
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($path = $model->upload()) {
                $model->src = $path;
                if ($model->save(false)) {
                    $selectedCategories = Yii::$app->request->post('Post')['category'];
                    $selectedCategoriesObjects = Category::findAll($selectedCategories);
                    foreach ($selectedCategoriesObjects as $category) {
                        $model->link('category', $category);
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $model->deleteImage($path);
                }
            } else {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->render('create', [
            'categories' => $categories,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'name');
        $uploadModel = new UploadForm();
        if ($model->load(Yii::$app->request->post())) {
            if (UploadedFile::getInstance($model, 'imageFile')) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $model->deleteImage($model['src']);
                if ($path = $model->upload()) {
                    $model->src = $path;
                    if ($model->save()) {
                        $model->unlinkAll('category', true);
                        $selectedCategories = Yii::$app->request->post('Post')['category'];
                        $selectedCategoriesObjects = Category::findAll($selectedCategories);
                        foreach ($selectedCategoriesObjects as $category) {
                            $model->link('category', $category);
                        }
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        $model->deleteImage($path);
                    }
                }
            } else {
                $model->save();
                $model->unlinkAll('category', true);
                $selectedCategories = Yii::$app->request->post('Post')['category'];
                $selectedCategoriesObjects = Category::findAll($selectedCategories);
                foreach ($selectedCategoriesObjects as $category) {
                    $model->link('category', $category);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
            'categories' => $categories,
            'src' => $model['src'],
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $uploadFile = new UploadForm();

        $model->deleteImage($model->src);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actions()
    {
        return [
            'browse-images' => [
                'class' => 'bajadev\ckeditor\actions\BrowseAction',
                'quality' => 80,
                'maxWidth' => 800,
                'maxHeight' => 800,
                'useHash' => true,
                'url' => '@web/contents/',
                'path' => '@frontend/web/contents/',
            ],
            'upload-images' => [
                'class' => 'bajadev\ckeditor\actions\UploadAction',
                'quality' => 80,
                'maxWidth' => 800,
                'maxHeight' => 800,
                'useHash' => true,
                'url' => '@web/contents/',
                'path' => '@frontend/web/contents/',
            ],
        ];
    }
}
