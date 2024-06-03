<?php

namespace backend\controllers;

use common\models\Report;
use backend\models\search\ReportSearch;
use common\models\ReportItem;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReportController implements the CRUD actions for Report model.
 */
class ReportController extends Controller
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
     * Lists all Report models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ReportSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Report model.
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
     * Creates a new Report model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Report();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Report model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Report model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $products = ReportItem::find()->where(['order_id' => $model->id])->all();
        foreach ($products as $product) {

            $product->delete();
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    public function actionAddReportItem()
    {
        $model = new ReportItem();
        if (Yii::$app->request->isGet) {

            $report_item = Yii::$app->request->get();

            $model->order_id = $report_item['reportId'];
            $model->product_name = $report_item['productName'];
            $model->quantity = $report_item['quantity'];
            $model->price = $report_item['price'];
            $model->package = $report_item['package'];
            $model->entry_price = $report_item['in_price'];
            $model->discount = $report_item['discount_price'];
            $model->platform_price = $report_item['platform_price'];
            $model->save(true);

        }
        return $this->redirect(['view', 'id' => $report_item['reportId']]);
    }

    public function actionUpdateReportItem()
    {
        if (Yii::$app->request->isGet) {

            $report_item = Yii::$app->request->get();
            $item = ReportItem::find()->where(['id' => $report_item['reportItemId']])->one();

            $item->quantity = $report_item['quantity'];
            $item->price = $report_item['price'];
            $item->package = $report_item['package'];
            $item->entry_price = $report_item['in_price'];
            $item->discount = $report_item['discount_price'];
            $item->platform_price = $report_item['platform_price'];
            $item->save(true);

            return $this->redirect(['view', 'id' => $item->order_id]);
        }
        return $this->redirect('index');
    }

    public function actionDeleteReportItem($id)
    {
        $reportItem = ReportItem::findOne($id);
        if ($reportItem) {
            $reportItem->delete();

            return $this->redirect(['view', 'id' => $reportItem->order_id]);
        } else {
            throw new NotFoundHttpException('Товар не найден');
        }
    }

    public function actionPeriodReport()
    {
        $periodStart = Report::find()->min('date_delivery');
        $periodEnd = Report::find()->max('date_delivery');

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['periodStart'])) {
            $periodStart = $_GET['periodStart'];
            $periodEnd = $_GET['periodEnd'];
        }

        $bigQty = $bigSum = $bigAllQty = $bigAllSum = $bigDiscount = $bigDelivery = $bigPlatform = [];
        $smallQty = $smallSum = $smallAllQty = $smallAllSum = $smallDiscount = $smallDelivery = $smallPlatform = [];
        $bigAllReturnQty = $smallAllReturnQty = $bigIncomingPriceSum = $smallIncomingPriceSum = [];
        $noPackage = [];
        $i = 0;

        $models = Report::find()
            ->select(['id', 'platform', 'date_delivery', 'price_delivery', 'order_status_id', 'order_pay_ment_id'])
            ->where(['between', 'date_delivery', $periodStart, $periodEnd])
            ->all();

        foreach ($models as $model) {
            $package = $model->getPackage($model->id);
            $isPaid = $model->order_pay_ment_id == 'Оплачено';
            $isReturn = $model->order_status_id == 'Повернення' || $model->order_pay_ment_id == 'Повернення';
            $totalSum = $model->getTotalSumm($model->id);
            $incomingPriceSum = $model->getItemsIncomingPrice($model->id);
            $discount = $model->getItemsDiscount($model->id);
            $platformPrice = $model->getItemsPlatformPrice($model->id);
            $priceDelivery = $model->price_delivery;

            if ($isPaid || $isReturn) {
                switch ($package) {
                    case 'Фермерська':
                        if ($isPaid) {
                            $bigQty[] = $package;
                            $bigSum[] = $totalSum;
                            $bigIncomingPriceSum[] = $incomingPriceSum;
                            $bigDiscount[] = $discount;
                            $bigPlatform[] = $platformPrice;
                            $bigDelivery[] = $priceDelivery;
                        } else {
                            $bigAllReturnQty[] = 'BIG';
                            $bigDelivery[] = $priceDelivery;
                        }
                        break;
                    case 'Дрібна':
                        if ($isPaid) {
                            $smallQty[] = $package;
                            $smallSum[] = $totalSum;
                            $smallIncomingPriceSum[] = $incomingPriceSum;
                            $smallDiscount[] = $discount;
                            $smallPlatform[] = $platformPrice;
                            $smallDelivery[] = $priceDelivery;
                        } else {
                            $smallAllReturnQty[] = 'SMALL';
                            $smallDelivery[] = $priceDelivery;
                        }
                        break;
                    case 'Фермерська + Дрібна':
                        if ($isPaid) {
                            $bigQty[] = 'BIG';
                            $smallQty[] = 'SMALL';
                            $smallDelivery[] = $priceDelivery;
                            $items = ReportItem::find()->where(['order_id' => $model->id])->asArray()->all();
                            foreach ($items as $item) {
                                $quantity = $item['quantity'];
                                if ($item['package'] == 'BIG') {
                                    $bigSum[] = $item['price'] * $quantity;
                                    $bigIncomingPriceSum[] = $item['entry_price'] * $quantity;
                                    $bigDiscount[] = $item['discount'];
                                    $bigPlatform[] = $item['platform_price'];
                                } else {
                                    $smallSum[] = $item['price'] * $quantity;
                                    $smallIncomingPriceSum[] = $item['entry_price'] * $quantity;
                                    $smallDiscount[] = $item['discount'];
                                    $smallPlatform[] = $item['platform_price'];
                                }
                            }
                        } else {
                            $bigAllReturnQty[] = 'BIG';
                            $smallAllReturnQty[] = 'SMALL';
                            $smallDelivery[] = $priceDelivery;
                        }
                        break;
                    default:
                        $noPackage[] = 'Не визначено';
                        break;
                }
            } else {
                $i++;
            }

            switch ($package) {
                case 'Фермерська':
                    $bigAllQty[] = $package;
                    $bigAllSum[] = $totalSum;
                    break;
                case 'Дрібна':
                    $smallAllQty[] = $package;
                    $smallAllSum[] = $totalSum;
                    break;
                case 'Фермерська + Дрібна':
                    $bigAllQty[] = 'BIG';
                    $smallAllQty[] = 'SMALL';
                    $items = ReportItem::find()->where(['order_id' => $model->id])->asArray()->all();
                    foreach ($items as $item) {
                        $quantity = $item['quantity'];
                        if ($item['package'] == 'BIG') {
                            $bigAllSum[] = $item['price'] * $quantity;
                        } else {
                            $smallAllSum[] = $item['price'] * $quantity;
                        }
                    }
                    break;
                default:
                    $noPackage[] = 'Не визначено';
                    break;
            }
        }

        $bigQtyCount = count($bigQty);
        $bigSumTotal = array_sum($bigSum);
        $smallQtyCount = count($smallQty);
        $smallSumTotal = array_sum($smallSum);
        $bigAllQtyCount = count($bigAllQty);
        $bigAllSumTotal = array_sum($bigAllSum);
        $smallAllQtyCount = count($smallAllQty);
        $smallAllSumTotal = array_sum($smallAllSum);
        $bigDiscountTotal = array_sum($bigDiscount);
        $bigDeliveryTotal = array_sum($bigDelivery);
        $bigPlatformTotal = array_sum($bigPlatform);
        $smallDiscountTotal = array_sum($smallDiscount);
        $smallDeliveryTotal = array_sum($smallDelivery);
        $smallPlatformTotal = array_sum($smallPlatform);
        $bigAllReturnQtyCount = count($bigAllReturnQty);
        $smallAllReturnQtyCount = count($smallAllReturnQty);
        $bigIncomingPriceSumTotal = array_sum($bigIncomingPriceSum);
        $smallIncomingPriceSumTotal = array_sum($smallIncomingPriceSum);

        return $this->render('period-report', [
            'model' => $models,
            'bigQty' => $bigQtyCount,
            'bigSum' => $bigSumTotal,
            'smallQty' => $smallQtyCount,
            'smallSum' => $smallSumTotal,
            'periodEnd' => $periodEnd,
            'bigAllQty' => $bigAllQtyCount,
            'bigAllSum' => $bigAllSumTotal,
            'periodStart' => $periodStart,
            'smallAllQty' => $smallAllQtyCount,
            'smallAllSum' => $smallAllSumTotal,
            'bigDiscount' => $bigDiscountTotal,
            'bigDelivery' => $bigDeliveryTotal,
            'bigPlatform' => $bigPlatformTotal,
            'smallDiscount' => $smallDiscountTotal,
            'smallDelivery' => $smallDeliveryTotal,
            'smallPlatform' => $smallPlatformTotal,
            'bigAllReturnQty' => $bigAllReturnQtyCount,
            'smallAllReturnQty' => $smallAllReturnQtyCount,
            'bigIncomingPriceSum' => $bigIncomingPriceSumTotal,
            'smallIncomingPriceSum' => $smallIncomingPriceSumTotal,
        ]);
    }

    public function actionPromReport()
    {
        $periodStart = Report::find()->min('date_delivery');
        $periodEnd = Report::find()->max('date_delivery');

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['periodStart'])) {
            $periodStart = $_GET['periodStart'];
            $periodEnd = $_GET['periodEnd'];
        }

        $bigQty = $bigSum = $bigDiscount = $bigDelivery = $bigPlatform = [];
        $smallQty = $smallSum = $smallDiscount = $smallDelivery = $smallPlatform = [];
        $bigIncomingPriceSum = $smallIncomingPriceSum = [];
        $noPackage = [];

        $models = Report::find()
            ->select(['id', 'platform', 'date_delivery', 'price_delivery', 'order_status_id', 'order_pay_ment_id'])
            ->where(['between', 'date_delivery', $periodStart, $periodEnd])
            ->andWhere(['platform' => 'Prom'])
            ->all();

        foreach ($models as $model) {
            $package = $model->getPackage($model->id);
            $totalSum = $model->getTotalSumm($model->id);
            $incomingPriceSum = $model->getItemsIncomingPrice($model->id);
            $discount = $model->getItemsDiscount($model->id);
            $platformPrice = $model->getItemsPlatformPrice($model->id);
            $priceDelivery = $model->price_delivery;

                switch ($package) {
                    case 'Фермерська':
                            $bigQty[] = $package;
                            $bigSum[] = $totalSum;
                            $bigIncomingPriceSum[] = $incomingPriceSum;
                            $bigDiscount[] = $discount;
                            $bigPlatform[] = $platformPrice;
                            $bigDelivery[] = $priceDelivery;
                        break;
                    case 'Дрібна':
                            $smallQty[] = $package;
                            $smallSum[] = $totalSum;
                            $smallIncomingPriceSum[] = $incomingPriceSum;
                            $smallDiscount[] = $discount;
                            $smallPlatform[] = $platformPrice;
                            $smallDelivery[] = $priceDelivery;
                        break;
                    case 'Фермерська + Дрібна':
                            $bigQty[] = 'BIG';
                            $smallQty[] = 'SMALL';
                            $smallDelivery[] = $priceDelivery;
                            $items = ReportItem::find()->where(['order_id' => $model->id])->asArray()->all();
                            foreach ($items as $item) {
                                $quantity = $item['quantity'];
                                if ($item['package'] == 'BIG') {
                                    $bigSum[] = $item['price'] * $quantity;
                                    $bigIncomingPriceSum[] = $item['entry_price'] * $quantity;
                                    $bigDiscount[] = $item['discount'];
                                    $bigPlatform[] = $item['platform_price'];
                                } else {
                                    $smallSum[] = $item['price'] * $quantity;
                                    $smallIncomingPriceSum[] = $item['entry_price'] * $quantity;
                                    $smallDiscount[] = $item['discount'];
                                    $smallPlatform[] = $item['platform_price'];
                                }
                            }
                        break;
                    default:
                        $noPackage[] = 'Не визначено';
                        break;
                }
        }

        $bigQtyCount = count($bigQty);
        $bigSumTotal = array_sum($bigSum);
        $smallQtyCount = count($smallQty);
        $smallSumTotal = array_sum($smallSum);
        $bigDiscountTotal = array_sum($bigDiscount);
        $bigDeliveryTotal = array_sum($bigDelivery);
        $bigPlatformTotal = array_sum($bigPlatform);
        $smallDiscountTotal = array_sum($smallDiscount);
        $smallDeliveryTotal = array_sum($smallDelivery);
        $smallPlatformTotal = array_sum($smallPlatform);
        $bigIncomingPriceSumTotal = array_sum($bigIncomingPriceSum);
        $smallIncomingPriceSumTotal = array_sum($smallIncomingPriceSum);

        return $this->render('prom-report', [
            'model' => $models,
            'bigQty' => $bigQtyCount,
            'bigSum' => $bigSumTotal,
            'periodEnd' => $periodEnd,
            'smallQty' => $smallQtyCount,
            'smallSum' => $smallSumTotal,
            'periodStart' => $periodStart,
            'bigDiscount' => $bigDiscountTotal,
            'bigDelivery' => $bigDeliveryTotal,
            'bigPlatform' => $bigPlatformTotal,
            'smallDiscount' => $smallDiscountTotal,
            'smallDelivery' => $smallDeliveryTotal,
            'smallPlatform' => $smallPlatformTotal,
            'bigIncomingPriceSum' => $bigIncomingPriceSumTotal,
            'smallIncomingPriceSum' => $smallIncomingPriceSumTotal,
        ]);
    }

    public function actionAdvertisingReport()
    {
        $periodStart = Report::find()
            ->where(['not', ['date_delivery' => null]])
            ->andWhere(['<>', 'date_delivery', ''])
            ->orderBy(['date_delivery' => SORT_ASC])
            ->select(['date_delivery'])
            ->scalar();
        $periodEnd = Report::find()->max('date_delivery');
        $budget = 0;

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['periodStart'])) {
            $periodStart = $_GET['periodStart'];
            $periodEnd = $_GET['periodEnd'];
            $budget = $_GET['budget'];
        }

        $bigQty = $bigSum = $bigDiscount = $bigDelivery = $bigPlatform = [];
        $smallQty = $smallSum = $smallDiscount = $smallDelivery = $smallPlatform = [];
        $bigIncomingPriceSum = $smallIncomingPriceSum = [];
        $noPackage = [];

        $platformName = ['Агропроцвіт', 'FaceBook', 'Instagram'];

        $models = Report::find()
            ->select(['id', 'platform', 'date_delivery', 'price_delivery', 'order_status_id', 'order_pay_ment_id'])
            ->where(['between', 'date_delivery', $periodStart, $periodEnd])
            ->andWhere(['platform' => $platformName])
            ->all();

        foreach ($models as $model) {
            $package = $model->getPackage($model->id);
            $totalSum = $model->getTotalSumm($model->id);
            $incomingPriceSum = $model->getItemsIncomingPrice($model->id);
            $discount = $model->getItemsDiscount($model->id);
            $platformPrice = $model->getItemsPlatformPrice($model->id);
            $priceDelivery = $model->price_delivery;

                switch ($package) {
                    case 'Фермерська':
                            $bigQty[] = $package;
                            $bigSum[] = $totalSum;
                            $bigIncomingPriceSum[] = $incomingPriceSum;
                            $bigDiscount[] = $discount;
                            $bigPlatform[] = $platformPrice;
                            $bigDelivery[] = $priceDelivery;
                        break;
                    case 'Дрібна':
                            $smallQty[] = $package;
                            $smallSum[] = $totalSum;
                            $smallIncomingPriceSum[] = $incomingPriceSum;
                            $smallDiscount[] = $discount;
                            $smallPlatform[] = $platformPrice;
                            $smallDelivery[] = $priceDelivery;
                        break;
                    case 'Фермерська + Дрібна':
                            $bigQty[] = 'BIG';
                            $smallQty[] = 'SMALL';
                            $smallDelivery[] = $priceDelivery;
                            $items = ReportItem::find()->where(['order_id' => $model->id])->asArray()->all();
                            foreach ($items as $item) {
                                $quantity = $item['quantity'];
                                if ($item['package'] == 'BIG') {
                                    $bigSum[] = $item['price'] * $quantity;
                                    $bigIncomingPriceSum[] = $item['entry_price'] * $quantity;
                                    $bigDiscount[] = $item['discount'];
                                    $bigPlatform[] = $item['platform_price'];
                                } else {
                                    $smallSum[] = $item['price'] * $quantity;
                                    $smallIncomingPriceSum[] = $item['entry_price'] * $quantity;
                                    $smallDiscount[] = $item['discount'];
                                    $smallPlatform[] = $item['platform_price'];
                                }
                            }
                        break;
                    default:
                        $noPackage[] = 'Не визначено';
                        break;
                }
        }

        $bigQtyCount = count($bigQty);
        $bigSumTotal = array_sum($bigSum);
        $smallQtyCount = count($smallQty);
        $smallSumTotal = array_sum($smallSum);
        $bigDiscountTotal = array_sum($bigDiscount);
        $bigDeliveryTotal = array_sum($bigDelivery);
        $bigPlatformTotal = array_sum($bigPlatform);
        $smallDiscountTotal = array_sum($smallDiscount);
        $smallDeliveryTotal = array_sum($smallDelivery);
        $smallPlatformTotal = array_sum($smallPlatform);
        $bigIncomingPriceSumTotal = array_sum($bigIncomingPriceSum);
        $smallIncomingPriceSumTotal = array_sum($smallIncomingPriceSum);

        return $this->render('advertising-report', [
            'model' => $models,
            'budget' => $budget,
            'bigQty' => $bigQtyCount,
            'bigSum' => $bigSumTotal,
            'periodEnd' => $periodEnd,
            'smallQty' => $smallQtyCount,
            'smallSum' => $smallSumTotal,
            'periodStart' => $periodStart,
            'bigDiscount' => $bigDiscountTotal,
            'bigDelivery' => $bigDeliveryTotal,
            'bigPlatform' => $bigPlatformTotal,
            'smallDiscount' => $smallDiscountTotal,
            'smallDelivery' => $smallDeliveryTotal,
            'smallPlatform' => $smallPlatformTotal,
            'bigIncomingPriceSum' => $bigIncomingPriceSumTotal,
            'smallIncomingPriceSum' => $smallIncomingPriceSumTotal,
        ]);
    }

    public function actionAssistant()
    {
        return $this->render('assistant');
    }

    /**
     * Finds the Report model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Report the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Report::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}