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
        $i = 0;

        $periodStart = Report::find()
            ->select(['date_delivery'])
            ->min('date_delivery');

        $periodEnd = Report::find()
            ->select(['date_delivery'])
            ->max('date_delivery');

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['periodStart'])) {
                $periodStart = $_GET['periodStart'];
                $periodEnd = $_GET['periodEnd'];
            }


        }

        $bigQty = [];
        $smallQty = [];

        $bigSum = [];
        $smallSum = [];

        $bigIncomingPriceSum = [];
        $smallIncomingPriceSum = [];

        $bigDiscount = [];
        $smallDiscount = [];

        $bigDelivery = [];
        $smallDelivery = [];

        $bigPlatform = [];
        $smallPlatform = [];

        $models = Report::find()
            ->select(['id', 'platform', 'date_delivery', 'price_delivery', 'order_status_id', 'order_pay_ment_id'])
            ->where(['between', 'date_delivery', $periodStart, $periodEnd])
            ->all();

        foreach ($models as $model) {
            $package = $model->getPackage($model->id);

            if ($model->order_pay_ment_id == 'Оплачено') {

                switch ($package) {

                    case 'Фермерська':
                        $bigQty[] = $package;
                        $bigSum[] = $model->getTotalSumm($model->id);
                        $bigIncomingPriceSum[] = $model->getItemsIncomingPrice($model->id);
                        $bigDiscount[] = $model->getItemsDiscount($model->id);
                        $bigPlatform[] = $model->getItemsPlatformPrice($model->id);
                        $bigDelivery[] = $model->price_delivery;

                        break;
                    case 'Дрібна':
                        $smallQty[] = $package;
                        $smallSum[] = $model->getTotalSumm($model->id);
                        $smallIncomingPriceSum[] = $model->getItemsIncomingPrice($model->id);
                        $smallDiscount[] = $model->getItemsDiscount($model->id);
                        $smallPlatform[] = $model->getItemsPlatformPrice($model->id);
                        $smallDelivery[] = $model->price_delivery;

                        break;
                    case 'Фермерська + Дрібна':
                        $bigQty[] = 'BIG';
                        $smallQty[] = 'SMALL';
                        $smallDelivery[] = $model->price_delivery;
                        $items = ReportItem::find()->where(['order_id' => $model->id])->asArray()->all();
                        foreach ($items as $item) {
                            if ($item['package'] == 'BIG') {
                                $bigSum[] = $item['price'] * $item['quantity'];
                                $bigIncomingPriceSum[] = $item['entry_price'] * $item['quantity'];
                                $bigDiscount[] = $item['discount'];
                                $bigPlatform[] = $item['platform_price'];
                            } else {
                                $smallSum[] = $item['price'] * $item['quantity'];
                                $smallIncomingPriceSum[] = $item['entry_price'] * $item['quantity'];
                                $smallDiscount[] = $item['discount'];
                                $smallPlatform[] = $item['platform_price'];
                            }
                        }

                        break;
                    default;
                        $noPackage[] = 'Не визначено';
                        break;
                }
            }elseif ($model->order_status_id == 'Повернення'){

                switch ($package) {

                    case 'Фермерська':

                        $bigDelivery[] = $model->price_delivery;

                        break;
                    case 'Дрібна':

                        $smallDelivery[] = $model->price_delivery;

                        break;
                    case 'Фермерська + Дрібна':

                        $smallDelivery[] = $model->price_delivery;

                        break;
                    default;
                        $noPackage[] = 'Не визначено';
                        break;
                }
            } else {
                $i++;
            }
        }
        $bigQty = count($bigQty);
        $smallQty = count($smallQty);

        $bigSum = array_sum($bigSum);
        $smallSum = array_sum($smallSum);

        $bigIncomingPriceSum = array_sum($bigIncomingPriceSum);
        $smallIncomingPriceSum = array_sum($smallIncomingPriceSum);

        $bigDiscount = array_sum($bigDiscount);
        $smallDiscount = array_sum($smallDiscount);

        $bigDelivery = array_sum($bigDelivery);
        $smallDelivery = array_sum($smallDelivery);

        $bigPlatform = array_sum($bigPlatform);
        $smallPlatform = array_sum($smallPlatform);

        return $this->render('period-report', [
            'model' => $models,

            'periodStart' => $periodStart,
            'periodEnd' => $periodEnd,

            'bigQty' => $bigQty,
            'smallQty' => $smallQty,

            'bigSum' => $bigSum,
            'smallSum' => $smallSum,

            'bigIncomingPriceSum' => $bigIncomingPriceSum,
            'smallIncomingPriceSum' => $smallIncomingPriceSum,

            'bigDiscount' => $bigDiscount,
            'smallDiscount' => $smallDiscount,

            'bigDelivery' => $bigDelivery,
            'smallDelivery' => $smallDelivery,

            'bigPlatform' => $bigPlatform,
            'smallPlatform' => $smallPlatform,
        ]);
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