<?php

namespace backend\controllers;

use common\models\shop\AuxiliaryCategories;
use backend\models\search\AuxiliaryCategories as AuxiliaryCategoriesSearch;
use common\models\shop\AuxiliaryTranslate;
use Stichoza\GoogleTranslate\GoogleTranslate;
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

                    $this->getCreateTranslate($model);

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

    protected function getCreateTranslate($model)
    {
        $sourceLanguage = 'uk'; // Исходный язык
        $targetLanguages = ['ru', 'en']; // Языки перевода

        $tr = new GoogleTranslate();

        foreach ($targetLanguages as $language) {
            $translation = $model->getTranslation($language)->one();
            if (!$translation) {
                $translation = new AuxiliaryTranslate();
                $translation->category_id = $model->id;
                $translation->language = $language;
            }

            $tr->setSource($sourceLanguage);
            $tr->setTarget($language);

            $translation->name = $tr->translate($model->name ?? '');

            if (strlen($model->description) < 5000) {
                $translation->description = $tr->translate($model->description);
            } else {
                $description = $model->description;
                $translatedDescription = '';
                $partSize = 5000;
                $parts = [];

                // Разбиваем текст на части по 5000 символов, не нарушая структуру тегов
                while (strlen($description) > $partSize) {
                    $part = substr($description, 0, $partSize);
                    $lastSpace = strrpos($part, ' ');
                    $parts[] = substr($description, 0, $lastSpace);
                    $description = substr($description, $lastSpace);
                }
                $parts[] = $description;

                // Переводим каждую часть отдельно
                foreach ($parts as $part) {
                    $translatedDescription .= $tr->translate($part);
                }

                // Сохраняем переведенное описание
                $translation->description = $translatedDescription;
            }

            $translation->pageTitle = $tr->translate($model->pageTitle ?? '');
            $translation->metaDescription = $tr->translate($model->metaDescription ?? '');

            $translation->save();
        }
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

        $translateRu = AuxiliaryTranslate::findOne(['category_id' => $id, 'language' => 'ru']);
        $translateEn = AuxiliaryTranslate::findOne(['category_id' => $id, 'language' => 'en']);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $postTranslates = Yii::$app->request->post('CategoriesTranslate', []);

            $this->updateTranslate($model->id, 'ru', $postTranslates['ru'] ?? null);
            $this->updateTranslate($model->id, 'en', $postTranslates['en'] ?? null);

            if ($_FILES['AuxiliaryCategories']['size']['image'] > 0) {
                $model->image = $this->uploadFile($model);
            } else {
                $old = $this->findModel($id);
                $model->image = $old->image;
            }

            if($model->save(false)) {
                return $this->redirect(['update', 'id' => $model->id]);
            }else{
                dd($model->errors, $model->image);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'translateRu' => $translateRu,
            'translateEn' => $translateEn,
        ]);
    }

    private function updateTranslate($categoryId, $language, $data)
    {
        if ($data) {
            $translate = AuxiliaryTranslate::findOne(['category_id' => $categoryId, 'language' => $language]);
            if ($translate) {
                $translate->setAttributes($data);
                $translate->save();
            }
        }
    }

    private function uploadFile($model)
    {
        $dir = Yii::getAlias('@frontendWeb/auxiliary-categories');
        $file = UploadedFile::getInstance($model, 'image');
        $imageName = uniqid();
        $file->saveAs($dir . '/' . $imageName . '.' . $file->extension);
        return $imageName . '.' . $file->extension;
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

        AuxiliaryTranslate::deleteAll(['category_id' => $id]);

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
