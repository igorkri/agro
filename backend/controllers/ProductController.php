<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Response;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\filters\VerbFilter;
use common\models\Settings;
use yii\helpers\ArrayHelper;
use common\models\UploadForm;
use common\models\shop\Product;
use yii\web\NotFoundHttpException;
use common\models\shop\ActivePages;
use common\models\shop\ProductGrup;
use common\models\shop\ProductTag;
use common\models\shop\ProductImage;
use common\models\shop\AnalogProducts;
use backend\models\search\ProductSearch;
use common\models\shop\ProductProperties;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

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
        $dataProvider = $searchModel->search();
        $currency = Settings::currencyRate();

        $seoErrors = Yii::$app->session->get('errorsSeo');
        if (!$seoErrors){
        Yii::$app->session->set('errorsSeo', 'no');
        }

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
                $model->sku = 'PRO-100' . $model->id;
                $model->save(false);

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
                        $add_grup = new ProductGrup();
                        $add_grup->product_id = $model->id;
                        $add_grup->grup_id = $grup_id;
                        $add_grup->save();
                    }
                }
                if (isset($post_product['analogs']) && $post_product['analogs'] != null) {
                    foreach ($post_product['analogs'] as $analog_id) {
                        $add_analog = new AnalogProducts();
                        $add_analog->product_id = $model->id;
                        $add_analog->analog_product_id = $analog_id;
                        $add_analog->save();
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
            $postProperties = Yii::$app->request->post('ProductProperties', []);
            $sort = 1;
            foreach ($postProperties as $index => $postData) {

                $productProperty = ProductProperties::findOne([
                    'product_id' => $model['id'],
                    'properties' => $postData['properties']
                ]);

                if (!empty($productProperty)) {

                    $productProperty->product_id = $model->id;
                    $productProperty->properties = $postData['properties'];
                    $productProperty->value = $postData['value'];
                    $productProperty->sort = $sort;
                    $productProperty->category_id = $model->category_id;
                } else {
                    $productProperty = new ProductProperties();
                    $productProperty->product_id = $model->id;
                    $productProperty->properties = $postData['properties'];
                    $productProperty->value = $postData['value'];
                    $productProperty->sort = $sort;
                    $productProperty->category_id = $model->category_id;
                }
                $productProperty->save();
                $sort++;
            }

            $post_priority = $this->request->post('priority');
            if (!empty($post_priority)) {
                foreach ($post_priority as $key => $value) {
                    $position = ProductImage::find()->where(['id' => $key])->one();
                    $position->priority = $value;
                    $position->save();
                }
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
            if (!empty($post_product['analogs'])) {
                //удаляем существующие analogs
                $analogs = AnalogProducts::find()->where(['product_id' => $model->id])->all();
                if ($analogs) {
                    foreach ($analogs as $analog) {
                        $analog->delete();
                    }
                }
                $analogs = AnalogProducts::find()->where(['analog_product_id' => $model->id])->all();
                if ($analogs) {
                    foreach ($analogs as $analog) {
                        $analog->delete();
                    }
                }

                foreach ($post_product['analogs'] as $analog_id) {
                    // Добавляем аналог к товару
                    if ($model->id != $analog_id) {
                        $analogToProduct = AnalogProducts::find()
                            ->where(['product_id' => $model->id])
                            ->andWhere(['analog_product_id' => $analog_id])
                            ->one();

                        if (!$analogToProduct) {
                            $add_analog_to_product = new AnalogProducts();
                            $add_analog_to_product->product_id = $model->id;
                            $add_analog_to_product->analog_product_id = $analog_id;
                            $add_analog_to_product->save();
                        }
                    }

                    // Добавляем товар к аналогу
                    if ($model->id != $analog_id) {
                        $productToAnalog = AnalogProducts::find()
                            ->where(['product_id' => $analog_id])
                            ->andWhere(['analog_product_id' => $model->id])
                            ->one();

                        if (!$productToAnalog) {
                            $add_product_to_analog = new AnalogProducts();
                            $add_product_to_analog->product_id = $analog_id;
                            $add_product_to_analog->analog_product_id = $model->id;
                            $add_product_to_analog->save();
                        }
                    }

                    // Добавляем связи между аналогами
                    foreach ($post_product['analogs'] as $other_analog_id) {
                        if ($analog_id != $other_analog_id && $analog_id != $model->id && $other_analog_id != $model->id) {
                            $analogToOtherAnalog = AnalogProducts::find()
                                ->where(['product_id' => $analog_id])
                                ->andWhere(['analog_product_id' => $other_analog_id])
                                ->one();

                            if (!$analogToOtherAnalog) {
                                $add_analog_to_other_analog = new AnalogProducts();
                                $add_analog_to_other_analog->product_id = $analog_id;
                                $add_analog_to_other_analog->analog_product_id = $other_analog_id;
                                $add_analog_to_other_analog->save();
                            }

                            $otherAnalogToAnalog = AnalogProducts::find()
                                ->where(['product_id' => $other_analog_id])
                                ->andWhere(['analog_product_id' => $analog_id])
                                ->one();

                            if (!$otherAnalogToAnalog) {
                                $add_other_analog_to_analog = new AnalogProducts();
                                $add_other_analog_to_analog->product_id = $other_analog_id;
                                $add_other_analog_to_analog->analog_product_id = $analog_id;
                                $add_other_analog_to_analog->save();
                            }
                        }
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
        $dir = Yii::getAlias('@frontendWeb/product/');
        $model = $this->findModel($id);
        $properties = ProductProperties::find()->where(['product_id' => $model->id])->all();
        $images = ProductImage::find()->where(['product_id' => $model->id])->all();
        $tags = ProductTag::find()->where(['product_id' => $model->id])->all();
        $grups = ProductGrup::find()->where(['product_id' => $model->id])->all();
        $analogs = AnalogProducts::find()->where(['product_id' => $model->id])->all();
        foreach ($images as $image) {
            //----------- Удаление всех картинок продукта
            (file_exists($dir . $image->name)) ? unlink($dir . $image->name) : '';
            (file_exists($dir . $image->extra_extra_large)) ? unlink($dir . $image->extra_extra_large) : '';
            (file_exists($dir . $image->extra_large)) ? unlink($dir . $image->extra_large) : '';
            (file_exists($dir . $image->large)) ? unlink($dir . $image->large) : '';
            (file_exists($dir . $image->medium)) ? unlink($dir . $image->medium) : '';
            (file_exists($dir . $image->small)) ? unlink($dir . $image->small) : '';
            (file_exists($dir . $image->extra_small)) ? unlink($dir . $image->extra_small) : '';
            //----------- Удаление каталога продукта
            $files = scandir($dir . $model->id);
            $files = array_diff($files, array('.', '..'));
            (is_dir($dir . $model->id) && empty($files)) ? FileHelper::removeDirectory($dir . $model->id) : '';

            $image->delete();
        }
        foreach ($tags as $tag) {
            $tag->delete();
        }

        foreach ($grups as $grup) {
            $grup->delete();
        }

        foreach ($analogs as $analog) {
            $analog->delete();
        }

        foreach ($properties as $property) {
            $property->delete();
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
                    $cropPathWebp = $dir . $directory . '/' . $imageName . '.' . 'webp';
                    //------------ Основная картинка
                    Image::resize($imagePath, 1640, 1480)->save($cropPath, ['quality' => 80]);
                    Image::resize($imagePath, 1640, 1480)->save($cropPathWebp, ['quality' => 80]);

                    // ----------- Нарезка картинок
                    Image::resize($imagePath, 350, 350)->save($dir . $stock->id . '/extra_extra_large-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 290, 290)->save($dir . $stock->id . '/extra_large-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 195, 195)->save($dir . $stock->id . '/large-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 150, 150)->save($dir . $stock->id . '/medium-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 90, 90)->save($dir . $stock->id . '/small-' . $imageName . '.' . $file->extension, ['quality' => 70]);
                    Image::resize($imagePath, 64, 64)->save($dir . $stock->id . '/extra_small-' . $imageName . '.' . $file->extension, ['quality' => 70]);

                    // ----------- Нарезка картинок Webp
                    Image::resize($imagePath, 350, 350)->save($dir . $stock->id . '/extra_extra_large-' . $imageName . '.' . 'webp', ['quality' => 70]);
                    Image::resize($imagePath, 290, 290)->save($dir . $stock->id . '/extra_large-' . $imageName . '.' . 'webp', ['quality' => 70]);
                    Image::resize($imagePath, 195, 195)->save($dir . $stock->id . '/large-' . $imageName . '.' . 'webp', ['quality' => 70]);
                    Image::resize($imagePath, 150, 150)->save($dir . $stock->id . '/medium-' . $imageName . '.' . 'webp', ['quality' => 70]);
                    Image::resize($imagePath, 90, 90)->save($dir . $stock->id . '/small-' . $imageName . '.' . 'webp', ['quality' => 70]);
                    Image::resize($imagePath, 64, 64)->save($dir . $stock->id . '/extra_small-' . $imageName . '.' . 'webp', ['quality' => 70]);

                    //------ Удаляем временные файлы
                    unlink($dir . $directory . '/' . 'del-' . $imageName . '.' . $file->extension);

                } else {
                    $file->saveAs($dir . $directory . '/' . $imageName . '.' . $file->extension);
                }
                //------ Сохраняем в базу
                $model->product_id = $id;
                $model->name = $directory . '/' . $imageName . '.' . $file->extension;
                $model->extra_extra_large = $stock->id . '/extra_extra_large-' . $imageName . '.' . $file->extension;
                $model->extra_large = $stock->id . '/extra_large-' . $imageName . '.' . $file->extension;
                $model->large = $stock->id . '/large-' . $imageName . '.' . $file->extension;
                $model->medium = $stock->id . '/medium-' . $imageName . '.' . $file->extension;
                $model->small = $stock->id . '/small-' . $imageName . '.' . $file->extension;
                $model->extra_small = $stock->id . '/extra_small-' . $imageName . '.' . $file->extension;

                $model->webp_name = $directory . '/' . $imageName . '.' . 'webp';
                $model->webp_extra_extra_large = $stock->id . '/extra_extra_large-' . $imageName . '.' . 'webp';
                $model->webp_extra_large = $stock->id . '/extra_large-' . $imageName . '.' . 'webp';
                $model->webp_large = $stock->id . '/large-' . $imageName . '.' . 'webp';
                $model->webp_medium = $stock->id . '/medium-' . $imageName . '.' . 'webp';
                $model->webp_small = $stock->id . '/small-' . $imageName . '.' . 'webp';
                $model->webp_extra_small = $stock->id . '/extra_small-' . $imageName . '.' . 'webp';

                if ($model->save() and file_exists($dir . $directory)) {
                    Yii::$app->getSession()->addFlash('success', "Файл: {$model->name} успешно добавлен");
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
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            //----------- Удаление основной картинки и нарезаных
            (file_exists($dir . $image->name)) ? unlink($dir . $image->name) : '';
            (file_exists($dir . $image->extra_extra_large)) ? unlink($dir . $image->extra_extra_large) : '';
            (file_exists($dir . $image->extra_large)) ? unlink($dir . $image->extra_large) : '';
            (file_exists($dir . $image->large)) ? unlink($dir . $image->large) : '';
            (file_exists($dir . $image->medium)) ? unlink($dir . $image->medium) : '';
            (file_exists($dir . $image->small)) ? unlink($dir . $image->small) : '';
            (file_exists($dir . $image->extra_small)) ? unlink($dir . $image->extra_small) : '';

            (file_exists($dir . $image->webp_name)) ? unlink($dir . $image->webp_name) : '';
            (file_exists($dir . $image->webp_extra_extra_large)) ? unlink($dir . $image->webp_extra_extra_large) : '';
            (file_exists($dir . $image->webp_extra_large)) ? unlink($dir . $image->webp_extra_large) : '';
            (file_exists($dir . $image->webp_large)) ? unlink($dir . $image->webp_large) : '';
            (file_exists($dir . $image->webp_medium)) ? unlink($dir . $image->webp_medium) : '';
            (file_exists($dir . $image->webp_small)) ? unlink($dir . $image->webp_small) : '';
            (file_exists($dir . $image->webp_extra_small)) ? unlink($dir . $image->webp_extra_small) : '';

            if ($image->delete()) {
                return true;
            }
        }
    }

    public function actionExportToExcel()
    {
        $products = Product::find()->all();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Название');
        $sheet->setCellValue('B1', 'Цена');
        $sheet->setCellValue('C1', 'Ст. Цена');
        $sheet->setCellValue('D1', 'Наличие');
        $sheet->setCellValue('E1', 'ID');

        $cellStyleAE = $sheet->getStyle('A1:E1');
        $cellStyleAE->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getColumnDimension('A')->setWidth(40);
        $sheet->getColumnDimension('B')->setWidth(12);
        $sheet->getColumnDimension('C')->setWidth(12);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(5);

        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '92d050', // Зеленый цвет
                ],
            ],
        ];
        $sheet->getStyle('A1:E1')->applyFromArray($styleArray);
        $sheet->getStyle('A1:E1')->getFont()->setSize(14); // Установите размер шрифта

        $row = 2; // начнем с второй строки
        foreach ($products as $product) {
            $sheet->setCellValue('A' . $row, $product->name);
            $sheet->setCellValue('B' . $row, $product->price);
            $sheet->setCellValue('C' . $row, $product->old_price);
            $sheet->setCellValue('D' . $row, $product->status->name);
            $sheet->setCellValue('E' . $row, $product->id);

            $cellStyleAll = $sheet->getStyle('A' . $row . ':E' . $row);

            if ($product->status_id == 1) {
                $cellStyleAll->getFill()->setFillType(Fill::FILL_SOLID);
                $cellStyleAll->getFill()->getStartColor()->setRGB('d8e4bc');
            } elseif ($product->status_id == 2) {
                $cellStyleAll->getFill()->setFillType(Fill::FILL_SOLID);
                $cellStyleAll->getFill()->getStartColor()->setRGB('e6b8b7');
            } elseif ($product->status_id == 3) {
                $cellStyleAll->getFill()->setFillType(Fill::FILL_SOLID);
                $cellStyleAll->getFill()->getStartColor()->setRGB('fde9d9');
            } elseif ($product->status_id == 4) {
                $cellStyleAll->getFill()->setFillType(Fill::FILL_SOLID);
                $cellStyleAll->getFill()->getStartColor()->setRGB('b7dee8');
            }

            $cellStyleAll->getFont()->setSize(12);

            $cellStyleAll->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

            $cellStyleBE = $sheet->getStyle('B' . $row . ':E' . $row);

            $cellStyleBE->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $row++;
        }

        ob_start();

        try {
            $writer = new Xlsx($spreadsheet);
            $file_name = 'agro_pro_products__' . date('d_m_Y', time()) . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $file_name . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            Yii::$app->end();
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }

        ob_end_flush();
    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->excelFile = UploadedFile::getInstance($model, 'excelFile');
            $filePath = $model->upload();
            if (file_exists($filePath)) {
                $spreadsheet = IOFactory::load($filePath);
                $worksheet = $spreadsheet->getActiveSheet();
                $data = $worksheet->toArray();
                unlink($filePath);
                $headers = array_shift($data);
                $resultArray = [];
                foreach ($data as $row) {
                    $resultArray[] = array_combine($headers, $row);
                }
                foreach ($resultArray as $item) {
                    if ($item['Цена'] != null && is_numeric($item['Цена'])) {
                        $product = Product::find()
                            ->select(['id', 'name', 'price'])
                            ->where(['id' => $item['ID']])
                            ->one();

                        $product->price = $item['Цена'];
                        $product->old_price = $item['Ст. Цена'];

                        if ($product->save(false)) {

                        } else {
                            print_r($product->errors);
                        }
                    } else {
                        echo "Есть не заполненая цена";
                    }
                }
            } else {
                echo 'Файл не существует.';
            }
            return $this->redirect(['index']);
        }
        return $this->render('upload', ['model' => $model]);
    }

    public function actionActivityProduct()
    {
        $url = [];
        $pages = ActivePages::find()->where(['like', 'url_page', '/product/'])->all();

        foreach ($pages as $page) {
            $url[] = [
                'url' => $page->url_page,
                'date' => $page->date_visit,
            ];
        }
        $uniqueUrls = [];
        $result = [];
        foreach ($url as $item) {
            $url = $item['url'];
            $date = $item['date'];
            if (strpos($url, '/product/') !== false) {
                if (in_array($url, $uniqueUrls)) {
                    $existingIndex = array_search($url, $uniqueUrls);
                    if ($date > $result[$existingIndex]['date']) {
                        $result[$existingIndex] = $item;
                    }
                } else {
                    $uniqueUrls[] = $url;
                    $result[] = $item;
                }
            }
        }
        foreach ($result as $key => $item) {
            $slugProduct = str_replace('/product/', '', $item['url']);
            $idProduct = Product::productId($slugProduct);
            $result[$key]['slug'] = $slugProduct;
            $result[$key]['id'] = $idProduct;
            $result[$key]['count'] = ActivePages::productCountViews($slugProduct);
            $result[$key]['name'] = Product::productName($slugProduct);
            $result[$key]['image'] = Product::productImage($slugProduct);
            $result[$key]['status_id'] = Product::productStatusId($slugProduct);
            $result[$key]['status_name'] = Product::productStatusName($slugProduct);
        }

//        ArrayHelper::multisort($result, ['date'], [SORT_DESC]);
        ArrayHelper::multisort($result, ['count'], [SORT_DESC]);

        return $this->render('all-activity-product', ['result' => $result]);
    }

    public function actionUpdateErrorCheckbox()
    {
        if (Yii::$app->request->isPost) {
            $errors = Yii::$app->request->post('errorsSeo');
            Yii::$app->session->set('errorsSeo', $errors);
            return $this->asJson(['success' => true]);
        }
        return $this->asJson(['success' => false]);
    }
}
