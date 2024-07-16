<?php

use yii\bootstrap5\Breadcrumbs;
use common\models\Report;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\search\ReportSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Reports');
$this->params['breadcrumbs'][] = $this->title;

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

?>
<div id="top" class="sa-app__body">
    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
        <div class="container" style="max-width: 1623px">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <nav class="mb-2" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-sa-simple">
                                <?php echo Breadcrumbs::widget([
                                    'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                                    'homeLink' => [
                                        'label' => Yii::t('app', 'Home'),
                                        'url' => Yii::$app->homeUrl,
                                    ],
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]);
                                ?>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-auto d-flex">
                        <?= Html::a(Yii::t('app', 'Звіт за Період'), Url::to(['report/period-report']), ['class' => 'btn btn-secondary me-3']) ?>
                    </div>
                    <div class="col-auto d-flex">
                        <?= Html::a(Yii::t('app', 'Звіт по Prom'), Url::to(['report/prom-report']), ['class' => 'btn btn-prom me-3']) ?>
                    </div>
                    <div class="col-auto d-flex">
                        <?= Html::a(Yii::t('app', 'Звіт по Рекламі'), Url::to(['report/advertising-report']), ['class' => 'btn btn-success me-3']) ?>
                    </div>
                    <div class="col-auto d-flex">
                        <?= Html::a(Yii::t('app', 'Асистент ' . $assistFlagBig . $assistFlagSmall), Url::to(['report/assistant']), ['class' => 'btn btn-info me-3']) ?>
                    </div>
                    <div class="col-auto d-flex">
                        <?= Html::a(Yii::t('app', 'New +'), Url::to(['create']), ['class' => 'btn btn-primary me-3']) ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="p-4">
                    <input
                            aria-label="table-search"
                            type="text"
                            placeholder="<?= Yii::t('app', 'Start typing to search for statuses') ?>"
                            class="form-control form-control--search mx-auto"
                            id="table-search"
                    />
                </div>
                <div class="sa-divider"></div>
                <table class="table table-striped sa-datatables-init" data-ordering='true' data-order='[[ 14, "desc" ]]'
                       data-sa-search-input="#table-search">
                    <thead>
                    <tr style="background-color: rgba(111,190,79,0.53)">
                        <th class="min-w-5x" data-orderable="false"><?= Yii::t('app', 'Number Order') ?></th>
                        <th class="min-w-5x"><?= Yii::t('app', 'Platform') ?></th>
                        <th class="min-w-5x"><?= Yii::t('app', 'Order Status') ?></th>
                        <th class="min-w-5x" data-orderable="false"><?= Yii::t('app', 'Summa') ?></th>
                        <th class="min-w-5x"><?= Yii::t('app', 'Package') ?></th>
                        <th class="min-w-5x"><?= Yii::t('app', 'Fio') ?></th>
                        <th class="min-w-5x"><?= Yii::t('app', 'Payment Status') ?></th>
                        <th class="min-w"><?= Yii::t('app', 'Count Orders') ?></th>
                        <th class="min-w-5x"><?= Yii::t('app', 'Date Delivery') ?></th>
                        <th class="min-w-5x"><?= Yii::t('app', 'Type Payment') ?></th>
                        <th class="min-w-5x"><?= Yii::t('app', 'Phone') ?></th>
                        <th class="min-w-5x" data-orderable="false"><?= Yii::t('app', 'Delivery Service') ?></th>
                        <th class="min-w-15x"><?= Yii::t('app', 'Address') ?></th>
                        <th class="min-w-5x"><?= Yii::t('app', 'TTH') ?></th>
                        <th class="min-w-5x"><?= Yii::t('app', 'Data Order') ?></th>
                        <th class="min-w-15x hidden-cell"><?= Yii::t('app', 'Goods') ?></th>
                        <th class="w-min" data-orderable="false"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($dataProvider->models as $model): ?>
                        <tr>
                            <?php $sum = $model->getTotalSumm($model->id) ?>
                            <?php $orderStatus = $model->getExecutionStatus($model->order_status_id) ?>

                            <td><?= $model->number_order ?></td>
                            <td><?= $model->platform ?></td>
                            <td class="text-center"><?= $orderStatus ?></td>
                            <?php if (($model->order_status_id === 'Повернення' || $model->order_status_id === 'Відміна') && $sum != 0) { ?>
                                <td style="font-weight: bold; color: red">
                                    <?= Yii::$app->formatter->asDecimal($sum, 2) ?></td>
                            <?php } else { ?>
                                <td style="font-weight: bold">
<!--                                    --><?php //echo Yii::$app->formatter->asDecimal(($sum - $model->nova_pay), 2) ?><!--</td>-->
                                    <?= Yii::$app->formatter->asDecimal(($sum), 2) ?></td>
                            <?php } ?>
                            <td class="text-center"><?= $model->getPackage($model->id) ?></td>
                            <td><a href="<?= Url::to(['report/view', 'id' => $model->id]) ?>"
                                   class="text-reset text-nowrap"><?= $model->fio ?></a></td>
                            <td class="text-center"><?= $model->getPayMentStatus($model->order_pay_ment_id) ?></td>
                            <td class="text-center"><?= $model->getCountOrders($model->tel_number) ?></td>
                            <td><?= !empty($model->date_delivery) ? Yii::$app->formatter->asDate($model->date_delivery, 'php:d-m-Y') : '' ?></td>
                            <td><?= $model->type_payment ?></td>
                            <td><?= $model->getPhoneCut($model->tel_number) ?></td>
                            <td class="text-center"><?= $model->getDeliveryLogo($model->delivery_service) ?></td>
                            <td><?= $model->address ?></td>
                            <td><?= $model->ttn ?></td>
                            <td><?= $model->date_order ?></td>
                            <td class="hidden-cell"><?= $model->getGoodsName($model->id) ?></td>
                            <td>
                                <div class="dropdown">
                                    <button
                                            class="btn btn-sa-muted btn-sm"
                                            type="button"
                                            id="category-context-menu-0"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                            aria-label="More"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="3" height="13"
                                             fill="currentColor">
                                            <path
                                                    d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z"
                                            ></path>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end"
                                        aria-labelledby="category-context-menu-0">
                                        <li>
                                            <?= Html::a(Yii::t('app', 'View'), ['report/view', 'id' => $model->id], [
                                                'class' => 'dropdown-item text-info',
                                            ]) ?>
                                        </li>
                                        <li>
                                            <?= Html::a(Yii::t('app', 'Update'), ['report/update', 'id' => $model->id], [
                                                'class' => 'dropdown-item text-warning',
                                            ]) ?>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider"/>
                                        </li>
                                        <li>
                                            <?= Html::a(Yii::t('app', 'Delete'), ['report/delete', 'id' => $model->id], ['class' => "dropdown-item text-danger",
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                    'method' => 'post'
                                                ]
                                            ]) ?>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
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
    .hidden-cell {
        display: none;
    }

</style>