<?php

use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\shop\Order $model */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Замовлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <!-- sa-app__body -->
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
                            <h1 class="h3 m-0">Замовлення #<?= $model->id ?></h1>
                        </div>
                        <div class="col-auto d-flex">
                            <!--                        <a href="#" class="btn btn-secondary me-3">Видалити</a>-->
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
                                Статус <?= $model->getExecutionStatus($model->id) ?>
                            </div>
                            <div class="sa-page-meta__item">
                                <!--                            Статус оплати -->
                                Оплата <?= $model->getPayMent($model->id) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sa-entity-layout" data-sa-container-query='{"920":"sa-entity-layout--size--md"}'>
                    <div class="sa-entity-layout__body">
                        <div class="sa-entity-layout__main">
                            <div class="card">
                                <div class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                                    <h2 class="mb-0 fs-exact-18 me-4">Коментар замовника</h2>
                                </div>
                                <div class="table-responsive">
                                    <table class="sa-table">
                                        <tbody>
                                        <tr>
                                            <td class="text-end">
                                                <div class="sa-price">
                                                    <textarea class="sa-card-area__area" id="order-note"
                                                              data-id="<?= $model->id ?>"
                                                              data-land="<?= $_SESSION['_language'] ?>" rows="4"
                                                              placeholder="Ваш коментар"><?= $model->note ? $model->note : '' ?></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                                    <h2 class="mb-0 fs-exact-18 me-4">Коментар менеджера</h2>
                                </div>
                                <div class="table-responsive">
                                    <table class="sa-table">
                                        <tbody>
                                        <tr>
                                            <td class="text-end">
                                                <div class="sa-price">
                                                    <textarea class="sa-card-area__area" id="order-coment"
                                                              data-id="<?= $model->id ?>"
                                                              data-land="<?= $_SESSION['_language'] ?>" rows="4"
                                                              placeholder="Ваш коментар"><?= $model->comment ? $model->comment : '' ?></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php if ($model->orderItems): ?>
                                <div class="card mt-5">
                                    <div class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                                        <h2 class="mb-0 fs-exact-18 me-4">Товари</h2>
                                        <div class="text-muted fs-exact-14"><a href="#">Редагувати</a></div>
                                    </div>
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
                                                            <a href=""
                                                               class="text-reset"><?= $orderItem->product->name ?></a>
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
                                                </tr>
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
                                </div>
                                <div class="card-body pt-4 fs-exact-14">
                                    <div><?= $model->fio ?></div>
                                    <div class="text-muted mt-1"><?= $model->phone ?></div>
                                    <div class="card-body pt-4 fs-exact-14">
                                        <?= $model->city ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php \yii\widgets\Pjax::end() ?>
    <!-- sa-app__body / end -->
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
