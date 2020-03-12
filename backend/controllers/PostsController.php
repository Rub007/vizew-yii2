<?php

namespace backend\controllers;

use Cassandra\Date;
use common\models\Category;
use common\models\Post;
use common\models\PostSearch;
use common\models\TestsSearch;
use common\models\UploadForm;
use DateTime;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

/**
 * PostsController implements the CRUD actions for Post model.
 */
class PostsController extends AdminController
{
    /**
     * {@inheritdoc}
//     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();

//        if (Yii::$app->request->get()){
//            echo 1;
//        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
//            'dataProvider1' => $dataProvider1,
            'searchModel' => $searchModel,
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
        $categories = $this->findModel($id)->categories;
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
//        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'name');
        $categories = Category::find()->select(['name', 'id'])->indexBy('id')->column();

        if ($model->load(Yii::$app->request->post())) {

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($path = $model->upload()) {
                $model->src = $path;
                if ($model->save(false)) {
                    $selectedCategories = $model->selectedCategories;
                    $selectedCategoriesObjects = Category::findAll($selectedCategories);
                    foreach ($selectedCategoriesObjects as $category) {
                        $model->link('categories', $category);
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
        $categories = Category::find()->select(['name', 'id'])->indexBy('id')->column();
        if ($model->load(Yii::$app->request->post())) {
            if (UploadedFile::getInstance($model, 'imageFile')) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $model->deleteImage($model['src']);
                if ($path = $model->upload()) {
                    $model->src = $path;
                    if ($model->save()) {
                        $model->unlinkAll('categories', true);
                        $selectedCategories = Yii::$app->request->post('Post')['selectedCategories'];
                        $selectedCategoriesObjects = Category::findAll($selectedCategories);
                        foreach ($selectedCategoriesObjects as $category) {
                            $model->link('categories', $category);
                        }
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        $model->deleteImage($path);
                    }
                }
            } else {
                $model->save();
                $model->unlinkAll('categories', true);
                $selectedCategories = Yii::$app->request->post('Post')['selectedCategories'];
                $selectedCategoriesObjects = Category::findAll($selectedCategories);
                foreach ($selectedCategoriesObjects as $category) {
                    $model->link('categories', $category);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $model->selectedCategories = $model->getCategories()->all();
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
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'post' => Post::className()
                ]
            ],
        ];
    }
}
