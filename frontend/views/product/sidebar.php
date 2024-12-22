<?php

use common\models\shop\Brand;
use common\models\shop\Product;

/** @var Brand $img_brand */
/** @var Product $isset_to_cart */
/** @var Product $product */
/** @var Product $products_analog_count */
/** @var Product $mobile */


?>
<div class="product__sidebar">
    <div class="product__availability"
         style="text-align: center; font-size: 1.5rem; font-weight: 600; letter-spacing: 0.6px;">

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
                            data-url-wish="<?= Yii::$app->urlManager->createUrl(['wish/add-to-wish']) ?>"
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
                            data-url-compare="<?= Yii::$app->urlManager->createUrl(['compare/add-to-compare']) ?>"
                            data-compare-product-id="<?= $product->id ?>">
                        <svg width="32px" height="32px">
                            <use xlink:href="/images/sprite.svg#compare-16"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php if (!$mobile): ?>
        <?= $this->render('info-accordion', [
            'product' => $product,
            'mobile' => $mobile,
            'img_brand' => $img_brand,
        ]) ?>
    <?php endif; ?>
</div>