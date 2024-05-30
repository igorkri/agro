<?php

use common\models\Report;
use yii\bootstrap5\Breadcrumbs;

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
                        <tr>
                            <td>Статус Доставки не вказано</td>
                            <td>
                                <?= Report::StatusDeliveryNotSelected()?>
                            </td>
                        </tr>
                        <tr>
                            <td>Статус Оплати не вказано</td>
                            <td>
                                <?= Report::StatusPaymentNotSelected()?>
                            </td>
                        </tr>
                        <tr>
                            <td>Статус Доставляєть нема ТТН</td>
                            <td>
                                <?= Report::TtnNot()?>
                            </td>
                        </tr>
                        <tr>
                            <td>Відсутній № замовлення</td>
                            <td>
                                <?= Report::NunberNot()?>
                            </td>
                        </tr>
                        <tr>
                            <td>Статус Оплачено нема дати</td>
                            <td>
                                <?= Report::DatePaymentNot()?>
                            </td>
                        </tr>
                        <tr>
                            <td>Статус Оплачено нема Способу Оплати</td>
                            <td>
                                <?= Report::TypePaymentNot()?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
