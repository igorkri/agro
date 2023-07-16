<?php

namespace backend\controllers;

use common\models\Posts;
use backend\models\search\PostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;
use yii\imagine\Image;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Posts models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->sort->defaultOrder = ['date_public' => SORT_DESC];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Posts model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
//    public function actionCreate()
//    {
//        $model = new Posts();
//
//        if ($this->request->isPost) {
//            if ($model->load($this->request->post())) {
////
//                $dir = Yii::getAlias('@frontendWeb/posts');
//
//                $file = UploadedFile::getInstance($model, 'image');
//                $imageName = uniqid();
//                $file->saveAs($dir . '/' . $imageName . '.' . $file->extension);
//                $model->image = $imageName . '.' . $file->extension;
//
//                if ($model->save()) {
//                    return $this->redirect(['index']);
//                }
//            }
//        } else {
//            $model->loadDefaultValues();
//        }
//
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }

    public function actionCreate()
    {
        $model = new Posts();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                // Создание директории с именем id модели
                $catalog = time();
                $dir = Yii::getAlias('@frontendWeb/posts/' . $catalog);
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $file = UploadedFile::getInstance($model, 'image');
                $imageName = uniqid();
                if ($file->extension == 'jpg' || $file->extension == 'gif' || $file->extension == 'png' || $file->extension == 'jpeg') {
                    $file->saveAs($dir . '/' . 'del-' . $imageName . '.' . $file->extension);
                    $imagePath = $dir . '/' . 'del-' . $imageName . '.' . $file->extension;
                    $cropPath = $dir  . '/' . $imageName . '.' . $file->extension;
                    //------------ Основная картинка
                    Image::resize($imagePath, 1640, 1480)->save($cropPath, ['quality' => 80]);
                    // ----------- Нарезка картинок
                    Image::resize($imagePath, 330, 222)->save($dir . '/extra_large-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 263, 177)->save($dir . '/large-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 159, 107)->save($dir . '/medium-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 90, 60)->save($dir . '/small-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    //----------- End Нарезка картинок
                    unlink($dir  . '/' . 'del-' . $imageName . '.' . $file->extension);
                } else {
                    $file->saveAs($dir  . '/' . $imageName . '.' . $file->extension);
                }
                $model->extra_large = 'extra_large-' . $imageName . '.' . $file->extension;
                $model->large = 'large-' . $imageName . '.' . $file->extension;
                $model->medium = 'medium-' . $imageName . '.' . $file->extension;
                $model->small = 'small-' . $imageName . '.' . $file->extension;
                if ($model->save()) {

                } else {
                    print_r($model->errors);
                }



            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $post_file = $_FILES['Posts']['size']['image'];
            if($post_file <= 0 ){
                $old = $this->findModel($id);
                $model->image = $old->image;
            }else {
                $dir = Yii::getAlias('@frontendWeb/posts');

                $file = UploadedFile::getInstance($model, 'image');
                $imageName = uniqid();
                $file->saveAs($dir . '/' . $imageName . '.' . $file->extension);
                $model->image = $imageName . '.' . $file->extension;
            }
            if($model->save(false)) {
                return $this->redirect(['index']);
            }else{
                debug($model->errors);
                debug($model->image);
                die;
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $dir = Yii::getAlias('@frontendWeb');
        $model = $this->findModel($id);
        if (file_exists($dir .'/posts/'. $id . $model->image)) {
            unlink($dir .'/posts/'. $id . $model->image);
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
