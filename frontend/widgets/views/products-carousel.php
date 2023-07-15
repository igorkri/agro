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
                                <button class="product-card__quickview ttp_inf" type="button"
                                        aria-label="Info"
                                        data-title=" <?= \common\models\shop\Product::productParams($product->id) ?> ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                    <span class="fake-svg-icon"></span>
                                </button>
                                <?php if (isset($product->label)): ?>
                                    <div class="product-card__badges-list">
                                        <div class="product-card__badge product-card__badge--sale"><?= $product->label->name ?></div>
                                    </div>
                                <?php endif; ?>

                                    <div class="product-card__image product-image">
                                        <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"
                                           class="product-image__body">
                                            <img class="product-image__img"
                                                 src="<?= $product->getImgOneSmall($product->getId()) ?>" alt="<?= $product->name ?>">
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
                                    <div class="product-card__availability">
                                  <span class="text-success">
                                           <!-- status -->
                                        <?= $this->render('status', ['product' => $product]) ?>
                                        <!-- status / end -->
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
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<?= $this->render('info-params') ?>
