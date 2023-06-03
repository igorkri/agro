<?php

use common\models\shop\Product;
use yii\helpers\Url;

/** @var Product $products */

?>
<div class="block block-products-carousel" data-layout="horizontal" data-mobile-grid-columns="2">
    <div class="container">
        <div class="block-header">
            <h3 class="block-header__title">Нові надходження</h3>
            <div class="block-header__divider"></div>
            <div class="block-header__arrows-list">
                <button class="block-header__arrow block-header__arrow--left" type="button">
                    <svg width="7px" height="11px">
                        <use xlink:href="/images/sprite.svg#arrow-rounded-left-7x11"></use>
                    </svg>
                </button>
                <button class="block-header__arrow block-header__arrow--right" type="button">
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
                                        <div class="product-card__badge product-card__badge--sale"><?= $product->label->name ?></div>
                                    </div>
                                <?php endif; ?>

                                    <div class="product-card__image product-image">
                                        <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"
                                           class="product-image__body">
                                            <img class="product-image__img"
                                                 src="<?= $product->getImgOne($product->getId()) ?>" alt="">
                                        </a>
                                    </div>

                                <div class="product-card__info">
                                    <div class="product-card__name_slider">
                                        <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"><?= $product->name ?></a>
                                    </div>
                                    <div class="product-card__rating">
                                        <div class="product-card__rating-stars">
                                            <?=$product->getRating($product->id, 13, 12)?>
                                        </div>
                                        <div class="product-card__rating-legend"><?=count($product->reviews)?> відгуків</div>
                                    </div>
                                </div>
                                <div class="product-card__actions">
                                    <div class="product-card__prices">
                                        <?= Yii::$app->formatter->asCurrency($product->getPrice()) ?></span>
                                        <!-- status -->
                                        <?=$this->render('status',['product' => $product])?>
                                        <!-- status / end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

