<?php

use kartik\form\ActiveForm;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'Оформлення замовлення';
?>
<!-- site__body -->
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
    <?php $form = ActiveForm::begin(['options' => ['autocomplete'=>"off"]]); ?>
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
                                    ])?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= $form->field($order, 'city')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
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
                            <?php if ($total_summ != 0){ ?>
                                <button type="submit" class="btn btn-primary btn-dec-xl btn-block">Зробити замовлення</button>
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
<!-- site__body / end -->