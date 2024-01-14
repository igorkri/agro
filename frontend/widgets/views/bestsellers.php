<?php

use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var \common\models\shop\Product $products */

?>
<div class="block block-products block-products--layout--large-first" data-mobile-grid-columns="2">
    <div class="container">
        <div class="block-header">
            <h3 class="block-header__title">Товари для Фермера</h3>
            <div class="block-header__divider"></div>
        </div>
        <div class="block-products__body">
            <div class="block-products__featured">
                <div class="block-products__featured-item">
                    <div class="product-card product-card--hidden-actions ">
                        <div class="product-card__badges-list">
                            <?php if (isset($products[0]->label->name)) : ?>
                                <div class="product-card__badge product-card__badge--new"><?= $products[0]->label->name ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="product-card__image product-image">
                            <a href="<?= Url::to(['product/view', 'slug' => $products[0]->slug]) ?>"
                               class="product-image__body">
                                <img class="product-image__img"
                                     src="<?= $products[0]->getImgOneExtraExtraLarge($products[0]->getId()) ?>"
                                     alt="<?= $products[0]->name ?>" loading="lazy">
                            </a>
                        </div>
                        <div class="product-card__info">
                            <?php if ($products[0]->category->prefix) { ?>
                                <div class="product-card__name">
                                    <?php  echo $products[0]->category->prefix ? '<span class="category-prefix">' . $products[0]->category->prefix . '</span>' : '' ?>
                                </div>
                            <?php } ?>
                            <div class="product-card__name">
                                <a href="<?= Url::to(['product/view', 'slug' => $products[0]->slug]) ?>"><?= $products[0]->name ?></a>
                            </div>
                            <div class="product-card__rating">
                                <div class="product-card__rating-stars">
                                    <?= $products[0]->getRating($products[0]->id, 13, 12) ?>
                                </div>
                                <div class="product-card__rating-legend"><?= count($products[0]->reviews) ?>
                                    відгуків
                                </div>
                            </div>
                        </div>
                        <div class="product-card__actions">
                            <div class="product-card__availability">
                                   <span class="text-success" style="font-weight: 600">
                                              <?php
                                              if ($products[0]->status_id == 1) {
                                                  echo '<i style="font-size:1rem; margin: 5px;" class="fas fa-check"></i> ' . $products[0]->status->name;
                                              } elseif ($products[0]->status_id == 2) {
                                                  echo '<i style="font-size:1rem; color: #ff0000!important; margin: 5px;" class="fas fa-ban"></i> ';
                                                  echo "<span style='color: #ff0000 !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $products[0]->status->name . " </span>";
                                              } elseif ($products[0]->status_id == 3) {
                                                  echo '<i style="font-size:1rem; color: #ff8300!important; margin: 5px;" class="fas fa-truck"></i> ';
                                                  echo "<span style='color: #ff8300 !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $products[0]->status->name . " </span>";
                                              } elseif ($products[0]->status_id == 4) {
                                                  echo '<i style="font-size:1rem; color: #0331fc!important; margin: 5px;" class="fa fa-bars"></i> ';
                                                  echo "<span style='color: #0331fc !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $products[0]->status->name . " </span>";
                                              } else {
                                                  echo "<span style='color: #060505!important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $products[0]->status->name . " </span>";
                                              }
                                              ?>
                                        </span>
                            </div>
                            <?php if ($products[0]->old_price == null) { ?>
                                <div class="product-card__prices">
                                    <?= Yii::$app->formatter->asCurrency($products[0]->getPrice()) ?>
                                </div>
                            <?php } else { ?>
                                <div class="product-card__prices">
                                    <span class="product-card__new-price"><?= Yii::$app->formatter->asCurrency($products[0]->getPrice()) ?></span>
                                    <span class="product-card__old-price"><?= Yii::$app->formatter->asCurrency($products[0]->getOldPrice()) ?></span>
                                </div>
                            <?php } ?>
                            <div class="form-group product__option-widgets">
                                        <span class="text-success" style="padding: 3px 1px;font-size: 25px;">
                            </span>
                            </div>
                            <?php if ($products[0]->status_id != 2) { ?>
                                <div class="product-card__buttons">
                                    <button class="btn btn-primary product-card__addtocart "
                                            type="button"
                                            data-product-id="<?= $products[0]->id ?>">
                                        <svg width="20px" height="20px" style="display: unset;">
                                            <use xlink:href="/images/sprite.svg#cart-20"></use>
                                        </svg>
                                        <?= !$products[0]->getIssetToCart($products[0]->id) ? 'Купити' : 'В кошику' ?>
                                    </button>
                                    <button type="button"
                                            class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                            aria-label="add wish list"
                                            id="add-from-wish-btn"
                                            data-wish-product-id="<?= $products[0]->id ?>">
                                        <svg width="20px" height="20px">
                                            <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                        </svg>
                                    </button>
                                    <button type="button"
                                            class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                            aria-label="add compare list"
                                            id="add-from-compare-btn"
                                            data-compare-product-id="<?= $products[0]->id ?>">
                                        <svg width="20px" height="20px">
                                            <use xlink:href="/images/sprite.svg#compare-16"></use>
                                        </svg>
                                    </button>
                                </div>
                            <?php } else { ?>
                                <div class="product-card__buttons">
                                    <button class="btn btn-secondary disabled"
                                            type="button"
                                            data-product-id="<?= $products[0]->id ?>">
                                        <svg width="20px" height="20px" style="display: unset;">
                                            <use xlink:href="/images/sprite.svg#cart-20"></use>
                                        </svg>
                                        <?= !$products[0]->getIssetToCart($products[0]->id) ? 'Купити' : 'В кошику' ?>
                                    </button>
                                    <button type="button"
                                            class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                            aria-label="add wish list"
                                            id="add-from-wish-btn"
                                            data-wish-product-id="<?= $products[0]->id ?>">
                                        <svg width="20px" height="20px">
                                            <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                        </svg>
                                    </button>
                                    <button type="button"
                                            class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                            aria-label="add compare list"
                                            id="add-from-compare-btn"
                                            data-compare-product-id="<?= $products[0]->id ?>">
                                        <svg width="20px" height="20px">
                                            <use xlink:href="/images/sprite.svg#compare-16"></use>
                                        </svg>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-products__list">
                <?php $i = 0; ?>
                <?php foreach ($products as $product): ?>
                    <?php if ($i != 0): ?>
                        <div class="block-products__list-item">
                            <div class="product-card product-card--hidden-actions ">
                                <?php if (isset($product->label)): ?>
                                    <div class="product-card__badges-list">
                                        <div class="product-card__badge product-card__badge--hot"><?= $product->label->name ?></div>
                                    </div>
                                <?php endif; ?>
                                <div class="product-card__image product-image">
                                    <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"
                                       class="product-image__body">
                                        <img class="product-image__img"
                                             src="<?= $product->getImgOneLarge($product->getId()) ?>"
                                             alt="<?= $product->name ?>" loading="lazy">
                                    </a>
                                </div>
                                <div class="product-card__info">
                                    <?php if ($product->category->prefix) { ?>
                                        <div class="product-card__name">
                                            <?php  echo $product->category->prefix ? '<span class="category-prefix">' . $product->category->prefix . '</span>' : '' ?>
                                        </div>
                                    <?php } ?>
                                    <div class="product-card__name">
                                        <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"><?= $product->name ?></a>
                                    </div>
                                    <div class="product-card__rating">
                                        <div class="product-card__rating-stars">
                                            <?= $product->getRating($product->id, 13, 12) ?>
                                        </div>
                                        <div class="product-card__rating-legend"><?= count($product->reviews) ?>
                                            відгуків
                                        </div>
                                    </div>
                                </div>
                                <div class="product-card__actions">
                                    <div class="product-card__availability">
                                  <span class="text-success">
                                        <?= $this->render('status', ['product' => $product]) ?>
                                        </span>
                                    </div>
                                    <?php if ($product->old_price == null) { ?>
                                        <div class="product-card__prices">
                                            <?= Yii::$app->formatter->asCurrency($product->getPrice()) ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="product-card__prices">
                                            <span class="product-card__new-price"><?= Yii::$app->formatter->asCurrency($product->getPrice()) ?></span>
                                            <span class="product-card__old-price"><?= Yii::$app->formatter->asCurrency($product->getOldPrice()) ?></span>
                                        </div>
                                    <?php } ?>
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
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                                </svg>
                                            </button>
                                            <button type="button"
                                                    class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                                    aria-label="add compare list"
                                                    id="add-from-compare-btn"
                                                    data-compare-product-id="<?= $product->id ?>">
                                                <svg width="16px" height="16px">
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
                                                <?= !$product->getIssetToCart($product->id) ? 'Купити' : 'В кошику' ?>
                                            </button>
                                            <button type="button"
                                                    class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                                    aria-label="add wish list"
                                                    id="add-from-wish-btn"
                                                    data-wish-product-id="<?= $product->id ?>">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                                </svg>
                                            </button>
                                            <button type="button"
                                                    class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                                    aria-label="add compare list"
                                                    id="add-from-compare-btn"
                                                    data-compare-product-id="<?= $product->id ?>">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="/images/sprite.svg#compare-16"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<style>
    .category-prefix {
        color: #a9a8a8;
    }
</style>