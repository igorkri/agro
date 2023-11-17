<?php

use common\models\shop\Product;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\shop\Order $model */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Замовлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php \yii\widgets\Pjax::begin(
//        ['id'=>"top"]
) ?>
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
                                'role' => 'modal-remote',
                                'data-toggle' => 'tooltip'
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="sa-page-meta mb-5">
                    <div class="sa-page-meta__body">
                        <div class="sa-page-meta__list">
                            <div class="sa-page-meta__item"><?= Yii::$app->formatter->asDatetime($model->created_at) ?></div>
                            <div class="sa-page-meta__item"> <?= $model->getTotalQty($model->id) ?> шт.</div>
                            <div class="sa-page-meta__item">
                                Сума <?= Yii::$app->formatter->asDecimal($model->getTotalSumm($model->id), 2) ?></div>
                            <div class="sa-page-meta__item">
                                <!--                        Статус виконання -->
                                Статус: <?= $model->getExecutionStatus($model->id) ?>
                            </div>
                            <div class="sa-page-meta__item">
                                <!--                            Статус оплати -->
                                Оплата: <?= $model->getPayMent($model->id) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sa-entity-layout" data-sa-container-query='{"920":"sa-entity-layout--size--md"}'>
                    <div class="sa-entity-layout__body">
                        <div class="sa-entity-layout__main">

                            <div class="card">
                                <div class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                                    <h2 class="mb-0 fs-exact-18 me-4">Товари</h2>
                                    <div class="text-muted fs-exact-14"><a href="#" data-bs-toggle="modal"
                                                                           data-bs-target="#addOrderItemModal"><i
                                                    class="fas fa-plus"></i></a></div>
                                </div>

                                <!-- Модальное окно для добавления товара -->
                                <div class="modal fade" id="addOrderItemModal" tabindex="-1"
                                     aria-labelledby="addOrderItemModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addOrderItemModalLabel">Добавить товар в
                                                    заказ</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Форма для добавления товара в заказ -->
                                                <form id="addOrderItemForm" method="get"
                                                      action="<?= Url::to(['order/add-order-item']) ?>">
                                                    <input type="hidden" name="orderId" value="<?= $model->id ?>">

                                                    <div class="mb-3">
                                                        <label for="product-id" class="form-label">Товар</label>
                                                        <!-- Добавьте список товаров, которые можно добавить в заказ -->
                                                        <select class="form-select" id="product-id" name="productId"
                                                                required>
                                                            <?php
                                                            $products = Product::find()->all();
                                                            foreach ($products as $product) {
                                                                echo '<option value="' . $product->id . '">' . $product->name . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="quantity" class="form-label">Количество</label>
                                                        <input type="text" class="form-control" id="quantity"
                                                               name="quantity" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Добавить в заказ
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($model->orderItems): ?>
                                <div class="table-responsive">
                                    <table class="sa-table">
                                        <tbody>
                                        <?php $i = 1;
                                        foreach ($model->orderItems as $orderItem): ?>
                                            <tr>
                                                <td class="min-w-20x">
                                                    <div class="d-flex align-items-center">
                                                        <img src="/product/<?= $orderItem->product->images[0]->name ?>"
                                                             class="me-4" width="40" height="40" alt=""/>
                                                        <span class="text-reset"><?= $orderItem->product->name ?></span>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="sa-price">
                                                        <span class="sa-price__symbol"><?= Yii::$app->formatter->asDecimal($orderItem->price, 2) ?></span>
                                                    </div>
                                                </td>
                                                <td class="text-end"><?= $orderItem->quantity ?></td>
                                                <td class="text-end">
                                                    <div class="sa-price">
                                                        <?= Yii::$app->formatter->asDecimal($orderItem->price * $orderItem->quantity, 2) ?>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="text-muted fs-exact-14">
                                                        <a href="#" data-bs-toggle="modal"
                                                           data-bs-target="#editOrderItemModal<?= $orderItem->id ?>">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    </div>
                                                    <!-- Удаление товара из заказа -->
                                                    <div class="text-muted fs-exact-14">
                                                        <a href="<?= Url::to(['order/delete-order-item', 'id' => $orderItem->id]) ?>"
                                                           class="text-danger"
                                                           onclick="return confirm('Вы уверены, что хотите удалить этот товар из заказа?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Модальное окно для редактирования данных заказа -->
                                            <div class="modal fade" id="editOrderItemModal<?= $orderItem->id ?>"
                                                 tabindex="-1"
                                                 aria-labelledby="editOrderItemModalLabel<?= $orderItem->id ?>"
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editOrderItemModalLabel<?= $orderItem->id ?>">
                                                                Редактировать товар</h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Форма для редактирования данных заказа -->
                                                            <form method="get"
                                                                  action="<?= Url::to(['order/update-order-item']) ?>">
                                                                <!-- Замените на реальный путь обработчика формы -->
                                                                <input type="hidden" name="orderItemId"
                                                                       value="<?= $orderItem->id ?>">
                                                                <div class="mb-3">
                                                                    <label for="price<?= $orderItem->id ?>"
                                                                           class="form-label">Цена:</label>
                                                                    <input type="text" class="form-control"
                                                                           id="price<?= $orderItem->id ?>" name="price"
                                                                           value="<?= $orderItem->price ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="quantity<?= $orderItem->id ?>"
                                                                           class="form-label">Количество:</label>
                                                                    <input type="text" class="form-control"
                                                                           id="quantity<?= $orderItem->id ?>"
                                                                           name="quantity"
                                                                           value="<?= $orderItem->quantity ?>">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Сохранить
                                                                    изменения
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $i++; endforeach; ?>
                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td colspan="3">Загальна сума</td>
                                            <td class="text-end">
                                                <div class="sa-price">
                                                    <?= Yii::$app->formatter->asDecimal($model->getTotalSumm($model->id), 2) ?>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="sa-entity-layout__sidebar">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                    <h2 class="fs-exact-16 mb-0">Замовник</h2>
                                    <a href="#" class="fs-exact-14"></a>
                                </div>
                                <div class="card-body pt-4 fs-exact-14">
                                    <div></div>
                                    <div class="text-muted mt-1">п.і.б.</div>
                                    <div class="mt-1"><?= $model->fio ?></div>
                                    <div class="text-muted mt-1">телефон</div>
                                    <div class="mt-1"><?= $model->phone ?></div>
                                    <div class="text-muted mt-1">область</div>
                                    <div class="mt-1"><?= $model->getNameArea($model->area) ?></div>
                                    <div class="text-muted mt-1">місто</div>
                                    <div class="mt-1"><?= $model->getNameCity($model->city) ?></div>
                                    <div class="text-muted mt-1">відділення</div>
                                    <div class="mt-1"><?= $model->getNameWarehouse($model->warehouses) ?></div>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                    <h2 class="fs-exact-16 mb-0"><span class="sa-nav__icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                   fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd"
        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
                                            </span> Коментар замовника
                                    </h2>
                                    <a href="#" class="fs-exact-14"></a>
                                </div>
                                <div class="card-body pt-4 fs-exact-14">
                                    <div><?= $model->note ? $model->note : '' ?></div>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                    <h2 class="fs-exact-16 mb-0"><span class="sa-nav__icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                   fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd"
        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
                                            </span>Коментар менеджера
                                    </h2>
                                    <a href="#" class="fs-exact-14"></a>
                                </div>
                                <div class="card-body pt-4 fs-exact-14">
                                    <div><?= $model->comment ? $model->comment : '' ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    $('#order-note').change(function(){
        var note = $('#order-note').val();
        var id = $('#order-note').data('id');
        var land = $('#order-note').data('land');

    $.ajax({
        url: "/admin/"+ land +"/order/update-note",
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
