<?php

use common\models\Report;
use yii\bootstrap5\Breadcrumbs;

$this->title = Yii::t('app', 'Асистент');
$this->params['breadcrumbs'][] = $this->title;

?>

<div id="top" class="sa-app__body">
    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
        <div class="container">
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

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="p-4">
                    <input
                        type="text"
                        placeholder="<?=Yii::t('app', 'Start typing to search for statuses')?>"
                        class="form-control form-control--search mx-auto"
                        id="table-search"
                    />
                </div>
                <div class="sa-divider"></div>
                <table class="sa-datatables-init" data-order='[[ 1, "asc" ]]' data-sa-search-input="#table-search">
                    <thead>
                    <tr>
                        <th class="min-w-15x"><?=Yii::t('app', 'Problem')?></th>
                        <th class="min-w-15x"><?=Yii::t('app', 'Orders')?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $statusDelivery = Report::StatusDeliveryNotSelected()  ?>
                    <?php if ($statusDelivery): ?>
                        <tr>
                            <td>Статус Доставки не вказано</td>
                            <td>
                                <?= $statusDelivery ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php $statusPayment = Report::StatusPaymentNotSelected() ?>
                    <?php if ($statusPayment): ?>
                        <tr>
                            <td>Статус Оплати не вказано</td>
                            <td>
                                <?= $statusPayment ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php $statusPayment = Report::IncomingPriceNotSelected() ?>
                    <?php if ($statusPayment): ?>
                        <tr>
                            <td>Ціна входу не вказана</td>
                            <td>
                                <?= $statusPayment ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php $ttn = Report::TtnNot() ?>
                    <?php if ($ttn): ?>
                        <tr>
                            <td>Статус Доставляєть нема ТТН</td>
                            <td>
                                <?= $ttn ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php $number = Report::NunberNot() ?>
                    <?php if ($number): ?>
                        <tr>
                            <td>Відсутній № замовлення</td>
                            <td>
                                <?= $number ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php $dataPayment = Report::DatePaymentNot() ?>
                    <?php if ($dataPayment): ?>
                        <tr>
                            <td>Статус Оплачено нема дати</td>
                            <td>
                                <?= $dataPayment ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php $typePayment = Report::TypePaymentNot() ?>
                    <?php if ($typePayment): ?>
                        <tr>
                            <td>Статус Оплачено нема Способу Оплати</td>
                            <td>
                                <?= $typePayment ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
