<?php

namespace backend\controllers;

use common\models\shop\AuxiliaryCategories;
use backend\models\search\AuxiliaryCategories as AuxiliaryCategoriesSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AuxiliaryCategoriesController implements the CRUD actions for AuxiliaryCategories model.
 */
class AuxiliaryCategoriesController extends Controller
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
     * Lists all AuxiliaryCategories models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AuxiliaryCategoriesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuxiliaryCategories model.
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
     * Creates a new AuxiliaryCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AuxiliaryCategories();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $dir = Yii::getAlias('@frontendWeb/auxiliary-categories');
                $image = UploadedFile::getInstance($model, 'image');
                $imageName = uniqid();
                $image->saveAs($dir . '/' . $imageName . '.' . $image->extension);
                $model->image = $imageName . '.' . $image->extension;

                if ($model->save()) {
                    return $this->redirect(['update', 'id' => $model->id]);
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
     * Updates an existing AuxiliaryCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $post_file = $_FILES['AuxiliaryCategories']['size']['image'];
            if($post_file <= 0 ){
                $old = $this->findModel($id);
                $model->image = $old->image;
            }else {
                $dir = Yii::getAlias('@frontendWeb/auxiliary-categories');

                $image = UploadedFile::getInstance($model, 'image');
                $imageName = uniqid();
                $image->saveAs($dir . '/' . $imageName . '.' . $image->extension);
                $model->image = $imageName . '.' . $image->extension;
            }
            if($model->save(false)) {
                return $this->redirect(['update', 'id' => $model->id]);
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
     * Deletes an existing AuxiliaryCategories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $dir = Yii::getAlias('@frontendWeb');
        $model = $this->findModel($id);
        if (file_exists($dir .'/auxiliary-categories/'. $model->image)) {
            unlink($dir .'/auxiliary-categories/'. $model->image);
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the AuxiliaryCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AuxiliaryCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuxiliaryCategories::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
