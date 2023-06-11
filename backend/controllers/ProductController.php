<?php

namespace backend\controllers;

use common\models\Settings;
use common\models\shop\Product;
use backend\models\search\ProductSearch;
use common\models\shop\ProductGrup;
use common\models\shop\ProductImage;
use common\models\shop\ProductProperties;
use common\models\shop\ProductTag;
use yii\helpers\ArrayHelper;
use yii\imagine\Image;
use Yii;
use yii\base\BaseObject;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $currency = Settings::currencyRate();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'currency' => $currency,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
//        Yii::$app->cache->flush();
        $model = new Product();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $post_product = $this->request->post('Product');
                if (isset($post_product['tags']) && $post_product['tags'] != null) {
                    //добавляем Tags
                    foreach ($post_product['tags'] as $tag_id) {
                        $add_tag = new ProductTag();
                        $add_tag->product_id = $model->id;
                        $add_tag->tag_id = $tag_id;
                        $add_tag->save();
                    }
                }

                if (isset($post_product['grups']) && $post_product['grups'] != null) {
                    foreach ($post_product['grups'] as $grup_id) {
                        $add_grup = new ProductTag();
                        $add_grup->product_id = $model->id;
                        $add_grup->grup_id = $grup_id;
                        $add_grup->save();
                    }
                }

                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save(false)) {
            // Сохранение свойств товара
            $postProperties = Yii::$app->request->post('ProductProperties', []);

            // Удаление существующих свойств товара
            ProductProperties::deleteAll(['product_id' => $model->id]);

            // Добавление новых свойств товара
            foreach ($postProperties as $postProperty) {
                $propertyModel = new ProductProperties();
                $propertyModel->product_id = $model->id;
                $propertyModel->properties = $postProperty['properties'];
                $propertyModel->value = $postProperty['value'];
                $propertyModel->save();
            }

            $post_product = $this->request->post('Product');
            if (!empty($post_product['tags'])) {
                //удаляем существующие tags
                $tags = ProductTag::find()->where(['product_id' => $model->id])->all();
                if ($tags) {
                    foreach ($tags as $t) {
                        $t->delete();
                    }
                }
                //добавляем Tags
                foreach ($post_product['tags'] as $tag_id) {
                    $tag = ProductTag::find()
                        ->where(['product_id' => $model->id])
                        ->andWhere(['tag_id' => $tag_id])
                        ->one();
                    if (!$tag) {
                        $add_tag = new ProductTag();
                        $add_tag->product_id = $model->id;
                        $add_tag->tag_id = $tag_id;
                        $add_tag->save();
                    }
                }
            }

            $post_product = $this->request->post('Product');
            if (!empty($post_product['grups'])) {
                $grups = ProductGrup::find()->where(['product_id' => $model->id])->all();
                if ($grups) {
                    foreach ($grups as $g) {
                        $g->delete();
                    }
                }

                foreach ($post_product['grups'] as $grup_id) {
                    $grup = ProductGrup::find()
                        ->where(['product_id' => $model->id])
                        ->andWhere(['grup_id' => $grup_id])
                        ->one();
                    if (!$grup) {
                        $add_grup = new ProductGrup();
                        $add_grup->product_id = $model->id;
                        $add_grup->grup_id = $grup_id;
                        $add_grup->save();
                    }
                }
            } else {

                $grups = ProductGrup::find()->where(['product_id' => $model->id])->all();
                if ($grups) {
                    foreach ($grups as $g) {
                        $g->delete();
                    }
                }
            }

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDelete($id)
    {
        $dir = Yii::getAlias('@frontendWeb');
        $model = $this->findModel($id);
        $images = ProductImage::find()->where(['product_id' => $model->id])->all();
        $tags = ProductTag::find()->where(['product_id' => $model->id])->all();
        $grups = ProductGrup::find()->where(['product_id' => $model->id])->all();
        foreach ($images as $image) {
            if (file_exists($dir . '/product/' . $image->name)) {
                unlink($dir . '/product/' . $image->name);
            }
            $image->delete();
        }
        foreach ($tags as $tag) {
            $tag->delete();
        }

        foreach ($grups as $grup) {
            $grup->delete();
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionCreateImage($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $model = Product::find()->where(['id' => $id])->one();
        $imageModel = new ProductImage();
        $imageModel->product_id = $id;

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            if ($request->isGet) {
                return [
                    'title' => "Додавання зображення: " . $model->name,
                    'content' => $this->renderAjax('create-image', [
                        'imageModel' => $imageModel,
                    ]),
                ];
            } else if ($imageModel->load($request->post()) && $imageModel->save()) {
                return [
                    'forceReload' => '#images-table',
                ];
            }
        }
    }

    public function actionAjaxUpload($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $stock = Product::find()->where(['id' => $id])->one();
        $directory = $stock->id;
        $model = new ProductImage();
        if (Yii::$app->request->isAjax && $model->validate()) {
            $dir = Yii::getAlias('@frontendWeb/product/');
            if (!file_exists($dir . $directory)) {
                mkdir($dir . $directory, 0777);
            }
//            $watermark = Yii::getAlias('@frontend' . '/web/img/watermark1.png');
            foreach (UploadedFile::getInstances($model, 'name') as $file) {
                $imageName = date('d-m-Y', time()) . '-' . uniqid();
                if ($file->extension == 'jpg' || $file->extension == 'gif' || $file->extension == 'png' || $file->extension == 'jpeg') {
                    $file->saveAs($dir . $directory . '/' . 'del-' . $imageName . '.' . $file->extension);
                    $imagePath = $dir . $directory . '/' . 'del-' . $imageName . '.' . $file->extension;
                    $cropPath = $dir . $directory . '/' . $imageName . '.' . $file->extension;
                    Image::resize($imagePath, 1640, 1480)->save($cropPath, ['quality' => 80]);
                    unlink($dir . $directory . '/' . 'del-' . $imageName . '.' . $file->extension);
                } else {
                    $file->saveAs($dir . $directory . '/' . $imageName . '.' . $file->extension);
                }
                $new_file = new ProductImage();

                $new_file->product_id = $id;
                $new_file->name = $directory . '/' . $imageName . '.' . $file->extension;
                if ($new_file->save() and file_exists($dir . $directory)) {
                    Yii::$app->getSession()->addFlash('success', "Файл: {$new_file->name} успешно добавлен");
                }
                if (Yii::$app->response->statusCode = 200) {
                    return true;
                }
            }
        } else {
            if (Yii::$app->request->referrer != Yii::$app->request->absoluteUrl) {
                Url::remember(Yii::$app->request->referrer ? Yii::$app->request->referrer : null);
            }
            if (!Yii::$app->request->isPost) {
                $model->setAttributes(Yii::$app->request->get());
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionRemoveImage($id)
    {
        $image = ProductImage::find()->where(['id' => $id])->one();
        $dir = Yii::getAlias('@frontendWeb/product/');
        $product = Product::find()->where(['id' => $image->product_id])->one();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if (unlink($dir . $image->name)) {
                if ($image->delete()) {
                    return true;
                }
            }
        }


    }
}
