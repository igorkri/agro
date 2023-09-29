<?php

use common\models\shop\Product;
use frontend\widgets\FilterProductList;
use frontend\widgets\LatestProduct;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

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
                        <li class="breadcrumb-item">
                            <a href="<?= Url::to(['category/list']) ?>">Категорії</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <?php if (isset($category->parent)): ?>
                            <li class="breadcrumb-item">
                                <a href="<?= Url::to(['category/children', 'slug' => $category->parent->slug]) ?>"><?= $category->parent->name ?></a>
                                <svg class="breadcrumb-arrow" width="6px" height="9px">
                                    <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                </svg>
                            </li>
                        <?php endif; ?>
                        <li class="breadcrumb-item active" aria-current="page"><?= $category->name ?></li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1><?= $category->name ?></h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="shop-layout shop-layout--sidebar--start">
            <div class="shop-layout__sidebar">
                <div class="block block-sidebar block-sidebar--offcanvas--mobile">
                    <div class="block-sidebar__backdrop"></div>
                    <div class="block-sidebar__body">
                        <div class="block-sidebar__header">
                            <div class="block-sidebar__title">Фільтр</div>
                            <button class="block-sidebar__close" type="button">
                                <svg width="20px" height="20px">
                                    <use xlink:href="/images/sprite.svg#cross-20"></use>
                                </svg>
                            </button>
                        </div>
                        <?php echo FilterProductList::widget() ?>
                        <?php echo LatestProduct::widget() ?>
                    </div>
                </div>
            </div>
            <div class="shop-layout__content">
                <div class="block">
                    <div class="products-view">
                        <div class="products-view__options">
                            <div class="view-options view-options--offcanvas--mobile">
                                <div class="view-options__filters-button">
                                    <button type="button" class="filters-button">
                                        <svg class="filters-button__icon" width="16px" height="16px">
                                            <use xlink:href="/images/sprite.svg#filters-16"></use>
                                        </svg>
                                        <span class="filters-button__title">Фільтер</span>
                                        <span class="filters-button__counter">3</span>
                                    </button>
                                </div>
                                <div class="view-options__layout">
                                    <div class="layout-switcher">
                                        <div class="layout-switcher__list">
                                            <button data-layout="grid-3-sidebar" data-with-features="false" title="Grid"
                                                    type="button"
                                                    class="layout-switcher__button  layout-switcher__button--active ">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="/images/sprite.svg#layout-grid-16x16"></use>
                                                </svg>
                                            </button>
<!--                                            <button data-layout="grid-3-sidebar" data-with-features="true"-->
<!--                                                    title="Grid With Features" type="button"-->
<!--                                                    class="layout-switcher__button ">-->
<!--                                                <svg width="16px" height="16px">-->
<!--                                                    <use xlink:href="/images/sprite.svg#layout-grid-with-details-16x16"></use>-->
<!--                                                </svg>-->
<!--                                            </button>-->
                                            <button data-layout="list" data-with-features="false" title="List"
                                                    type="button" class="layout-switcher__button ">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="/images/sprite.svg#layout-list-16x16"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-options__legend">Показано <b><?= count($products) ?></b> товарів
                                    з <b><?= $products_all ?></b></div>
                                <div class="view-options__divider"></div>
                                <div class="view-options__control">
                                    <label for="">Сортувати</label>
                                    <div>
                                        <select class="form-control form-control-sm" name="" id="">
                                            <option value="">Default</option>
                                            <option value="">Name (A-Z)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="view-options__control">
                                    <label for="">Показувати</label>
                                    <div>
                                        <select class="form-control form-control-sm" name="" id="">
                                            <option value="">12</option>
                                            <option value="">24</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="products-view__list products-list" data-layout="grid-3-sidebar"
                             data-with-features="false" data-mobile-grid-columns="2">
                            <div class="products-list__body">
                                <?php foreach ($products as $product): ?>
                                    <div class="products-list__item">
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
                                                         src="<?= $product->getImgOneExtraLarge($product->getId()) ?>"
                                                         alt="<?= $product->name ?>">
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
                                                <ul class="product-card__features-list">
                                                    <?= Product::productParamsList($product->id) ?>
                                                </ul>
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
                        <div class="spec__disclaimer">
                            <?= $category->description ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>