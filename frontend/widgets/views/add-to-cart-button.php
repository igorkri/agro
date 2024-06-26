<?php

/** @var Product $product */

use common\models\shop\Product;

?>

<div class="product-card__buttons">
    <?php if ($product->status_id != 2) { ?>
        <button class="btn btn-primary product-card__addtocart"
                type="button"
                id="add-to-cart"
                data-product-id="<?= $product->id ?>"
                data-url-quickview="<?= Yii::$app->urlManager->createUrl(['cart/quickview']) ?>"
                data-url-qty-cart="<?= Yii::$app->urlManager->createUrl(['cart/qty-cart']) ?>"
        >
            <svg width="20px" height="20px" style="display: unset;">
                <use xlink:href="/images/sprite.svg#cart-20"></use>
            </svg>
            <?= !$product->getIssetToCart($product->id) ? 'Купити' : 'В кошику' ?>
        </button>
    <?php } else { ?>
        <button class="btn btn-secondary disabled"
                type="button"
                data-product-id="<?= $product->id ?>">
            <svg width="20px" height="20px" style="display: unset;">
                <use xlink:href="/images/sprite.svg#cart-20"></use>
            </svg>
            Купити
        </button>
    <?php } ?>
    <button type="button"
            class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__wish"
            aria-label="add wish list"
            data-url-wish="<?= Yii::$app->urlManager->createUrl(['wish/add-to-wish']) ?>"
            data-wish-product-id="<?= $product->id ?>">
        <svg width="20px" height="20px">
            <use xlink:href="/images/sprite.svg#wishlist-16"></use>
        </svg>
    </button>
    <button type="button"
            class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
            aria-label="add compare list"
            data-url-compare="<?= Yii::$app->urlManager->createUrl(['compare/add-to-compare']) ?>"
            data-compare-product-id="<?= $product->id ?>">
        <svg width="20px" height="20px">
            <use xlink:href="/images/sprite.svg#compare-16"></use>
        </svg>
    </button>
</div>