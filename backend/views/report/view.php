<?php

use Detection\MobileDetect;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\Report $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);

$sumItemOrder = $model->getTotalSumView($model->id);
$itemDiscount = $model->getItemsDiscount($model->id);
$incomingPriceSum = $model->getItemsIncomingPrice($model->id);
$itemPlatformPrice = $model->getItemsPlatformPrice($model->id);

$deliveryPrice = $model->price_delivery ?? 0;
if ($model->order_status_id == 'Повернення' or $model->order_pay_ment_id == 'Повернення') {
    $totalOrderPrice = '-' . ($itemPlatformPrice + $deliveryPrice);
} else {
    $totalOrderPrice = $sumItemOrder
        - $incomingPriceSum
        - $itemDiscount
        - $itemPlatformPrice
        - $deliveryPrice;
}

?>
<?php Pjax::begin() ?>
    <div class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
        <div class="sa-app__content">
            <div id="top" class="sa-app__body">
                <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
                    <div class="container container--max--xl" style="max-width: 1623px">
                        <div class="py-4">
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
                        <div class="sa-page-meta mb-5">
                            <div class="sa-page-meta__body">
                                <div class="sa-page-meta__list">
                                    <div class="sa-page-meta__item"><h5 class="m-0">Замовлення
                                            # <?= $model->number_order ?></h5></div>
                                    <div class="sa-page-meta__item" style="font-weight: bold; font-size: 18px">
                                        <span class="text-muted"
                                              style="font-size: 14px">Позицій: </span><?= $model->getCountItemsOrder($model->id) ?>
                                    </div>
                                    <div class="sa-page-meta__item" style="font-weight: bold; font-size: 18px">
                                        <span class="text-muted"
                                              style="font-size: 14px">Дата відп.: </span>
                                        <?= !empty($model->date_delivery) ? '<span class="text-success">' . $model->date_delivery . '</span>' : '<span class="text-danger">Відсутня</span>' ?>
                                    </div>
                                    <div class="sa-page-meta__item" style="font-weight: bold; font-size: 18px">
                                        <span class="text-muted"
                                              style="font-size: 14px">Сума: </span><?php if ($model->order_status_id === 'Повернення') { ?>
                                            <td style="font-weight: bold; color: red">
                                                -<?= Yii::$app->formatter->asDecimal($sumItemOrder, 2) ?></td>
                                        <?php } else { ?>
                                            <td style="font-weight: bold"><?= Yii::$app->formatter->asDecimal($sumItemOrder, 2) ?></td>
                                        <?php } ?></div>
                                    <div class="sa-page-meta__item d-flex align-items-center fs-6">
                                        <?= $model->getExecutionStatus($model->order_status_id) ?>
                                    </div>
                                    <div class="sa-page-meta__item d-flex align-items-center fs-6">
                                        <?= $model->getPayMentStatus($model->order_pay_ment_id) ?>
                                    </div>
                                    <div class="sa-page-meta__item d-flex align-items-center fs-6"
                                         style="width: 20px; height: 20px">
                                        <?= $model->getDeliveryLogo($model->delivery_service) ?>
                                    </div>
                                    <div class="sa-page-meta__item d-flex align-items-center fs-6">
                                        <div class="col-auto d-flex">
                                            <?php echo Html::a('Редагувати', Url::to(['update', 'id' => $model->id]), [
                                                'class' => "btn btn-primary btn-sm",
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="sa-page-meta__item"></div>
                                </div>
                            </div>
                        </div>
                        <div class="sa-entity-layout" data-sa-container-query='{"920":"sa-entity-layout--size--md"}'>
                            <div class="sa-entity-layout__body">
                                <div class="sa-entity-layout__main">
                                    <div class="card">
                                        <div class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                                            <h2 class="mb-0 fs-exact-18 me-4"><i class="fas fa-seedling"></i> Товари
                                            </h2>
                                            <div class="text-muted fs-exact-14"><a href="#" data-bs-toggle="modal"
                                                                                   data-bs-target="#addReportItemModal"><i
                                                            class="fas fa-plus"></i></a></div>
                                        </div>
                                        <!-- Модальное окно для добавления товара -->
                                        <div class="modal fade" id="addReportItemModal" tabindex="-1"
                                             aria-labelledby="addReportItemModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addReportItemModalLabel">Додати
                                                            товар в
                                                            заказ</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Форма для добавления товара в заказ -->
                                                        <form id="addReportItemForm" method="get"
                                                              action="<?= Url::to(['report/add-report-item']) ?>">
                                                            <input type="hidden" name="reportId"
                                                                   value="<?= $model->id ?>">
                                                            <div class="mb-3">
                                                                <label for="product" class="form-label"><i
                                                                            class="fas fa-seedling"></i> Товар:</label>
                                                                <input aria-label="productName"
                                                                       type="text" class="form-control" id="product-id"
                                                                       name="productName" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="package"
                                                                       class="form-label"><i class="fas fa-box"></i>
                                                                    Пакування:</label>
                                                                <select class="form-control" id="package" name="package"
                                                                        required>
                                                                    <option value="" disabled selected hidden>Виберіть
                                                                        пакування...
                                                                    </option>
                                                                    <option value="BIG">Фермер</option>
                                                                    <option value="SMALL">Дрібна</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="quantity"
                                                                       class="form-label"><i
                                                                            class="far fa-calendar-plus"></i> Кількість:</label>
                                                                <input type="text" class="form-control" id="quantity"
                                                                       name="quantity" required>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-3"><label for="price"
                                                                                          class="form-label"><i
                                                                                class="fas fa-money-bill-wave"></i>
                                                                        Ціна:</label>
                                                                    <input type="text" class="form-control" id="price"
                                                                           name="price" required>
                                                                </div>
                                                                <div class="col-3"><label for="discount_price"
                                                                                          class="form-label">
                                                                        Знижка:</label>
                                                                    <input type="text" class="form-control"
                                                                           id="discount_price"
                                                                           name="discount_price">
                                                                </div>
                                                                <div class="col-3"><label for="in_price"
                                                                                          class="form-label"><i
                                                                                class="fas fa-hand-holding-usd"></i>
                                                                        Вхід:</label>
                                                                    <input type="text" class="form-control"
                                                                           id="in_price"
                                                                           name="in_price">
                                                                </div>
                                                                <div class="col-3"><label for="platform_price"
                                                                                          class="form-label">
                                                                        Платформа:</label>
                                                                    <input type="text" class="form-control"
                                                                           id="platform_price"
                                                                           name="platform_price">
                                                                </div>
                                                            </div>
                                                            <div class="mt-5 d-flex justify-content-end">
                                                                <button type="submit" class="btn btn-primary">Додати в
                                                                    заказ
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($model->reportItems): ?>
                                            <div class="table-responsive">
                                                <table class="sa-table">
                                                    <thead style="background-color: #4ce7354f">
                                                    <tr>
                                                        <th class="text-left">№</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th class="text-center">К-ть</th>
                                                        <th class="text-center">Ціна</th>
                                                        <th class="text-center">Сума</th>
                                                        <th class="text-center">Вхід</th>
                                                        <th class="text-center">Знижка</th>
                                                        <th class="text-center">Площадка</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $i = 1;
                                                    foreach ($model->reportItems as $reportItem): ?>
                                                        <tr>
                                                            <td class="text-left"><?= $i ?></td>
                                                            <td class="min-w-20x">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="<?= Yii::$app->request->hostInfo . '/images/product.png' ?>"
                                                                         width="40" height="40" alt=""/>
                                                                    <span class="text-reset"><?= $reportItem->product_name ?></span>
                                                                </div>
                                                            </td>
                                                            <td class="text-center"><?= $model->getPackageForView($reportItem->package) ?></td>
                                                            <td class="text-center"><?= $reportItem->quantity ?></td>
                                                            <td class="text-center">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol"><?= Yii::$app->formatter->asDecimal($reportItem->price, 2) ?></span>
                                                                </div>
                                                            </td>
                                                            <td class="text-center" style="background-color: #e4e7e4">
                                                                <div class="sa-price">
                                                                    <?= Yii::$app->formatter->asDecimal($reportItem->price * $reportItem->quantity, 2) ?>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol"><?= Yii::$app->formatter->asDecimal($reportItem->entry_price, 2) ?></span>
                                                                </div>
                                                            </td>
                                                            <td class="text-center text-danger">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol">-</span>
                                                                    <span class="sa-price__symbol">
                                                                        <?php if ($reportItem->discount) {
                                                                            $itemDiscountPrice = $reportItem->discount;
                                                                        } else {
                                                                            $itemDiscountPrice = 0;
                                                                        } ?>
                                                                        <?= Yii::$app->formatter->asDecimal($itemDiscountPrice, 2) ?>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td class="text-center text-danger">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol">-</span>
                                                                    <span class="sa-price__symbol">
                                                                        <?php if ($reportItem->platform_price) {
                                                                            $platformPrice = $reportItem->platform_price;
                                                                        } else {
                                                                            $platformPrice = 0;
                                                                        } ?>
                                                                        <?= Yii::$app->formatter->asDecimal($platformPrice, 2) ?>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="text-muted fs-exact-14">
                                                                    <a href="#" data-bs-toggle="modal"
                                                                       data-bs-target="#editReportItemModal<?= $reportItem->id ?>">
                                                                        <i class="fas fa-pen"></i>
                                                                    </a>
                                                                </div>
                                                                <!-- Удаление товара из заказа -->
                                                                <div class="text-muted fs-exact-14">
                                                                    <a href="<?= Url::to(['report/delete-report-item', 'id' => $reportItem->id]) ?>"
                                                                       class="text-danger"
                                                                       onclick="return confirm('Вы уверены, что хотите удалить этот товар из заказа?')">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- Модальное окно для редактирования данных заказа -->
                                                        <div class="modal fade"
                                                             id="editReportItemModal<?= $reportItem->id ?>"
                                                             tabindex="-1"
                                                             aria-labelledby="editReportItemModalLabel<?= $reportItem->id ?>"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editReportItemModalLabel<?= $reportItem->id ?>">
                                                                            Редагувати товар</h5>
                                                                        <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <!-- Форма для редактирования данных заказа -->
                                                                    <div class="modal-body">
                                                                        <form method="get"
                                                                              action="<?= Url::to(['report/update-report-item']) ?>">
                                                                            <input type="hidden" name="reportItemId"
                                                                                   value="<?= $reportItem->id ?>">
                                                                            <div class="mb-3">
                                                                                <label for="quantity<?= $reportItem->id ?>"
                                                                                       class="form-label">
                                                                                    Кількість:</label>
                                                                                <input type="text" class="form-control"
                                                                                       id="quantity<?= $reportItem->id ?>"
                                                                                       name="quantity"
                                                                                       value="<?= $reportItem->quantity ?>">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="package<?= $reportItem->id ?>"
                                                                                       class="form-label">
                                                                                    Пакування:</label>
                                                                                <select class="form-control"
                                                                                        id="package<?= $reportItem->id ?>"
                                                                                        name="package">
                                                                                    <?php
                                                                                    $selectedItem = $reportItem->package == 'BIG' ? 'Фермер' : 'Дрібна';
                                                                                    ?>
                                                                                    <option value="<?= $reportItem->package ?>"
                                                                                            selected><?= $selectedItem ?></option>
                                                                                    <option value="BIG" <?= $reportItem->package == 'BIG' ? 'disabled' : '' ?>>
                                                                                        Фермер
                                                                                    </option>
                                                                                    <option value="SMALL" <?= $reportItem->package == 'SMALL' ? 'disabled' : '' ?>>
                                                                                        Дрібна
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div class="col-3">
                                                                                    <label for="price<?= $reportItem->id ?>"
                                                                                           class="form-label">
                                                                                        Ціна:</label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="price<?= $reportItem->id ?>"
                                                                                           name="price"
                                                                                           value="<?= $reportItem->price ?>">
                                                                                </div>
                                                                                <div class="col-3"><label
                                                                                            for="discount_price<?= $reportItem->id ?>"
                                                                                            class="form-label">
                                                                                        Знижка:</label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="discount_price<?= $reportItem->id ?>"
                                                                                           name="discount_price"
                                                                                           value="<?= $reportItem->discount ?>">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <label for="in_price<?= $reportItem->id ?>"
                                                                                           class="form-label">
                                                                                        Вхід:</label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="in_price<?= $reportItem->id ?>"
                                                                                           name="in_price"
                                                                                           value="<?= $reportItem->entry_price ?>">
                                                                                </div>
                                                                                <div class="col-3"><label
                                                                                            for="platform_price<?= $reportItem->id ?>"
                                                                                            class="form-label">
                                                                                        Платформа:</label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="platform_price<?= $reportItem->id ?>"
                                                                                           name="platform_price"
                                                                                           value="<?= $reportItem->platform_price ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="mt-5 d-flex justify-content-end">
                                                                                <button type="submit"
                                                                                        class="btn btn-primary">
                                                                                    Сохранить
                                                                                    изменения
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $i++; endforeach; ?>
                                                    </tbody>
                                                    <tbody class="sa-table__group">
                                                    <tr>
                                                        <td colspan="3">Сума
                                                            <div class="text-muted fs-exact-13">сума всіх товарів</div>
                                                        </td>
                                                        <td class="text-end text-nowrap">
                                                            <div class="sa-price"
                                                                 style="font-weight: bold; font-size: 20px">
                                                                <?= Yii::$app->formatter->asDecimal($sumItemOrder, 2) ?>
                                                                <span class="sa-price__symbol"> ₴</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php if ($incomingPriceSum != 0): ?>
                                                        <tr>
                                                            <td colspan="3">Сума Входу
                                                                <div class="text-muted fs-exact-13">сума всіх вхідних
                                                                    цін
                                                                </div>
                                                            </td>
                                                            <td class="text-end text-nowrap">
                                                                <div class="sa-price">
                                                                    <?= Yii::$app->formatter->asDecimal($incomingPriceSum, 2) ?>
                                                                    <span class="sa-price__symbol"> ₴</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php if ($itemDiscount != 0): ?>
                                                        <tr>
                                                            <td colspan="3">Знижка
                                                                <div class="text-muted fs-exact-13">знажка всіх товарів
                                                                </div>
                                                            </td>
                                                            <td class="text-end text-nowrap text-danger">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol">-</span>
                                                                    <?= Yii::$app->formatter->asDecimal($itemDiscount, 2) ?>
                                                                    <span class="sa-price__symbol"> ₴</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php if ($itemPlatformPrice != 0): ?>
                                                        <tr>
                                                            <td colspan="3">Площадка
                                                                <div class="text-muted fs-exact-13">зписання коштів з
                                                                    площадок
                                                                </div>
                                                            </td>
                                                            <td class="text-end text-nowrap text-danger">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol">-</span>
                                                                    <?= Yii::$app->formatter->asDecimal($itemPlatformPrice, 2) ?>
                                                                    <span class="sa-price__symbol"> ₴</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php if ($deliveryPrice != 0): ?>
                                                        <tr>
                                                            <td colspan="3">
                                                                Доставка
                                                                <div class="text-muted fs-exact-13">витрати на доставку
                                                                </div>
                                                            </td>
                                                            <td class="text-end text-nowrap text-danger">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol">-</span>
                                                                    <?= Yii::$app->formatter->asDecimal($deliveryPrice, 2) ?>
                                                                    <span class="sa-price__symbol"> ₴</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    </tbody>
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="3"><i class="fas fa-money-bill-wave"></i> Прибуток
                                                            <div class="text-muted fs-exact-13">загальна сума з
                                                                урахуванням витрат
                                                        </td>
                                                        <td class="text-end text-nowrap <?= $totalOrderPrice < 0 ? 'text-danger' : 'text-success' ?>">
                                                            <div class="sa-price" style="font-weight: bold">
                                                                <?= Yii::$app->formatter->asDecimal($totalOrderPrice, 2) ?>
                                                                <span class="sa-price__symbol"> ₴</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="sa-entity-layout__sidebar">
                                    <div class="card">
                                        <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                            <h2 class="fs-exact-16 mb-0"><i class="fas fa-users"></i> Замовник</h2>
                                            <a href="#" class="fs-exact-14">Edit</a>
                                        </div>
                                        <div class="card-body d-flex align-items-center pt-4">
                                            <div class="sa-symbol sa-symbol--shape--circle sa-symbol--size--lg">
                                                <img src="<?= Yii::$app->request->hostInfo . '/images/customer.png' ?>"
                                                     width="60" height="60" alt=""/>
                                            </div>
                                            <div class="ms-3 ps-2">
                                                <div class="fs-exact-14 fw-medium"><a
                                                            href="<?= Url::to(['update', 'id' => $model->id]) ?>"
                                                            class="text-reset"><?= $model->fio ?></a></div>
                                                <?php $countOrders = $model->getCountOrders($model->tel_number) ?>
                                                <?php if ($countOrders < 2) { ?>
                                                    <div class="fs-exact-13 text-muted">Це перше замовлення</div>
                                                <?php } else { ?>
                                                    <div class="fs-exact-13 text-muted">
                                                        Замовлень <?= $countOrders ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-5">
                                        <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                            <h2 class="fs-exact-16 mb-0"><i class="fas fa-user-check"></i> Контактна
                                                Особа</h2>
                                            <?php
                                            $det = new MobileDetect();
                                            $device_mob = $det->isMobile();
                                            if ($device_mob) {
                                                $znak = '%2B';
                                            } else {
                                                $znak = '+';
                                            }
                                            $telNumber = $model->tel_number ?? '';
                                            $call = str_replace(array('(', ')', ' ', '+'), '', $telNumber);
                                            $viberSms = 'viber://chat?number=' . $znak . $call;
                                            $button3 = Html::a("<i class=\"fab fa-viber\"></i>", $viberSms, [
                                                'title' => 'Написать в Viber',
                                                'class' => 'pull-left detail-button',
                                                'style' => 'margin-right: 20px; font-size:22px; color:#7159e2;'
                                            ]);
                                            ?>
                                            <div class="sa-page-meta__item" style="text-align: end;">
                                                <?= $button3 ?>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 fs-exact-14">
                                            <div><a href="<?= Url::to(['update', 'id' => $model->id]) ?>"
                                                    class="text-reset"><?= $model->fio ?></a></div>
                                            <div class="mt-1"><a href="#">moore@example.com</a></div>
                                            <div class="text-muted mt-1"><?= $model->tel_number ?></div>
                                        </div>
                                    </div>
                                    <div class="card mt-5">
                                        <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                            <h2 class="fs-exact-16 mb-0"><i class="far fa-address-card"></i> Адреса
                                                Доставки</h2>
                                            <a href="#" class="fs-exact-14">Edit</a>
                                        </div>
                                        <div class="card-body pt-4 fs-exact-14">
                                            <?= $model->address ?>
                                        </div>
                                    </div>
                                    <div class="card mt-5">
                                        <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                            <h2 class="fs-exact-16 mb-0"><i class="fas fa-barcode"></i> Накладна ТТН
                                            </h2>
                                            <a href="#" class="fs-exact-14">Edit</a>
                                        </div>
                                        <div class="card-body pt-4 fs-exact-14">
                                            <?= $model->ttn ?>
                                        </div>
                                    </div>
                                    <div class="card mt-5">
                                        <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                            <h2 class="fs-exact-16 mb-0"><i class="fas fa-comment-dots"></i> Коментар
                                            </h2>
                                            <a href="#" class="fs-exact-14">Edit</a>
                                        </div>
                                        <div class="card-body pt-4 fs-exact-14">
                                            <?= $model->comments ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- sa-app__toasts -->
        <div class="sa-app__toasts toast-container bottom-0 end-0"></div>
        <!-- sa-app__toasts / end -->
    </div>
<?php Pjax::end() ?>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "size" => Modal::SIZE_EXTRA_LARGE,
//    'scrollable' => true,
    'options' => [
        "data-bs-backdrop" => "static",
        // "class" => 'modal-dialog-scrollable',
    ],
    "footer" => "", // always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>