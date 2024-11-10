<?php

use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
use common\models\Report;

/** @var yii\web\View $this */
/** @var backend\models\search\ActivePagesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Reports');

$reportSmallProblem = [
    Report::StatusDeliveryNotSelected(),
    Report::StatusPaymentNotSelected(),
    Report::DatePaymentNot(),
    Report::TypePaymentNot(),
    Report::NunberNot(),
    Report::TtnNot(),
];

$reportBigProblem = [
    Report::IncomingPriceNotSelected(),
    Report::StatusUnpaidMonth(),
];

$orderBigProblem = '<span class="indicator indicator__red"> !</span>';
$orderSmallProblem = '<span class="indicator indicator__yellow">! </span>';
$orderNoProblem = '';

$assistFlagBig = array_filter($reportBigProblem, fn($value) => $value !== null) ? $orderBigProblem : $orderNoProblem;
$assistFlagSmall = array_filter($reportSmallProblem, fn($value) => $value !== null) ? $orderSmallProblem : $orderNoProblem;

$btnPc =
    Html::a(Yii::t('app', 'Звіт за Період'), Url::to(['report/period-report']), ['class' => 'btn btn-secondary me-3']) .
    Html::a(Yii::t('app', 'Звіт по Prom'), Url::to(['report/prom-report']), ['class' => 'btn btn-prom me-3']) .
    Html::a(Yii::t('app', 'Звіт по Рекламі'), Url::to(['report/advertising-report']), ['class' => 'btn btn-success me-3']) .
    Html::a(Yii::t('app', 'Асистент ' . $assistFlagBig . $assistFlagSmall), Url::to(['report/assistant']), ['class' => 'btn btn-info me-3']) .
    Html::a(Yii::t('app', 'New +'), Url::to(['create']), ['class' => 'btn btn-primary me-3']);

$btnMob = false;

?>

<div id="top" class="sa-app__body">
    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
        <div class="container" style="max-width: 1623px">
            <div class="card">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'responsiveWrap' => false,
                    'tableOptions' => ['class' => 'table table-bordered text-center'],
                    'summary' => Yii::$app->devicedetect->isMobile() ? false : "Показано <span class='summary-info'>{begin}</span> - <span class='summary-info'>{end}</span> из <span class='summary-info'>{totalCount}</span> Записей",
                    'panel' => [
                        'type' => 'warning',
                        'heading' => '<h3 class="panel-title"><i class="fas fa-globe"></i> ' . $this->title . '</h3>',
                        'headingOptions' => ['style' => 'height: 50px; margin-top: 10px'],
                        'before' => Yii::$app->devicedetect->isMobile() ? $btnMob : $btnPc,
                        'after' =>
                            Html::a('<i class="fas fa-redo"></i> Обновити', ['index'], ['class' => 'btn btn-info']),
                    ],
                    'pager' => [
                        'class' => LinkPager::class,
                        'options' => ['class' => 'pagination justify-content-center'],
                        'maxButtonCount' => Yii::$app->devicedetect->isMobile() ? 3 : 10,
                        'firstPageLabel' => '<<',
                        'lastPageLabel' => '>>',
                        'prevPageLabel' => '<',
                        'nextPageLabel' => '>',
                    ],
                    'columns' => [
                        'number_order',
                        'platform',
                        [
                            'attribute' => 'order_status_id',
                            'label' => 'Доставка',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->getExecutionStatus($model->order_status_id);
                            },
                            'filter' => [
                                'Очікується' => 'Очікується',
                                'Повернення' => 'Повернення',
                                'Одержано' => 'Одержано',
                                'Комплектується' => 'Комплектується',
                                'Доставляється' => 'Доставляється',
                                'Відміна' => 'Відміна',
                            ],
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                        ],
                        [
                            'attribute' => 'sum',
                            'label' => 'Сума',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $sum = $model->getTotalSumm($model->id);

                                $formattedSum = Yii::$app->formatter->asDecimal($sum, 2);
                                return $sum < 0
                                    ? "<span style='color: red; font-weight: bold'>{$formattedSum}</span>"
                                    : "<span style='font-weight: bold'>{$formattedSum}</span>";
                            },
                        ],
                        [
                            'attribute' => 'package',
                            'label' => 'Пакування',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->getPackage($model->id);
                            },
                            'enableSorting' => true, // Включение сортировки
                        ],
                        [
                            'attribute' => 'fio',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return '<a href="' . Url::to(['report/view', 'id' => $model->id]) . '" style="white-space: nowrap; color: black;">'
                                    . $model->fio .
                                    '</a>';
                            },
                        ],
                        [
                            'attribute' => 'order_pay_ment_id',
                            'label' => 'Оплата',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->getPayMentStatus($model->order_pay_ment_id);
                            },
                            'filter' => [
                                'Повернення' => 'Повернення',
                                'Оплачено' => 'Оплачено',
                                'Відміна' => 'Відміна',
                                'Не оплачено' => 'Не оплачено',
                            ],
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],

                        ],
                        [
                            'attribute' => 'CountOrders',
                            'label' => 'Замовлень',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->getCountOrders($model->tel_number);
                            },
                        ],
                        [
                            'attribute' => 'date_delivery',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $formattedDate = !empty($model->date_delivery)
                                    ? Yii::$app->formatter->asDate($model->date_delivery, 'php:d-m-Y')
                                    : '';

                                return "<span style='white-space: nowrap;'>{$formattedDate}</span>";
                            },
                        ],
                        'type_payment',
                        [
                            'attribute' => 'tel_number',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->getPhoneCut($model->tel_number);
                            },
                        ],
                        [
                            'attribute' => 'delivery_service',
                            'filter' => false,
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->getDeliveryLogo($model->delivery_service);
                            },
                        ],
                        'address',
                        [
                            'attribute' => 'ttn',
                            'label' => 'ТТН',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'date_order',
                            'filter' => false,
                            'label' => 'Створення замовлення',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $formattedDate = !empty($model->date_order)
                                    ? Yii::$app->formatter->asDate($model->date_order, 'php:d-m-Y')
                                    : '';

                                return "<span style='white-space: nowrap;'>{$formattedDate}</span>";
                            },
                        ],

                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, Report $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id, 'selection' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
<style>
    .summary-info {
        font-size: 18px;
        font-weight: bold;
        color: #00050b;
    }

    .indicator {
        height: 15px;
        font-size: 16px;
        padding: 1px 9px;
        margin-left: 5px;
        border-radius: 1000px;
        position: relative;
        font-weight: 700;
    }

    .indicator__red {
        background: #ed2e34;
        color: #f6f7f8;
    }

    .indicator__yellow {
        background: #fbe720;
        color: #3d464d;
    }
</style>

