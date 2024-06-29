<?php

use common\models\shop\ActivePages;
use frontend\assets\OrderCheckoutPageAsset;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\MaskedInput;

OrderCheckoutPageAsset::register($this);
ActivePages::setActiveUser();

$this->title = Yii::t('app', 'Оформлення замовлення');
?>
    <div class="site__body">
        <div class="page-header">
            <div class="page-header__container container">
                <div class="page-header__breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/"><?= Yii::t('app', 'Головна') ?></a>
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
                                <h3 class="card-title"><?= Yii::t('app', 'Інформація для доставки') ?></h3>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <?= $form->field($order, 'fio')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?= $form->field($order, 'phone')->widget(MaskedInput::class, [
                                            'mask' => '+38(999)999 9999',
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
                                                <span class="payment-methods__item-name">
                                                    <i style="font-size: 25px; color: #2f720e" class="fas fa-truck"></i>
                                                    <span style="font-size:20px; margin:0 20px"><?= Yii::t('app', 'Самовивіз') ?>
                                                    </span>
                                                </span>
                                            </label>
                                            <div class="payment-methods__item-container" style="">
                                                <div class="payment-methods__item-description text-muted">
                                                    <ul class="footer-contacts__contacts">
                                                        <li>
                                                            <i class="footer-contacts__icon fas fa-globe-americas"></i> <?= $contacts->address ?>
                                                        </li>
                                                        <li>
                                                            <i class="footer-contacts__icon far fa-envelope"></i> <?= $contacts->email ?>
                                                        </li>
                                                        <li><i class="footer-contacts__icon fas fa-mobile-alt"></i> <a
                                                                    href="tel:<?= str_replace([' ', '(', ')', '-'], '', $contacts->tel_primary) ?>"><?= $contacts->tel_primary ?></a>
                                                        </li>
                                                        <li><i class="footer-contacts__icon fas fa-mobile-alt"></i> <a
                                                                    href="tel:<?= str_replace([' ', '(', ')', '-'], '', $contacts->tel_second) ?>"><?= $contacts->tel_second ?></a>
                                                        </li>
                                                        <li>
                                                            <i class="footer-contacts__icon far fa-clock"></i> <?= $contacts->work_time_short ?>
                                                        </li>
                                                    </ul>
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
                                                <span class="delivery-methods__item-name">
                                                <svg width="32px" height="32px" style="margin-right: 5px;">
                                                        <use xlink:href="/images/sprite.svg#novaposhta"></use>
                                                </svg>
                                            </span>
                                                <span style="font-size:20px; margin:0 20px"><?= Yii::t('app', 'Нова Пошта') ?></span>
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
                                                                'data-url-cities' => Yii::$app->urlManager->createUrl(['n-p/cities']),
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
                                                                'data-url-warehouses' => Yii::$app->urlManager->createUrl(['n-p/warehouses']),
                                                                'placeholder' => 'Виберіть місто...',
                                                                'class' => 'sa-select2 form-select',
                                                            ],
                                                            'pluginOptions' => [
                                                                'allowClear' => true,
                                                                'width' => '100%',
                                                                'max-width' => '550px',
                                                                'margin' => '0 auto',
                                                                'matcher' => new JsExpression("function(params, data) {
                                                                if ($.trim(params.term) === '') {
                                                                    return data;
                                                                }
                                                                var terms = params.term.split(' ');
                                                                for (var i = 0; i < terms.length; i++) {
                                                                    if (data.text.toUpperCase().indexOf(terms[i].toUpperCase()) === 0) {
                                                                        return data;
                                                                    }
                                                                }
                                                                return null;
                                                            }"),
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
                                        <li class="payment-methods__item">
                                            <label class="payment-methods__item-header">
                                        <span class="payment-methods__item-radio input-radio">
                                            <span class="input-radio__body">
                                                <input class="input-radio__input" name="checkout_payment_method"
                                                       value="ukrpost" type="radio">
                                                <span class="input-radio__circle"></span>
                                            </span>
                                        </span>
                                                <span class="payment-methods__item-name">
                                                    <svg width="32px" height="32px" style="margin-right: 5px;">
                                                        <use xlink:href="/images/sprite.svg#ukrposhta"></use>
                                                </svg> </span>
                                                <span style="font-size:20px; margin:0 20px"><?= Yii::t('app', 'Укрпошта') ?></span>
                                            </label>
                                            <div class="payment-methods__item-container" style="">
                                                <div class="payment-methods__item-description text-muted">
                                                    <p style="background-color: rgba(255,0,0,0.49);
                                                    font-weight: bold;
                                                    font-size: 18px;
                                                    color: white;
                                                    text-align: center;
                                                    padding-top: 3px;
                                                    padding-bottom: 3px;
">
                                                        <?=Yii::t('app','Відправка при 100% оплаті за замовлення!!!')?>
                                                    </p>
                                                    <p style="font-weight: 600"><?=Yii::t('app','Для доставки "Укрпошта" введіть в полі
                                                        коментар такі дані')?>:</p>
                                                    <ul style="margin-bottom: 1rem">
                                                        <li><?=Yii::t('app','Індекс')?></li>
                                                        <li><?=Yii::t('app','Область')?></li>
                                                        <li><?=Yii::t('app','Район')?></li>
                                                        <li><?=Yii::t('app','Місто/Смт (село)')?></li>
                                                    </ul>
                                                    <p style="font-weight: 600"><?=Yii::t('app','Для прикладу')?>:</p>
                                                    <p>36502, <?=Yii::t('app','Полтавська, Кременчуцький, м.Кременчук')?></p>
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
                                <h3 class="card-title"><?= Yii::t('app', 'Ваше замовлення') ?></h3>
                                <table class="checkout__totals">
                                    <thead class="checkout__totals-header">
                                    <tr>
                                        <th><?= Yii::t('app', 'Товар') ?></th>
                                        <th><?= Yii::t('app', 'Всього') ?></th>
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
                                        <th><?= Yii::t('app', 'Загальна сума') ?></th>
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
                                        <label class="form-check-label"
                                               for="checkout-terms"><?= Yii::t('app', 'Я прочитав і погоджуюся з веб-сайтом ') ?>
                                            <a target="_blank" href="<?= Url::to(['/order/conditions']) ?>">
                                                <?= Yii::t('app', ' умови повернення та обміну') ?> </a><span
                                                    style="color: red">*</span>
                                        </label>
                                    </div>
                                </div>
                                <?php if ($total_summ != 0) { ?>
                                    <button type="submit" class="btn btn-primary btn-dec-lg btn-block"
                                            style="font-size: 16px"><?= Yii::t('app', 'Зробити замовлення') ?>
                                    </button>
                                <?php } else { ?>
                                    <a class="btn btn-warning btn-dec-lg btn-block" style="font-size: 16px"
                                       href="<?= Url::to(['/']) ?>"><?= Yii::t('app', 'Дивитись товари') ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php
$js = <<<JS
    $(document).ready(function () {

        var stock = $('input[name="checkout_payment_method"]:checked').val();

        $('input[name="checkout_payment_method"]').change(function () {
            stock = $(this).val();

            if (stock === "beznal") {
                $('#order-areas').val("Самовивіз").trigger("change");
                $('#order-city').val("Самовивіз").trigger("change");
                $('#order-warehouses').val("Самовивіз").trigger("change");
            }
            if (stock === "ukrpost") {
                $('#order-areas').val("Укрпошта").trigger("change");
                $('#order-city').val("Укрпошта").trigger("change");
                $('#order-warehouses').val("Укрпошта").trigger("change");
            }
        });
        
        if (stock !== "beznal") {
            $('#order-areas').on('change', function () {
                var urlCities = $(this).data('url-cities');
                var areaId = $(this).val();
                $.ajax({
                    url: urlCities,
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
                var urlWarehouses = $(this).data('url-warehouses');
                var cityId = $(this).val();
                $.ajax({
                    url: urlWarehouses,
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
        }
    });
JS;
$this->registerJs($js);
?>