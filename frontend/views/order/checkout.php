<?php

use yii\helpers\Url;

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
    <div class="checkout block">
        <div class="container">
            <div class="row">

                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="card mb-lg-0">
                        <div class="card-body">
                            <h3 class="card-title">Платіжні реквізити</h3>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="checkout-first-name">Ваше ім'я</label>
                                    <input type="text" class="form-control" id="checkout-first-name"
                                           placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="checkout-last-name">Ваше прізвище</label>
                                    <input type="text" class="form-control" id="checkout-last-name"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="checkout-country">Спосіб оплати</label>
                                <select id="checkout-country" class="form-control form-control-select2">
                                    <option>Виберіть...</option>
                                    <option>United States</option>
                                    <option>Russia</option>
                                    <option>Italy</option>
                                    <option>France</option>
                                    <option>Ukraine</option>
                                    <option>Germany</option>
                                    <option>Australia</option>
                                </select>
                            </div>
                            <div class="payment-methods">
                                <ul class="payment-methods__list">
                                    <li class="payment-methods__item payment-methods__item--active">
                                        <label class="payment-methods__item-header">
                                            <span class="payment-methods__item-radio input-radio">
                                                <span class="input-radio__body">
                                                    <input class="input-radio__input"
                                                           name="checkout_payment_method"
                                                           type="radio" checked>
                                                    <span class="input-radio__circle"></span>
                                                </span>
                                            </span>
                                            <span class="payment-methods__item-title">Нова пошта</span>
                                        </label>
                                        <div class="payment-methods__item-container">
                                            <div class="payment-methods__item-description text-muted">
                                                <div class="form-group">
                                                    <label for="checkout-country">Country</label>
                                                    <select id="checkout-country" class="form-control form-control-select2">
                                                        <option>Select a country...</option>
                                                        <option>United States</option>
                                                        <option>Russia</option>
                                                        <option>Italy</option>
                                                        <option>France</option>
                                                        <option>Ukraine</option>
                                                        <option>Germany</option>
                                                        <option>Australia</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="checkout-street-address">Street Address</label>
                                                    <input type="text" class="form-control" id="checkout-street-address"
                                                           placeholder="Street Address">
                                                </div>
                                                <div class="form-group">
                                                    <label for="checkout-comment">Коментар</label>
                                                    <textarea id="checkout-comment" class="form-control" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="payment-methods__item">
                                        <label class="payment-methods__item-header">
                                            <span class="payment-methods__item-radio input-radio">
                                                <span class="input-radio__body">
                                                    <input class="input-radio__input"
                                                           name="checkout_payment_method"
                                                           type="radio">
                                                    <span class="input-radio__circle"></span>
                                                </span>
                                            </span>
                                            <span class="payment-methods__item-title">Інший спосіб доставлення (кур'єр)</span>
                                        </label>
                                        <div class="payment-methods__item-container">
                                            <div class="payment-methods__item-description text-muted">
                                                <div class="form-group">
                                                    <label for="checkout-street-address">Місто</label>
                                                    <input type="text" class="form-control" id="checkout-city-address"
                                                           placeholder="Ваше місто">
                                                </div>
                                                <div class="form-group">
                                                    <label for="checkout-comment">Коментар</label>
                                                    <textarea id="checkout-comment" class="form-control" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
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
                                        <td><?= Yii::$app->formatter->asCurrency($order->price * $order->quantity) ?></td>
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
                            <div class="payment-methods">
                                <ul class="payment-methods__list">
                                    <li class="payment-methods__item payment-methods__item--active">
                                        <label class="payment-methods__item-header">
                                                    <span class="payment-methods__item-radio input-radio">
                                                        <span class="input-radio__body">
                                                            <input class="input-radio__input" name="checkout_payment_method" type="radio" checked>
                                                            <span class="input-radio__circle"></span>
                                                        </span>
                                                    </span>
                                            <span class="payment-methods__item-title">Direct bank transfer</span>
                                        </label>
                                        <div class="payment-methods__item-container">
                                            <div class="payment-methods__item-description text-muted">
                                                Make your payment directly into our bank account. Please use your Order ID as the payment
                                                reference. Your order will not be shipped until the funds have cleared in our account.
                                            </div>
                                        </div>
                                    </li>
                                    <li class="payment-methods__item">
                                        <label class="payment-methods__item-header">
                                                    <span class="payment-methods__item-radio input-radio">
                                                        <span class="input-radio__body">
                                                            <input class="input-radio__input" name="checkout_payment_method" type="radio">
                                                            <span class="input-radio__circle"></span>
                                                        </span>
                                                    </span>
                                            <span class="payment-methods__item-title">Check payments</span>
                                        </label>
                                        <div class="payment-methods__item-container">
                                            <div class="payment-methods__item-description text-muted">
                                                Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="checkout__agree form-group">
                                <div class="form-check">
                                            <span class="form-check-input input-check">
                                                <span class="input-check__body">
                                                    <input class="input-check__input" type="checkbox"
                                                           id="checkout-terms">
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
                            <button type="submit" class="btn btn-primary btn-xl btn-block">Зробити замовлення</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- site__body / end -->