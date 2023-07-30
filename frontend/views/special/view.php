<?php

use common\models\shop\ProductProperties;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

\common\models\shop\ActivePages::setActiveUser();

/** @var \common\models\shop\Product $products */
/** @var \common\models\shop\Product $pages */

?>
<!-- site__body -->
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/"> <i class="fas fa-home"></i> Головна</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Спеціальні пропозиції</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Спеціальні пропозиції</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="block">
                    <div class="products-view">
                        <div class="products-view__options">
                            <div class="view-options view-options--offcanvas--always">
                                <div class="view-options__layout">
                                    <div class="layout-switcher">
                                    </div>
                                </div>
                                <div class="view-options__legend">Показано <?= count($products) ?> товарів з <?= $products_all ?></div>
                                <div class="view-options__divider"></div>
                            </div>
                        </div>
                        <div class="products-view__list products-list" data-layout="grid-4-full" data-with-features="false" data-mobile-grid-columns="2">
                            <div class="products-list__body">
                                <?php foreach ($products as $product): ?>
                                    <div class="products-list__item">
                                        <div class="product-card product-card--hidden-actions">
                                            <!--                            <button class="product-card__quickview ttp_inf" type="button"-->
                                            <!--                                    aria-label="Info"-->
                                            <!--                                    data-title=" --><?php //echo Product::productParams($products[0]->id) ?><!-- ">-->
                                            <!--                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
                                            <!--                                     class="bi bi-info-circle" viewBox="0 0 16 16">-->
                                            <!--                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>-->
                                            <!--                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>-->
                                            <!--                                </svg>-->
                                            <!--                                <span class="fake-svg-icon"></span>-->
                                            <!--                            </button>-->
                                            <?php if (isset($product->label)): ?>
                                                <div class="product-card__badges-list">
                                                    <div class="product-card__badge product-card__badge--new"><?= $product->label->name ?></div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="product-card__image product-image">
                                                <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>" class="product-image__body">
                                                    <img class="product-image__img" src="<?= $product->getImgOneExtraLarge($product->getId()) ?>" alt="<?= $product->name ?>">
                                                </a>
                                            </div>
                                            <div class="product-card__info">
                                                <div class="product-card__name">
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
                                                        <?= $this->render('@frontend/widgets/views/status.php', ['product' => $product]) ?>
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
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div style="display: block;margin: 60px 0px 0px 0px;">
                            <ul class="pagination justify-content-center">
                                <li>
                                    <?= LinkPager::widget(['pagination' => $pages,]) ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- site__body / end -->

<?= $this->render('@frontend/widgets/views/info-params.php') ?>


