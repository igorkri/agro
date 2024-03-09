<?php

use common\models\shop\ActivePages;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

ActivePages::setActiveUser();

/** @var \common\models\shop\Product $products */
/** @var \common\models\shop\Product $pages */
/** @var \common\models\shop\Product $products_all */

?>
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
                                <div class="view-options__legend">Показано
                                    <?= count($products) ?> товарів
                                    з <?= $products_all ?>
                                </div>
                                <div class="view-options__divider"></div>
                            </div>
                        </div>
                        <div class="products-view__list products-list" data-layout="grid-4-full"
                             data-with-features="false" data-mobile-grid-columns="2">
                            <div class="products-list__body">
                                <?php foreach ($products as $product): ?>
                                    <div class="products-list__item">
                                        <div class="product-card product-card--hidden-actions">
                                            <?php if (isset($product->label)): ?>
                                                <div class="product-card__badges-list">
                                                    <div class="product-card__badge product-card__badge--new"><?= $product->label->name ?></div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="product-card__image product-image">
                                                <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"
                                                   class="product-image__body">
                                                    <img class="product-image__img"
                                                         src="<?= $product->getImgOneExtraLarge($product->getId()) ?>"
                                                         width="231" height="231"
                                                         alt="<?= $product->name ?>">
                                                </a>
                                            </div>
                                            <div class="product-card__info">
                                                <?php if ($product->category->prefix) { ?>
                                                    <div class="product-card__name">
                                                        <?php echo $product->category->prefix ? '<span class="category-prefix">' . $product->category->prefix . '</span>' : '' ?>
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
                                                        <?= $this->render('@frontend/widgets/views/status.php', ['product' => $product]) ?>
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
                                                <?= $this->render('@frontend/widgets/views/add-to-cart-button.php', ['product' => $product]) ?>
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
<style>
    .category-prefix {
        color: #a9a8a8;
    }
</style>
