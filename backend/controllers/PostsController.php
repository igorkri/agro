<?php

namespace backend\controllers;

use common\models\Posts;
use backend\models\search\PostsSearch;
use yii\helpers\FileHelper;
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
                    $cropPath = $dir . '/' . $imageName . '.' . $file->extension;
                    $cropPathWebp = $dir . '/' . $imageName . '.' . 'webp';
                    //------------ Основная картинка
                    Image::resize($imagePath, 1640, 1480)->save($cropPath, ['quality' => 80]);
                    Image::resize($imagePath, 1640, 1480)->save($cropPathWebp, ['quality' => 80]);

                    // ----------- Нарезка картинок
                    Image::resize($imagePath, 330, 222)->save($dir . '/extra_large-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 263, 177)->save($dir . '/large-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 159, 107)->save($dir . '/medium-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 90, 60)->save($dir . '/small-' . $imageName . '.' . $file->extension, ['quality' => 70]);

                    Image::resize($imagePath, 330, 222)->save($dir . '/webp_extra_large-' . $imageName . '.' . 'webp', ['quality' => 70]);
                    Image::resize($imagePath, 263, 177)->save($dir . '/webp_large-' . $imageName . '.' . 'webp', ['quality' => 70]);
                    Image::resize($imagePath, 159, 107)->save($dir . '/webp_medium-' . $imageName . '.' . 'webp', ['quality' => 70]);
                    Image::resize($imagePath, 90, 60)->save($dir . '/webp_small-' . $imageName . '.' . 'webp', ['quality' => 70]);
                    //----------- End Нарезка картинок

                    unlink($dir . '/' . 'del-' . $imageName . '.' . $file->extension);
                } else {
                    $file->saveAs($dir . '/' . $imageName . '.' . $file->extension);
                }
                $model->image = $catalog . '/' . $imageName . '.' . $file->extension;
                $model->extra_large = $catalog . '/' . 'extra_large-' . $imageName . '.' . $file->extension;
                $model->large = $catalog . '/' . 'large-' . $imageName . '.' . $file->extension;
                $model->medium = $catalog . '/' . 'medium-' . $imageName . '.' . $file->extension;
                $model->small = $catalog . '/' . 'small-' . $imageName . '.' . $file->extension;

                $model->webp_image = $catalog . '/' . $imageName . '.' . 'webp';
                $model->webp_extra_large = $catalog . '/' . 'webp_extra_large-' . $imageName . '.' . $file->extension;
                $model->webp_large = $catalog . '/' . 'webp_large-' . $imageName . '.' . $file->extension;
                $model->webp_medium = $catalog . '/' . 'webp_medium-' . $imageName . '.' . $file->extension;
                $model->webp_small = $catalog . '/' . 'webp_small-' . $imageName . '.' . $file->extension;

                if ($model->save()) {
                    return $this->redirect(['index']);

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
            if ($post_file <= 0) {
                $old = $this->findModel($id);
                $model->image = $old->image;
                $model->extra_large = $old->extra_large;
                $model->large = $old->large;
                $model->medium = $old->medium;
                $model->small = $old->small;
            } else {
                $catalog = explode("/", $model->small);
                $dir = Yii::getAlias('@frontendWeb/posts/' . $catalog[0]);
                $file = UploadedFile::getInstance($model, 'image');
                $imageName = uniqid();
                if ($file->extension == 'jpg' || $file->extension == 'gif' || $file->extension == 'png' || $file->extension == 'jpeg') {
                    $file->saveAs($dir . '/' . 'del-' . $imageName . '.' . $file->extension);
                    $imagePath = $dir . '/' . 'del-' . $imageName . '.' . $file->extension;
                    $cropPath = $dir . '/' . $imageName . '.' . $file->extension;
                    $cropPathWebp = $dir . '/' . $imageName . '.' . 'webp';
                    //------------ Основная картинка
                    Image::resize($imagePath, 1640, 1480)->save($cropPath, ['quality' => 80]);
                    Image::resize($imagePath, 1640, 1480)->save($cropPathWebp, ['quality' => 80]);
                    // ----------- Нарезка картинок
                    Image::resize($imagePath, 330, 222)->save($dir . '/extra_large-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 263, 177)->save($dir . '/large-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 159, 107)->save($dir . '/medium-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 90, 60)->save($dir . '/small-' . $imageName . '.' . $file->extension, ['quality' => 70]);

                    Image::resize($imagePath, 330, 222)->save($dir . '/webp_extra_large-' . $imageName . '.' . 'webp', ['quality' => 70]);
                    Image::resize($imagePath, 263, 177)->save($dir . '/webp_large-' . $imageName . '.' . 'webp', ['quality' => 70]);
                    Image::resize($imagePath, 159, 107)->save($dir . '/webp_medium-' . $imageName . '.' . 'webp', ['quality' => 70]);
                    Image::resize($imagePath, 90, 60)->save($dir . '/webp_small-' . $imageName . '.' . 'webp', ['quality' => 70]);
                    //----------- End Нарезка картинок
                    unlink($dir . '/' . 'del-' . $imageName . '.' . $file->extension);
                } else {
                    $file->saveAs($dir . '/' . $imageName . '.' . $file->extension);
                }
                $model->image = $catalog[0] . '/' . $imageName . '.' . $file->extension;
                $model->extra_large = $catalog[0] . '/' . 'extra_large-' . $imageName . '.' . $file->extension;
                $model->large = $catalog[0] . '/' . 'large-' . $imageName . '.' . $file->extension;
                $model->medium = $catalog[0] . '/' . 'medium-' . $imageName . '.' . $file->extension;
                $model->small = $catalog[0] . '/' . 'small-' . $imageName . '.' . $file->extension;

                $model->webp_image = $catalog[0] . '/' . $imageName . '.' . 'webp';
                $model->webp_extra_large = $catalog[0] . '/' . 'webp_extra_large-' . $imageName . '.' . 'webp';
                $model->webp_large = $catalog[0] . '/' . 'webp_large-' . $imageName . '.' . 'webp';
                $model->webp_medium = $catalog[0] . '/' . 'webp_medium-' . $imageName . '.' . 'webp';
                $model->webp_small = $catalog[0] . '/' . 'webp_small-' . $imageName . '.' . 'webp';
            }
            if ($model->save(false)) {
                return $this->redirect(['index']);
            } else {
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
     * @throws \yii\base\ErrorException
     */
    public function actionDelete($id)
    {
        $dir = Yii::getAlias('@frontendWeb/posts/');
        $model = $this->findModel($id);
        //----------- Удаление всех картинок продукта
        (file_exists($dir . $model->image)) ? unlink($dir . $model->image) : '';
        (file_exists($dir . $model->extra_large)) ? unlink($dir . $model->extra_large) : '';
        (file_exists($dir . $model->large)) ? unlink($dir . $model->large) : '';
        (file_exists($dir . $model->medium)) ? unlink($dir . $model->medium) : '';
        (file_exists($dir . $model->small)) ? unlink($dir . $model->small) : '';

        (file_exists($dir . $model->webp_image)) ? unlink($dir . $model->webp_image) : '';
        (file_exists($dir . $model->webp_extra_large)) ? unlink($dir . $model->webp_extra_large) : '';
        (file_exists($dir . $model->webp_large)) ? unlink($dir . $model->webp_large) : '';
        (file_exists($dir . $model->webp_medium)) ? unlink($dir . $model->webp_medium) : '';
        (file_exists($dir . $model->webp_small)) ? unlink($dir . $model->webp_small) : '';

        //----------- Удаление каталога продукта
        $catalog = explode('/', $model->image);
        $files = scandir($dir . $catalog[0]);
        $files = array_diff($files, array('.', '..'));
        (is_dir($dir . $catalog[0]) && empty($files)) ? FileHelper::removeDirectory($dir . $catalog[0]) : '';

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
