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
                        <h1 class="h3 m-0">Редагування Замовлення # <?= $model->id ?></h1>
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
                                <div class="mb-5"><h2 class="mb-0 fs-exact-18">Основна Інформація</h2></div>


                                <div class="row mb-4">
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'number_order')->textInput(['maxlength' => true])->label('Номер Замовлення') ?>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'number_order_1c')->textInput(['maxlength' => true])->label('Номер 1С') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'date_order')->input('date')->label('Дата Замовлення') ?>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'order_status_id')->dropDownList(
                                            $orderStatus = [
                                                'Очікуеться' => 'Очікуеться',
                                                'Комплектуеться' => 'Комплектуеться',
                                                'Доставляеться' => 'Доставляеться',
                                                'Відміна' => 'Відміна',
                                                'Одержано' => 'Одержано',
                                                'Повернення' => 'Повернення',
                                            ],
                                            [
                                                'prompt' => '', // Подсказка
                                                'class' => 'form-control custom-class',  // CSS-класс
                                            ])->label('Статус Замовлення') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'order_pay_ment_id')->dropDownList(
                                            $orderStatus = [
                                                'Оплачено' => 'Оплачено',
                                                'Не оплачено' => 'Не оплачено',
                                            ],
                                            [
                                                'prompt' => '', // Подсказка
                                                'class' => 'form-control custom-class',  // CSS-класс
                                            ])->label('Статус Оплати') ?>
                                    </div>
                                </div>
                                <div>
                                    <?= $form->field($model, 'comments')->textarea(['rows' => '4', 'class' => "form-control"])->label('Коментар') ?>
                                </div>
                            </div>
                        </div>


                        <div class="card mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5"><h2 class="mb-0 fs-exact-18">Дані Замовника</h2></div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'fio')->textInput(['maxlength' => true])->label('П.І.Б') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'tel_number')->widget(MaskedInput::class, [
                                            'mask' => '+38(999)999 9999',
                                        ])->label('Телефон') ?>
                                    </div>
                                </div>
                                <div>
                                    <?= $form->field($model, 'address')->textarea(['rows' => '4', 'class' => "form-control"]) ?>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5"><h2 class="mb-0 fs-exact-18">Інформація про доставку</h2></div>
                                <div class="row mb-4">
                                    <div class="col-md-6">

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
                                    <div class="col-md-6">

                                        <?= $form->field($model, 'ttn')->textInput(['maxlength' => true])->label('ТТН') ?>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'date_delivery')->input('date')->label('Дата Відправки') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'price_delivery')->textInput()->label('Ціна Доставки') ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="sa-entity-layout__sidebar">
                        <div class="card w-100">
                            <div class="card-body p-5">
                                <div class="mb-5"><h2 class="mb-0 fs-exact-18">Тип Оплати</h2></div>
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

<!--                        <div class="card w-100 mt-5">-->
<!--                            <div class="card-body p-5">-->
<!--                                <div class="mb-5"><h2 class="mb-0 fs-exact-18">Variable</h2></div>-->
<!--                                <div class="mb-4">-->
<!--                                    <label class="form-check">-->
<!--                                        <input type="radio" class="form-check-input" name="status"/>-->
<!--                                        <span class="form-check-label">Published</span>-->
<!--                                    </label>-->
<!--                                    <label class="form-check">-->
<!--                                        <input type="radio" class="form-check-input" name="status" checked=""/>-->
<!--                                        <span class="form-check-label">Scheduled</span>-->
<!--                                    </label>-->
<!--                                    <label class="form-check mb-0">-->
<!--                                        <input type="radio" class="form-check-input" name="status"/>-->
<!--                                        <span class="form-check-label">Hidden</span>-->
<!--                                    </label>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->

                        <div class="card w-100 mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5"><h2 class="mb-0 fs-exact-18">Дата оплати</h2></div>
                                <?= $form->field($model, 'date_payment')->input('date')->label('Дата Оплати') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sa-app__body / end -->
<!-- sa-app__footer -->
<div class="sa-app__footer d-block d-md-flex">
    <!-- copyright -->
    Stroyka Admin — eCommerce Dashboard Template © 2021
    <div class="m-auto"></div>
    <div>
        Powered by HTML — Design by
        <a href="https://themeforest.net/user/kos9/portfolio">Kos</a>
    </div>
    <!-- copyright / end -->
</div>
<!-- sa-app__footer / end -->
<?php ActiveForm::end(); ?>
