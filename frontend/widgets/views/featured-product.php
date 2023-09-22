<?php

use yii\helpers\Url;

/** @var \common\models\shop\Product $products */

?>
<div class="block block-products-carousel" data-layout="grid-5" data-mobile-grid-columns="2">
    <div class="container">
        <div class="block-header">
            <h3 class="block-header__title">Популярні товари</h3>
            <div class="block-header__divider"></div>
            <ul class="block-header__groups-list">
                <li>
                    <button type="button" class="block-header__group  block-header__group--active ">Всі</button>
                </li>
                <li>
                    <button type="button" class="block-header__group ">Гербіциди</button>
                </li>
                <li>
                    <button type="button" class="block-header__group ">Фунгіциди</button>
                </li>
                <li>
                    <button type="button" class="block-header__group ">Інсектециди</button>
                </li>
            </ul>
            <div class="block-header__arrows-list">
                <button class="block-header__arrow block-header__arrow--left" type="button" aria-label="Left">
                    <svg width="7px" height="11px">
                        <use xlink:href="/images/sprite.svg#arrow-rounded-left-7x11"></use>
                    </svg>
                </button>
                <button class="block-header__arrow block-header__arrow--right" type="button" aria-label="Right">
                    <svg width="7px" height="11px">
                        <use xlink:href="/images/sprite.svg#arrow-rounded-right-7x11"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="block-products-carousel__slider">
            <div class="block-products-carousel__preloader"></div>
            <div class="owl-carousel">
                <?php foreach ($products as $product): ?>
                    <div class="block-products-carousel__column">
                        <div class="block-products-carousel__cell">
                            <div class="product-card product-card--hidden-actions ">
                                <?php if (isset($product->label)): ?>
                                    <div class="product-card__badges-list">
                                        <div class="product-card__badge product-card__badge--new"><?= $product->label->name ?></div>
                                    </div>
                                <?php endif; ?>
                                <div class="product-card__image product-image">
                                    <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"
                                       class="product-image__body">
                                        <img class="product-image__img"
                                             src="<?= $product->getImgOneLarge($product->getId()) ?>" alt="<?= $product->name ?>" loading="lazy">
                                    </a>
                                </div>
                                <div class="product-card__info">
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
                                                <?= !$product->getIssetToCart($product->id) ? 'В Кошик' : 'Уже в кошику' ?>
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
                                                <?= !$product->getIssetToCart($product->id) ? 'В Кошик' : 'Уже в кошику' ?>
                                            </button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>