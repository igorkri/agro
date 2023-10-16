<?php

use common\models\shop\ActivePages;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

ActivePages::setActiveUser();

$this->title = 'Оформлення замовлення';
?>
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">Головна</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= Url::to(['category/list']) ?>">Редагування кошика</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $this->title ?></li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1><?= $this->title ?></h1>
            </div>
        </div>
    </div>
    <?php $form = ActiveForm::begin(['options' => ['autocomplete' => "off"]]); ?>
    <div class="checkout block">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="card mb-lg-0">
                        <div class="card-body">
                            <h3 class="card-title">Інформація для доставки</h3>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <?= $form->field($order, 'fio')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <?= $form->field($order, 'phone')->widget(MaskedInput::class, [
                                        'mask' => '(999)999 9999',
                                    ]) ?>
                                </div>
                            </div>
                            <div class="payment-methods">
                                <ul class="payment-methods__list">
                                    <li class="payment-methods__item">
                                        <label class="payment-methods__item-header">
                                        <span class="payment-methods__item-radio input-radio">
                                            <span class="input-radio__body">
                                                <input class="input-radio__input" name="checkout_payment_method"
                                                       value="beznal" type="radio">
                                                <span class="input-radio__circle"></span>
                                            </span>
                                        </span>
                                            <span class="payment-methods__item-name"><i style="font-size: 25px"
                                                                                        class="fas fa-credit-card"></i> <span
                                                        style="font-size:20px; margin:0px 20px">Самовивіз</span></span>
                                        </label>
                                        <div class="payment-methods__item-container" style="">
                                            <div class="payment-methods__item-description text-muted">
                                                ===============================================<br>
                                                ===============================================<br>
                                                ===============================================<br>
                                                ===============================================<br>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="payment-methods__item payment-methods__item--active">
                                        <label class="payment-methods__item-header">
                                        <span class="payment-methods__item-radio input-radio">
                                            <span class="input-radio__body">
                                                <input class="input-radio__input" name="checkout_payment_method"
                                                       value="" type="radio" checked="">
                                                <span class="input-radio__circle"></span>
                                            </span>
                                        </span>
                                            <span class="delivery-methods__item-name"><i style="font-size: 25px"
                                                                                         class="fas fa-truck"></i>
                                            <span style="font-size:20px; margin:0px 20px">Нова Пошта</span></span>
                                        </label>
                                        <div class="payment-methods__item-container" style="">
                                            <div class="payment-methods__item-description text-muted">
                                                <div class="form-group">
                                                    <?php echo $form->field($order, 'area')->widget(Select2::classname(), [
                                                        'data' => $areas,
                                                        'theme' => Select2::THEME_DEFAULT,
                                                        'maintainOrder' => true,
                                                        'pluginLoading' => false,
                                                        'options' => [
                                                            'id' => 'order-areas',
                                                            'placeholder' => 'Виберіть область...',
                                                            'class' => 'sa-select2 form-select',
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                            'width' => '100%',
                                                            'max-width' => '550px',
                                                            'margin' => '0 auto',
                                                        ],
                                                    ])->label('Область');
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo $form->field($order, 'city')->widget(Select2::classname(), [
                                                        'data' => [],
                                                        'theme' => Select2::THEME_DEFAULT,
                                                        'maintainOrder' => true,
                                                        'pluginLoading' => false,
                                                        'options' => [
                                                            'id' => 'order-city',
                                                            'placeholder' => 'Виберіть місто...',
                                                            'class' => 'sa-select2 form-select',
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                            'width' => '100%',
                                                            'max-width' => '550px',
                                                            'margin' => '0 auto',
                                                        ],
                                                    ])->label('Місто');
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo $form->field($order, 'warehouses')->widget(Select2::classname(), [
                                                        'data' => [],
                                                        'theme' => Select2::THEME_DEFAULT,
                                                        'maintainOrder' => true,
                                                        'pluginLoading' => false,
                                                        'options' => [
                                                            'id' => 'order-warehouses',
                                                            'placeholder' => 'Виберіть відділення...',
                                                            'class' => 'sa-select2 form-select',
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                            'width' => '100%',
                                                            'max-width' => '550px',
                                                            'margin' => '0 auto',
                                                        ],
                                                    ])->label('Відділення');
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <?= $form->field($order, 'note')->textarea(['maxlength' => true, 'rows' => 4, 'class' => 'form-control']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-5 mt-4 mt-lg-0">
                    <div class="card mb-0">
                        <div class="card-body">
                            <h3 class="card-title">Ваше замовлення</h3>
                            <table class="checkout__totals">
                                <thead class="checkout__totals-header">
                                <tr>
                                    <th>Товар</th>
                                    <th>Всього</th>
                                </tr>
                                </thead>
                                <tbody class="checkout__totals-products">
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td><?= $order->name ?> × <?= $order->quantity ?></td>
                                        <td><?= Yii::$app->formatter->asCurrency($order->getPrice() * $order->quantity) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                                <tfoot class="checkout__totals-footer">
                                <tr>
                                    <th>Загальна сума</th>
                                    <td><?= Yii::$app->formatter->asCurrency($total_summ) ?></td>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="checkout__agree form-group">
                                <div class="form-check">
                                    <span class="form-check-input input-check">
                                        <span class="input-check__body">
                                            <input class="input-check__input" type="checkbox"
                                                   id="checkout-terms" checked>
                                            <span class="input-check__box"></span>
                                            <svg class="input-check__icon" width="9px" height="7px">
                                                <use xlink:href="/images/sprite.svg#check-9x7"></use>
                                            </svg>
                                        </span>
                                    </span>
                                    <label class="form-check-label" for="checkout-terms">Я прочитав і погоджуюся з
                                        веб-сайтом <a target="_blank" href="terms-and-conditions.html">правила та
                                            умови</a><span style="color: red">*</span>
                                    </label>
                                </div>
                            </div>
                            <?php if ($total_summ != 0) { ?>
                                <button type="submit" class="btn btn-primary btn-dec-xl btn-block">Зробити замовлення
                                </button>
                            <?php } else { ?>
                                <a class="btn btn-primary btn-dec-xl btn-block"
                                   href="<?= Url::to(['/']) ?>">Дивитись товари</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#order-areas').on('change', function () {
            var areaId = $(this).val();
            $.ajax({
                url: '/n-p/cities',
                type: 'POST',
                data: {areaId: areaId},
                success: function (data) {
                    if (data.cities) {
                        var citySelect = $('#order-city');
                        citySelect.empty();
                        $.each(data.cities, function (key, value) {
                            citySelect.append(new Option(value, key, false, false));
                        });
                        citySelect.trigger('change');
                    }
                }
            });
        });
        $('#order-city').on('change', function () {
            var cityId = $(this).val();
            $.ajax({
                url: '/n-p/warehouses',
                type: 'POST',
                data: {cityId: cityId},
                success: function (data) {
                    if (data.warehouses) {
                        var warehousesSelect = $('#order-warehouses');
                        warehousesSelect.empty();
                        $.each(data.warehouses, function (key, value) {
                            warehousesSelect.append(new Option(value, key, false, false));
                        });
                        warehousesSelect.trigger('change');
                    }
                }
            });
        });
        $('#order-areas').select2();
        $('#order-city').select2();
        $('#order-warehouses').select2();

    });

</script>
