<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\Report $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php $form = ActiveForm::begin(); ?>
<!-- sa-app__body -->
<div id="top" class="sa-app__body" style="padding-top: 0px">
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
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
            <div class="sa-entity-layout"
                 data-sa-container-query='{"920":"sa-entity-layout--size--md","1100":"sa-entity-layout--size--lg"}'>
                <div class="sa-entity-layout__body">
                    <div class="sa-entity-layout__main">
                        <div class="card">
                            <div class="card-body p-5">
                                <div class="mb-5"><h2 class="mb-0 fs-exact-18"><i class="fas fa-info-circle"></i> Основна Інформація</h2></div>
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <?= $form->field($model, 'platform')->dropDownList(
                                            $platformName = [
                                                'Агропроцвіт' => 'Агропроцвіт',
                                                'Дзвінок' => 'Дзвінок',
                                                'AgroPro' => 'AgroPro',
                                                'FaceBook' => 'FaceBook',
                                                'Prom' => 'Prom',
                                                'Rozetka' => 'Rozetka',
                                                'Instagram' => 'Instagram',
                                            ],
                                            [
                                                'prompt' => '',
                                                'class' => 'form-control custom-class',  // CSS-класс
                                            ])->label('Платформа') ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $form->field($model, 'number_order')->textInput(['maxlength' => true])->label('Номер Замовлення') ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $form->field($model, 'date_order')->input('date')->label('Дата Замовлення') ?>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <?= $form->field($model, 'order_status_id')->dropDownList(
                                            $orderStatus = [
                                                'Очікується' => 'Очікується',
                                                'Комплектується' => 'Комплектується',
                                                'Доставляється' => 'Доставляється',
                                                'Відміна' => 'Відміна',
                                                'Одержано' => 'Одержано',
                                                'Повернення' => 'Повернення',
                                            ],
                                            [
                                                'prompt' => '', // Подсказка
                                                'class' => 'form-control custom-class',  // CSS-класс
                                                'id' => 'order-status-dropdown', // Уникальный идентификатор
                                            ])->label('Статус Замовлення') ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $form->field($model, 'order_pay_ment_id')->dropDownList(
                                            $orderStatus = [
                                                'Оплачено' => 'Оплачено',
                                                'Не оплачено' => 'Не оплачено',
                                                'Повернення' => 'Повернення',
                                            ],
                                            [
                                                'prompt' => '', // Подсказка

                                                'id' => 'order-payment-status-dropdown', // Уникальный идентификатор
                                                'class' => 'form-control custom-class',
                                            ])->label('Статус Оплати') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'comments')->textarea(['rows' => '2', 'class' => "form-control"])->label('Коментар') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5"><h2 class="mb-0 fs-exact-18"><i class="fas fa-user-secret"></i> Дані Замовника</h2></div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'fio')->textInput(['maxlength' => true])->label('П.І.Б') ?>
                                        <div class="mt-3">
                                            <?= $form->field($model, 'tel_number')->widget(MaskedInput::class, [
                                                'mask' => '+38(999)999 9999',
                                            ])->label('Телефон') ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'address')->textarea(['rows' => '4', 'class' => "form-control"]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5"><h2 class="mb-0 fs-exact-18"><i class="fas fa-barcode"></i> Інформація про доставку</h2></div>
                                <div class="row mb-4">
                                    <div class="col-md-3">

                                        <?= $form->field($model, 'delivery_service')->dropDownList(
                                            $deliveryServices = [
                                                'Нова Пошта' => 'Нова Пошта',
                                                'УкрПошта' => 'УкрПошта',
                                                'Самовивіз' => 'Самовивіз',
                                            ],
                                            [
                                                'prompt' => '', // Подсказка
                                                'class' => 'form-control custom-class',  // CSS-класс
                                            ])->label('Служба Доставки') ?>
                                    </div>
                                    <div class="col-md-3">

                                        <?= $form->field($model, 'ttn')->textInput(['maxlength' => true])->label('ТТН') ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $form->field($model, 'date_delivery')->input('date')->label('Дата Відправки') ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $form->field($model, 'price_delivery')->textInput()->label('Ціна Доставки') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sa-entity-layout__sidebar" style="max-width: 15rem">
                        <div class="card w-100">
                            <div class="card-body p-5">
                                <div class="mb-5"><h2 class="mb-0 fs-exact-18"><i class="fas fa-money-bill-wave"></i> Тип Оплати</h2></div>
                                <div class="mb-4">
                                    <?= $form->field($model, 'type_payment')
                                        ->radioList(
                                            [
                                                'Nova Pay' => 'Nova Pay',
                                                'Наложка' => 'Наложка',
                                                'Карта ФОП' => 'Карта ФОП',
                                                'Рахунок ФОП' => 'Рахунок ФОП',
                                                'Самовивіз' => 'Самовивіз',
                                                'Рахунок АП' => 'Рахунок АП',
                                                'Кредит 30/70' => 'Кредит 30/70',
                                                'Наложка ФОП' => 'Наложка ФОП',
                                                'Наложка карта ФОП' => 'Наложка карта ФОП',
                                                'Наложка карта У' => 'Наложка карта У',
                                            ],
                                            [
                                                'item' => function ($index, $label, $name, $checked, $value) {
                                                    $return = '<label class="form-check">';
                                                    $return .= '<input class="form-check-input" type="radio" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '>';
                                                    $return .= ucwords($label);
                                                    $return .= '</label>';
                                                    return $return;
                                                },

                                            ],
                                        )->label(false); ?>
                                </div>
                            </div>
                        </div>
                        <div class="card w-100 mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5"><h2 class="mb-0 fs-exact-18"><i class="far fa-calendar-alt"></i> Дата оплати</h2></div>
                                <?= $form->field($model, 'date_payment')->input('date')->label('Дата Оплати') ?>
                            </div>
                        </div>
                        <div class="card w-100 mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5"><h2 class="mb-0 fs-exact-18"><i class="far fa-calendar-check"></i> Накладна 1С</h2></div>
                                <?= $form->field($model, 'number_order_1c')->textInput(['maxlength' => true])->label('Номер 1С') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sa-app__body / end -->
<?php ActiveForm::end(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var paymentDropdown = document.getElementById('order-payment-status-dropdown');
        var orderDropdown = document.getElementById('order-status-dropdown');

        var updatePaymentBackgroundColor = function() {
            if (paymentDropdown.value === 'Оплачено') {
                paymentDropdown.style.backgroundColor = '#4ee95e5c'; // Зеленый цвет для "Оплачено"
            } else if (paymentDropdown.value === 'Не оплачено') {
                paymentDropdown.style.backgroundColor = '#e9544e5c'; // Красный цвет для "Не оплачено"
            } else if (paymentDropdown.value === 'Повернення') {
                paymentDropdown.style.backgroundColor = 'rgba(247,15,5,0.86)'; // Красный цвет для "Не оплачено"
            } else {
                paymentDropdown.style.backgroundColor = ''; // Установить в пустую строку для значения по умолчанию
            }
        };

        var updateOrderBackgroundColor = function() {
            switch (orderDropdown.value) {
                case 'Очікується':
                    orderDropdown.style.backgroundColor = '#f0e68c5c'; // Желтый цвет для "Очікується"
                    break;
                case 'Комплектується':
                    orderDropdown.style.backgroundColor = '#add8e65c'; // Голубой цвет для "Комплектується"
                    break;
                case 'Доставляється':
                    orderDropdown.style.backgroundColor = '#ffa5005c'; // Оранжевый цвет для "Доставляється"
                    break;
                case 'Відміна':
                    orderDropdown.style.backgroundColor = '#e9544e5c'; // Красный цвет для "Відміна"
                    break;
                case 'Одержано':
                    orderDropdown.style.backgroundColor = '#4ee95e5c'; // Зеленый цвет для "Одержано"
                    break;
                case 'Повернення':
                    orderDropdown.style.backgroundColor = 'rgba(247,15,5,0.86)'; // Серый цвет для "Повернення"
                    break;
                default:
                    orderDropdown.style.backgroundColor = ''; // Установить в пустую строку для значения по умолчанию
            }
        };

        // Обработчики события изменения значения
        paymentDropdown.addEventListener('change', updatePaymentBackgroundColor);
        orderDropdown.addEventListener('change', updateOrderBackgroundColor);

        // Вызовем функции для установки начального цвета при загрузке страницы
        updatePaymentBackgroundColor();
        updateOrderBackgroundColor();
    });
</script>
