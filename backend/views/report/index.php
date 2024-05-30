<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\search\ReportSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Reports');
$this->params['breadcrumbs'][] = $this->title;
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
                        <?= Html::a(Yii::t('app', 'Period Report'), Url::to(['report/period-report']), ['class' => 'btn btn-secondary me-3']) ?>
                        <a href="<?= Url::to(['create']) ?>" class="btn btn-primary"><?= Yii::t('app', 'New +') ?></a>
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
                <table class="table table-striped sa-datatables-init" data-ordering='true' data-order='[[ 15, "desc" ]]'
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
                        <th class="min-w-5x"><?= Yii::t('app', 'Number Order 1c') ?></th>
                        <th><?= Yii::t('app', 'ID') ?></th>
                        <th class="w-min" data-orderable="false"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($dataProvider->models as $model): ?>
                        <tr>
                            <?php $orderStatus = $model->getExecutionStatus($model->order_status_id) ?>

                            <td><?= $model->number_order ?></td>
                            <td><?= $model->platform ?></td>
                            <td class="text-center"><?= $orderStatus ?></td>
                            <?php if ($model->order_status_id === 'Повернення') { ?>
                                <td style="font-weight: bold; color: red">
                                    -<?= Yii::$app->formatter->asDecimal($model->getTotalSumm($model->id), 2) ?></td>
                            <?php } else { ?>
                                <td style="font-weight: bold"><?= Yii::$app->formatter->asDecimal($model->getTotalSumm($model->id), 2) ?></td>
                            <?php } ?>
                            <td class="text-center"><?= $model->getPackage($model->id) ?></td>
                            <td><a href="<?= Url::to(['report/view', 'id' => $model->id]) ?>"
                                   class="text-reset text-nowrap"><?= $model->fio ?></a></td>
                            <td class="text-center"><?= $model->getPayMentStatus($model->order_pay_ment_id) ?></td>
                            <td class="text-center"><?= $model->getCountOrders($model->tel_number) ?></td>
                            <td><?= $model->date_delivery ?></td>
                            <td><?= $model->type_payment ?></td>
                            <td><?= $model->getPhoneCut($model->tel_number) ?></td>
                            <td class="text-center"><?= $model->getDeliveryLogo($model->delivery_service) ?></td>
                            <td><?= $model->address ?></td>
                            <td><?= $model->ttn ?></td>
                            <td><?= $model->number_order_1c ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="me-4"><?= $model->id ?></span>
                                </div>
                            </td>
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