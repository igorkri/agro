<?php

use yii\helpers\Url;

?>
<div class="product__sidebar">
    <div class="product__availability" style="text-align: center; font-size: 1.5rem; font-weight: 600; letter-spacing: 0.6px;">

                                <?php $statusIcon = '';
                                $statusStyle = '';

                                switch ($product->status_id) {
                                    case 1:
                                        $statusIcon = '<i style="margin: 5px; color: #28a745;" class="fas fa-check"></i>';
                                        $statusStyle = 'color: #28a745;';
                                        break;
                                    case 2:
                                        $statusIcon = '<i style="margin: 5px; color: #ff0000;" class="fas fa-ban"></i>';
                                        $statusStyle = 'color: #ff0000;';
                                        break;
                                    case 3:
                                        $statusIcon = '<i style="margin: 5px; color: #ff8300;" class="fas fa-truck"></i>';
                                        $statusStyle = 'color: #ff8300;';
                                        break;
                                    case 4:
                                        $statusIcon = '<i style="margin: 5px; color: #0331fc;" class="fa fa-bars"></i>';
                                        $statusStyle = 'color: #0331fc;';
                                        break;
                                    default:
                                        $statusStyle = 'color: #060505;';
                                        break;
                                }

                                echo $statusIcon . '<span style="' . $statusStyle . '">' . Yii::t('app', $product->status->name) . '</span>';
                                ?>

    </div>
    <?php if ($products_analog_count > 0 && $product->status_id == 2) : ?>
        <div class="product-card__badge--analog"
             style="text-align: center"><?= Yii::t('app', 'Але є аналоги') . ' ' . $products_analog_count ?></div>
    <?php endif; ?>
    <div class="product__prices" style="text-align: center">
        <?php $price = Yii::$app->formatter->asCurrency($product->getPrice()) ?>
        <?php if ($product->old_price == null) { ?>
            <div class="product-card__prices">
                <?= $price ?>
            </div>
        <?php } else { ?>
            <div class="product-card__prices">
                <span class="product-card__new-price"><?= $price ?></span>
                <span class="product-card__old-price"><?= Yii::$app->formatter->asCurrency($product->getOldPrice()) ?></span>
            </div>
        <?php } ?>
    </div>
    <div class="product__options">
        <div class="form-group product__option">
            <div class="product__actions">
                <div class="product__actions-item product__actions-item--addtocart">
                    <?php if ($product->status_id != 2) { ?>
                        <button class="btn btn-primary btn-lg product-card__addtocart"
                                aria-label="В кошик"
                                type="button"
                                data-product-id="<?= $product->id ?>"
                                data-url-quickview="<?= Yii::$app->urlManager->createUrl(['cart/quickview']) ?>"
                                data-url-qty-cart="<?= Yii::$app->urlManager->createUrl(['cart/qty-cart']) ?>"
                        >
                            <svg width="20px" height="20px" style="display: unset;">
                                <use xlink:href="/images/sprite.svg#cart-20"></use>
                            </svg>
                            <?= !$isset_to_cart ? Yii::t('app', 'Купити') : Yii::t('app', 'В кошику') ?>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary btn-lg disabled"
                                type="button"
                                data-product-id="">
                            <svg width="20px" height="20px" style="display: unset;">
                                <use xlink:href="/images/sprite.svg#cart-20"></use>
                            </svg>
                            <?= Yii::t('app', 'Купити') ?>
                        </button>
                    <?php } ?>
                </div>
                <div class="product__actions-item product__actions-item--wishlist" style="margin-left: auto;">
                    <button type="button"
                            class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__wish"
                            aria-label="add wish list"
                            id="add-from-wish-btn-<?= $product->id ?>"
                            data-wish-product-id="<?= $product->id ?>">
                        <svg width="32px" height="32px">
                            <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                        </svg>
                    </button>
                </div>
                <div class="product__actions-item product__actions-item--compare">
                    <button type="button"
                            class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                            aria-label="add compare list"
                            id="add-from-compare-btn-<?= $product->id ?>"
                            data-compare-product-id="<?= $product->id ?>">
                        <svg width="32px" height="32px">
                            <use xlink:href="/images/sprite.svg#compare-16"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="payment-methods">
        <ul class="payment-methods__list">
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
                        <i style="font-size: 25px"
                           class="fas fa-qrcode">

                        </i>
                                            <span style="font-size:20px; margin:0 20px">
                                                <?= Yii::t('app', 'Артикул') ?>
                                            </span>
                    </span>
                </label>
                <div class="payment-methods__item-container" style="">
                    <div class="payment-methods__item-description text-muted"
                         style="text-align: center;">
                        <b><?= $product->sku ?></b>
                    </div>
                </div>
            </li>
            <li class="payment-methods__item">
                <label class="payment-methods__item-header">
                                        <span class="payment-methods__item-radio input-radio">
                                            <span class="input-radio__body">
                                                <input class="input-radio__input" name="checkout_payment_method"
                                                       value="" type="radio">
                                                <span class="input-radio__circle"></span>
                                            </span>
                                        </span>
                    <span class="delivery-methods__item-name"><i style="font-size: 25px"
                                                                 class="fas fa-truck"></i>
                                            <span style="font-size:20px; margin:0 20px"><?= Yii::t('app', 'Доставка') ?></span></span>
                </label>
                <div class="payment-methods__item-container" style="">
                    <div class="payment-methods__item-description text-muted">
                        <div style="display: flex; align-items: center;">
                            <svg width="24px" height="24px" style="margin-right: 5px;">
                                <use xlink:href="/images/sprite.svg#novaposhta"></use>
                            </svg>
                            <b><?= Yii::t('app', 'Нова Пошта') ?></b>
                        </div>
                        <ul>
                            <li>
                                <?= Yii::t('app', 'Від 70 грн.') ?>
                            </li>
                            <li>
                                <?= Yii::t('app', 'Тарифи') ?> <a
                                        href="https://novaposhta.ua/basic_tariffs"
                                        target="_bank"><?= Yii::t('app', 'перевізника') ?></a>
                            </li>
                        </ul>
                        <div style="display: flex; align-items: center;">
                            <svg width="24px" height="24px" style="margin-right: 5px;">
                                <use xlink:href="/images/sprite.svg#ukrposhta"></use>
                            </svg>
                            <b><?= Yii::t('app', 'Укрпошта') ?></b>
                        </div>
                        <ul>
                            <li>
                                <?= Yii::t('app', 'Від 35 грн.') ?>
                            </li>
                            <li>
                                <?= Yii::t('app', 'Тарифи') ?> <a
                                        href="https://www.ukrposhta.ua/ua/taryfy-ukrposhta-standart"
                                        target="_bank"><?= Yii::t('app', 'перевізника') ?></a>
                            </li>
                        </ul>
                        <div style="display: flex; align-items: center;">
                            <svg width="24px" height="24px" style="margin-right: 5px;">
                                <use xlink:href="/images/sprite.svg#delivery-48"
                                     style="fill: #47991f;"></use>
                            </svg>
                            <b><?= Yii::t('app', 'Самовивіз') ?></b>
                        </div>
                        <ul>
                            <li>
                                <?= Yii::t('app', 'Відвантаження з Полтави') ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
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
                                style="font-size:20px; margin:0 20px"><?= Yii::t('app', 'Оплата') ?></span></span>
                </label>
                <div class="payment-methods__item-container" style="">
                    <div class="payment-methods__item-description text-muted">
                        <ul>
                            <li><?= Yii::t('app', 'Visa/Mastercard') ?></li>
                            <li><?= Yii::t('app', 'Оплатити готівкою') ?></li>
                            <li><?= Yii::t('app', 'Наложенний платіж') ?></li>
                            <li><?= Yii::t('app', 'Розрахунковий рахунок') ?></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="payment-methods__item">
                <label class="payment-methods__item-header">
                                        <span class="payment-methods__item-radio input-radio">
                                            <span class="input-radio__body">
                                                <input class="input-radio__input" name="checkout_payment_method"
                                                       value="online" type="radio">
                                                <span class="input-radio__circle"></span>
                                            </span>
                                        </span>
                    <span class="shield-methods__item-name"><i style="font-size: 25px"
                                                               class="fas fa-shield-alt"></i> <span
                                style="font-size:20px; margin:0 12px">
                                                    <?= Yii::t('app', 'Повернення') ?></span></span>
                </label>
                <div class="payment-methods__item-container" style="">
                    <div class="payment-methods__item-description text-muted">
                        <ul>
                            <li>
                                <?= Yii::t('app', 'Умови повернення та') ?>
                                <a target="_blank" href="<?= Url::to(['order/conditions']) ?>">
                                    <?= Yii::t('app', 'обміну') ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
        <?php if (!Yii::$app->devicedetect->isMobile()): ?>
            <div>
                <?php if ($product->brand_id != null): ?>
                    <img src="/brand/<?= $img_brand->file ?>"
                         width="330" height="54"
                         alt="<?= $img_brand->name ?>"
                         loading="lazy"
                         style="width: 100%; margin-top: 10px;">
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>