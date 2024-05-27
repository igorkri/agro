<?php

use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var common\models\Report $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?php \yii\widgets\Pjax::begin(
//        ['id'=>"top"]
) ?>
    <div class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
        <div class="sa-app__content">
            <!-- sa-app__body -->
            <div id="top" class="sa-app__body">
                <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
                    <div class="container container--max--xl">
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
                                    <h1 class="h3 m-0">Замовлення # <?= $model->id ?></h1>
                                </div>
                                <div class="col-auto d-flex">
                                    <?php echo Html::a('Редагувати', Url::to(['update', 'id' => $model->id]), [
                                        'class' => "btn btn-primary",
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="sa-page-meta mb-5">
                            <div class="sa-page-meta__body">
                                <div class="sa-page-meta__list">
                                    <div class="sa-page-meta__item">October 7, 2020 at 9:08 pm</div>
                                    <div class="sa-page-meta__item">6 items</div>
                                    <div class="sa-page-meta__item">Total $5,882.00</div>
                                    <div class="sa-page-meta__item d-flex align-items-center fs-6">
                                        <?= $model->getExecutionStatus($model->order_status_id) ?>
                                        <?= $model->getPayMentStatus($model->order_pay_ment_id) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sa-entity-layout" data-sa-container-query='{"920":"sa-entity-layout--size--md"}'>
                            <div class="sa-entity-layout__body">


                                <div class="sa-entity-layout__main">
                                    <div class="card">
                                        <div class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                                            <h2 class="mb-0 fs-exact-18 me-4"><i class="fas fa-seedling"></i> Товари</h2>
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
                                                        <h5 class="modal-title" id="addReportItemModalLabel">Добавить
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
                                                                <label for="product" class="form-label"><i class="fas fa-seedling"></i> Товар:</label>
                                                                <input type="text" class="form-control" id="product-id"
                                                                       name="productName" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="package"
                                                                       class="form-label"><i class="fas fa-box"></i> Пакування:</label>
                                                                <select class="form-control" id="package" name="package" required>
                                                                    <option value="" disabled selected hidden>Виберіть пакування...</option>
                                                                    <option value="BIG">Фермер</option>
                                                                    <option value="SMALL">Дрібна</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="quantity"
                                                                       class="form-label"><i class="far fa-calendar-plus"></i> Кількість:</label>
                                                                <input type="text" class="form-control" id="quantity"
                                                                       name="quantity" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="price" class="form-label"><i class="fas fa-money-bill-wave"></i> Ціна:</label>
                                                                <input type="text" class="form-control" id="price"
                                                                       name="price" required>
                                                            </div>

                                                            <div class="mt-5 d-flex justify-content-end">
                                                                <button type="submit" class="btn btn-primary">Додати в заказ</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($model->reportItems): ?>
                                        <div class="table-responsive">
                                            <table class="sa-table">
                                                <tbody>
                                                <?php $i = 1;
                                                foreach ($model->reportItems as $reportItem): ?>
                                                    <tr>
                                                        <td class="min-w-20x">
                                                            <div class="d-flex align-items-center">
                                                                <img src="<?= Yii::$app->request->hostInfo . '/images/product.png' ?>"
                                                                     width="40" height="40" alt=""/>
                                                                <span class="text-reset"><?= $reportItem->product_name ?></span>
                                                            </div>
                                                        </td>
                                                        <td><?= $reportItem->package ?></td>
                                                        <td class="text-end">
                                                            <div class="sa-price">
                                                                <span class="sa-price__symbol"><?= Yii::$app->formatter->asDecimal($reportItem->price, 2) ?></span>
                                                            </div>
                                                        </td>
                                                        <td class="text-end"><?= $reportItem->quantity ?></td>
                                                        <td class="text-end">
                                                            <div class="sa-price">
                                                                <?= Yii::$app->formatter->asDecimal($reportItem->price * $reportItem->quantity, 2) ?>
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
                                                                <div class="modal-body">
                                                                    <!-- Форма для редактирования данных заказа -->
                                                                    <form method="get"
                                                                          action="<?= Url::to(['report/update-report-item']) ?>">
                                                                        <!-- Замените на реальный путь обработчика формы -->
                                                                        <input type="hidden" name="reportItemId"
                                                                               value="<?= $reportItem->id ?>">
                                                                        <div class="mb-3">
                                                                            <label for="price<?= $reportItem->id ?>"
                                                                                   class="form-label"> Ціна:</label>
                                                                            <input type="text" class="form-control"
                                                                                   id="price<?= $reportItem->id ?>"
                                                                                   name="price"
                                                                                   value="<?= $reportItem->price ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="quantity<?= $reportItem->id ?>"
                                                                                   class="form-label"> Кількість:</label>
                                                                            <input type="text" class="form-control"
                                                                                   id="quantity<?= $reportItem->id ?>"
                                                                                   name="quantity"
                                                                                   value="<?= $reportItem->quantity ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="package<?= $reportItem->id ?>" class="form-label"> Пакування:</label>
                                                                            <select class="form-control" id="package<?= $reportItem->id ?>" name="package">
                                                                                <?php
                                                                                $selectedItem = $reportItem->package == 'BIG' ? 'Фермер' : 'Дрібна';
                                                                                ?>
                                                                                <option value="<?= $reportItem->package ?>" selected><?= $selectedItem ?></option>
                                                                                <option value="BIG" <?= $reportItem->package == 'BIG' ? 'disabled' : '' ?>>Фермер</option>
                                                                                <option value="SMALL" <?= $reportItem->package == 'SMALL' ? 'disabled' : '' ?>>Дрібна</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mt-5 d-flex justify-content-end">
                                                                            <button type="submit" class="btn btn-primary">Сохранить
                                                                                изменения</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $i++; endforeach; ?>
                                                </tbody>
                                                <tbody>
                                                <tr>
                                                    <td colspan="3"><i class="fas fa-money-bill-wave"></i> Загальна сума</td>
                                                    <td class="text-end">
                                                        <div class="sa-price" style="font-weight: bold">
                                                            <?= Yii::$app->formatter->asDecimal($model->getTotalSumm($model->id), 2) ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="card mt-5">
                                        <div class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                                            <h2 class="mb-0 fs-exact-18 me-4">Transactions</h2>
                                            <div class="text-muted fs-exact-14"><a href="#">Add transaction</a></div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="sa-table text-nowrap">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        Payment
                                                        <div class="text-muted fs-exact-13">via PayPal</div>
                                                    </td>
                                                    <td>October 7, 2020</td>
                                                    <td class="text-end">
                                                        <div class="sa-price">
                                                            <span class="sa-price__symbol">$</span>
                                                            <span class="sa-price__integer">2,000</span>
                                                            <span class="sa-price__decimal">.00</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Payment
                                                        <div class="text-muted fs-exact-13">from account balance</div>
                                                    </td>
                                                    <td>November 2, 2020</td>
                                                    <td class="text-end">
                                                        <div class="sa-price">
                                                            <span class="sa-price__symbol">$</span>
                                                            <span class="sa-price__integer">50</span>
                                                            <span class="sa-price__decimal">.00</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Refund
                                                        <div class="text-muted fs-exact-13">to PayPal</div>
                                                    </td>
                                                    <td>December 10, 2020</td>
                                                    <td class="text-end text-danger">
                                                        <div class="sa-price">
                                                            <span class="sa-price__symbol">$</span>
                                                            <span class="sa-price__integer">-325</span>
                                                            <span class="sa-price__decimal">.00</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
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
                                                <div class="fs-exact-14 fw-medium"><?= $model->fio ?></div>
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
                                            <h2 class="fs-exact-16 mb-0"><i class="fas fa-user-check"></i> Контактна Особа</h2>
                                            <a href="#" class="fs-exact-14">Edit</a>
                                        </div>
                                        <div class="card-body pt-4 fs-exact-14">
                                            <div><?= $model->fio ?></div>
                                            <div class="mt-1"><a href="#">moore@example.com</a></div>
                                            <div class="text-muted mt-1"><?= $model->tel_number ?></div>
                                        </div>
                                    </div>
                                    <div class="card mt-5">
                                        <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                            <h2 class="fs-exact-16 mb-0"><i class="far fa-address-card"></i> Адреса Доставки</h2>
                                            <a href="#" class="fs-exact-14">Edit</a>
                                        </div>
                                        <div class="card-body pt-4 fs-exact-14">
                                            <?= $model->address ?>
                                        </div>
                                    </div>
                                    <div class="card mt-5">
                                        <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                            <h2 class="fs-exact-16 mb-0"><i class="fas fa-barcode"></i> Накладна ТТН</h2>
                                            <a href="#" class="fs-exact-14">Edit</a>
                                        </div>
                                        <div class="card-body pt-4 fs-exact-14">
                                            <?= $model->ttn ?>
                                        </div>
                                    </div>
                                    <div class="card mt-5">
                                        <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                            <h2 class="fs-exact-16 mb-0"><i class="fas fa-comment-dots"></i> Коментар</h2>
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
        <!-- sa-app__content / end -->
        <!-- sa-app__toasts -->
        <div class="sa-app__toasts toast-container bottom-0 end-0"></div>
        <!-- sa-app__toasts / end -->
    </div>
<?php \yii\widgets\Pjax::end() ?>
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

<?php
$js = <<<JS
$( document ).ready(function() {
    $('#report-note').change(function(){
        var note = $('#report-note').val();
        var id = $('#report-note').data('id');
        var land = $('#report-note').data('land');

    $.ajax({
        url: "/admin/"+ land +"/report/update-note",
        type: 'post',
        data: {
            'id': id,
            'note': note
        },
        success: function(data){
            $.toast({
                    loader: false,
                    hideAfter: 1000,
                    position: 'top-right',
                    // heading: 'OK',
                    text: data.res,
                    bgColor: data.color,
                    textColor: 'white',
                    icon: 'success'
                });
        },
        error: function(data){
            $.toast({
                    loader: false,
                    hideAfter: 1000,
                    position: 'top-right',
                    // heading: 'OK',
                    text: data.res,
                    bgColor: data.color,
                    textColor: 'white',
                    icon: 'success'
                });
        }
    });
    return false;
    }).on('submit', function(e){
    e.preventDefault();
    });
});

JS;
$this->registerJs($js);