<?php

/** @var Product $product */

use common\models\shop\Product;

?>

<?php if ($product->status_id != 2) { ?>
    <div class="product-card__buttons">
        <button class="btn btn-primary product-card__addtocart "
                type="button"
                data-product-id="<?= $product->id ?>">
            <svg width="20px" height="20px" style="display: unset;">
                <use xlink:href="/images/sprite.svg#cart-20"></use>
            </svg>
            <?= !$product->getIssetToCart($product->id) ? 'Купити' : 'В кошику' ?>
        </button>
        <button type="button"
                class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                aria-label="add wish list"
                id="add-from-wish-btn"
                data-wish-product-id="<?= $product->id ?>">
            <svg width="20px" height="20px">
                <use xlink:href="/images/sprite.svg#wishlist-16"></use>
            </svg>
        </button>
        <button type="button"
                class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                aria-label="add compare list"
                id="add-from-compare-btn"
                data-compare-product-id="<?= $product->id ?>">
            <svg width="20px" height="20px">
                <use xlink:href="/images/sprite.svg#compare-16"></use>
            </svg>
        </button>
    </div>
<?php } else { ?>
    <div class="product-card__buttons">
        <button class="btn btn-secondary disabled"
                type="button"
                data-product-id="<?= $product->id ?>">
            <svg width="20px" height="20px" style="display: unset;">
                <use xlink:href="/images/sprite.svg#cart-20"></use>
            </svg>
            Купити
        </button>
        <button type="button"
                class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                aria-label="add wish list"
                id="add-from-wish-btn"
                data-wish-product-id="<?= $product->id ?>">
            <svg width="20px" height="20px">
                <use xlink:href="/images/sprite.svg#wishlist-16"></use>
            </svg>
        </button>
        <button type="button"
                class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                aria-label="add compare list"
                id="add-from-compare-btn"
                data-compare-product-id="<?= $product->id ?>">
            <svg width="20px" height="20px">
                <use xlink:href="/images/sprite.svg#compare-16"></use>
            </svg>
        </button>
    </div>
<?php } ?>
