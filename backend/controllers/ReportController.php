<?php

namespace backend\controllers;

use common\models\Report;
use backend\models\search\ReportSearch;
use common\models\ReportItem;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

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
        $periodStart = Report::find()
            ->where(['not', ['date_delivery' => null]])
            ->andWhere(['<>', 'date_delivery', ''])
            ->orderBy(['date_delivery' => SORT_ASC])
            ->select(['date_delivery'])
            ->scalar();
        $periodEnd = Report::find()->max('date_delivery');

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['periodStart'])) {
            $periodStart = $_GET['periodStart'];
            $periodEnd = $_GET['periodEnd'];
        }

        Yii::$app->session->set('periodStart', $periodStart);
        Yii::$app->session->set('periodEnd', $periodEnd);

        $bigQty = $bigSum = $bigAllQty = $bigAllSum = $bigDiscount = $bigDelivery = $bigAllDelivery = $bigPlatform = [];
        $smallQty = $smallSum = $smallAllQty = $smallAllSum = $smallDiscount = $smallDelivery = $smallAllDelivery = $smallPlatform = [];
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
                    $bigAllDelivery[] = $priceDelivery;
                    break;
                case 'Дрібна':
                    $smallAllQty[] = $package;
                    $smallAllSum[] = $totalSum;
                    $smallAllDelivery[] = $priceDelivery;
                    break;
                case 'Фермерська + Дрібна':
                    $bigAllQty[] = 'BIG';
                    $smallAllQty[] = 'SMALL';
                    $bigAllDelivery[] = $priceDelivery;
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

        $bigAllDelivery = array_sum($bigAllDelivery);
        $smallAllDelivery = array_sum($smallAllDelivery);
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
            'bigAllDelivery' => $bigAllDelivery,
            'smallAllDelivery' => $smallAllDelivery,
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
        $periodStart = Report::find()
            ->where(['not', ['date_delivery' => null]])
            ->andWhere(['<>', 'date_delivery', ''])
            ->orderBy(['date_delivery' => SORT_ASC])
            ->select(['date_delivery'])
            ->scalar();
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

    public function actionReportExportToExcel()
    {
        $sumOrders = [];
        $sumIncomingOrders = [];
        $sumDiscountOrders = [];
        $sumPlatformOrders = [];
        $sumDeliveryOrders = [];
        $countsOrders = [];
        $periodStart = Yii::$app->session->get('periodStart');
        $periodEnd = Yii::$app->session->get('periodEnd');

        $models = Report::find()
            ->where(['between', 'date_delivery', $periodStart, $periodEnd])
            ->all();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Платформа');
        $sheet->setCellValue('B1', '№ Замовлення');
        $sheet->setCellValue('C1', 'Дата Відвантаження');
        $sheet->setCellValue('D1', 'Назва Товару');
        $sheet->setCellValue('E1', 'К-ть');
        $sheet->setCellValue('F1', 'Вхід');
        $sheet->setCellValue('G1', 'Ціна (продажна)');
        $sheet->setCellValue('H1', 'Сума (замовлення)');
        $sheet->setCellValue('I1', 'Знижка');
        $sheet->setCellValue('J1', 'Списання з Платформи');
        $sheet->setCellValue('K1', 'Доставка');
        $sheet->setCellValue('L1', 'Дата Оплати');
        $sheet->setCellValue('M1', 'Тип Оплати');
        $sheet->setCellValue('N1', 'П.І.Б');
        $sheet->setCellValue('O1', 'моб Телефон');
        $sheet->setCellValue('P1', 'Адреса');
        $sheet->setCellValue('Q1', 'ТТН');

        $headTableStyle = [
            'font' => [
                'size' => 14,
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '92d050', // Зеленый цвет
                ],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Черный цвет границы
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];
        $bodyTableStyleGrey = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'e5eded', // Цвет заливки
                ],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'd5d4d7b8'], // Черный цвет границы
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];
        $bodyTableStyleWhite = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'fff', // Цвет заливки
                ],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'd5d4d7b8'], // Черный цвет границы
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];
        $footerTableStyle = [
            'font' => [
                'size' => 14,
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'F77575', // Цвет заливки
                ],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'd5d4d7b8'], // Черный цвет границы
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];

        $sheet->getStyle('A1:Q1')->applyFromArray($headTableStyle);
        $sheet->freezePane('A2');
        foreach (range('A', 'Q') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        $sheet->getStyle('Q:Q')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER);
        $sheet->getStyle('F:F')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
        $sheet->getStyle('G:G')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
        $sheet->getStyle('H:H')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
        $sheet->getStyle('I:I')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
        $sheet->getStyle('J:J')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
        $sheet->getStyle('K:K')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);


        $row = 2; // начнем с второй строки
        $j = 0;
        foreach ($models as $model) {
            $countsOrders[] = 1;
            $sumDeliveryOrders[] = $model->price_delivery;
            $i = 0;
            if ($j % 2 === 0) {
                $sheet->getStyle('A' . $row . ':Q' . $row)->applyFromArray($bodyTableStyleGrey);
            } else {
                $sheet->getStyle('A' . $row . ':Q' . $row)->applyFromArray($bodyTableStyleWhite);
            }

            $sheet->setCellValue('A' . $row, $model->platform);
            $sheet->setCellValue('B' . $row, $model->number_order);
            $sheet->setCellValue('C' . $row, $model->date_delivery);
            $sheet->setCellValue('K' . $row, $model->price_delivery);
            $sheet->setCellValue('L' . $row, $model->date_payment);
            $sheet->setCellValue('M' . $row, $model->type_payment);
            $sheet->setCellValue('N' . $row, $model->fio);
            $sheet->setCellValue('O' . $row, $model->tel_number);
            $sheet->setCellValue('P' . $row, $model->address);
            $sheet->setCellValue('Q' . $row, $model->ttn);

            $products = ReportItem::find()->where(['order_id' => $model->id])->all();

            foreach ($products as $product) {
                $sumOrders[] = $product->price * $product->quantity;
                $sumIncomingOrders[] = $product->entry_price * $product->quantity;
                $sumDiscountOrders[] = $product->discount;
                $sumPlatformOrders[] = $product->platform_price;
                if ($j % 2 === 0) {
                    $sheet->getStyle('A' . $row . ':Q' . $row)->applyFromArray($bodyTableStyleGrey);
                } else {
                    $sheet->getStyle('A' . $row . ':Q' . $row)->applyFromArray($bodyTableStyleWhite);
                }

                $sheet->setCellValue('D' . $row, $product->product_name);
                $sheet->setCellValue('E' . $row, $product->quantity);
                $sheet->setCellValue('F' . $row, $product->entry_price);
                $sheet->setCellValue('G' . $row, $product->price);
                $sheet->setCellValue('H' . $row, $product->price * $product->quantity);
                $sheet->setCellValue('I' . $row, $product->discount);
                $sheet->setCellValue('J' . $row, $product->platform_price);
                $row++;
                $i = 1;
            }
            if ($i === 0) {
                $row++;
            }
            $j++;
        }


        $countsOrders = array_sum($countsOrders);
        $sumOrders = array_sum($sumOrders);
        $sumIncomingOrders = array_sum($sumIncomingOrders);
        $sumDiscountOrders = array_sum($sumDiscountOrders);
        $sumPlatformOrders = array_sum($sumPlatformOrders);
        $sumDeliveryOrders = array_sum($sumDeliveryOrders);


        $sheet->setCellValue('A' . $row, 'Всього:');
        $sheet->setCellValue('B' . $row, $countsOrders);
        $sheet->setCellValue('H' . $row, $sumOrders);
        $sheet->setCellValue('F' . $row, $sumIncomingOrders);
        $sheet->setCellValue('J' . $row, $sumPlatformOrders);
        $sheet->setCellValue('I' . $row, $sumDiscountOrders);
        $sheet->setCellValue('K' . $row, $sumDeliveryOrders);
        $sheet->setCellValue('C' . $row, 'з '. $periodStart .' по '. $periodEnd);



        $sheet->getStyle('A' . $row . ':Q' . $row)->applyFromArray($footerTableStyle);


        ob_start();

        try {
            $writer = new Xlsx($spreadsheet);
            $file_name = 'report__' . $periodStart . '__' . $periodEnd . '___' . date('d_m_Y', time()) . '.xlsx';

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