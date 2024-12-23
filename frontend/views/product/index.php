<?php

use common\models\shop\ProductProperties;
use frontend\assets\ProductPageAsset;
use frontend\widgets\RelatedProducts;
use common\models\shop\ProductImage;
use common\models\shop\ActivePages;
use frontend\widgets\ViewProduct;
use common\models\shop\Product;
use common\models\shop\Review;
use common\models\shop\Brand;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var ProductProperties $product_properties */
/** @var Product $products_analog_count */
/** @var Product $products_analog */
/** @var Product $isset_to_cart */
/** @var Review $model_review */
/** @var yii\web\View $this */
/** @var Product $products */
/** @var Product $product */
/** @var Brand $img_brand */
/** @var Product $images */

ProductPageAsset::register($this);
ActivePages::setActiveUser();

$language = Yii::$app->session->get('_language');

$mobile = Yii::$app->devicedetect->isMobile();

$webp_support = ProductImage::imageWebp();

?>
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-anim">
                        <li class="breadcrumb-item">
                            <a href="/"> <i class="fas fa-home"></i> <?= Yii::t('app', 'Головна') ?> </a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= Url::to(['category/list']) ?>"><?= Yii::t('app', 'Категорії') ?></a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <?php if (isset($product->category->parent)): ?>
                            <li class="breadcrumb-item">
                                <a href="<?= Url::to(['category/children', 'slug' => $product->category->parent->slug]) ?>"><?= $product->category->parent->name ?></a>
                                <svg class="breadcrumb-arrow" width="6px" height="9px">
                                    <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                </svg>
                            </li>
                        <?php endif; ?>
                        <li class="breadcrumb-item">
                            <a href="<?= Url::to(['category/catalog', 'slug' => $product->category->slug]) ?>"><?= $product->category->name ?></a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $product->name ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="container">
            <div class="product product--layout--columnar" data-layout="columnar">
                <div class="product__content">
                    <div class="product__gallery">
                        <div class="product-gallery">
                            <?php if (!empty($product->images)) : ?>
                            <div class="product-gallery__featured">
                                <button class="product-gallery__zoom" aria-label="Збільшити">
                                    <svg width="24px" height="24px">
                                        <use xlink:href="/images/sprite.svg#zoom-in-24"></use>
                                    </svg>
                                </button>
                                <div class="owl-carousel" id="product-image">
                                    <?php foreach ($images

                                    as $image) : ?>
                                    <?php if ($webp_support == true && isset($image->webp_extra_extra_large)){ ?>
                                    <div class="product-image product-image--location--gallery">
                                        <div class="product-card__badges-list">
                                            <?php if (isset($product->label->name)) : ?>
                                                <div class="product-card__badge product-card__badge--sale"
                                                     style="background: <?= Html::encode($product->label->color) ?>;">
                                                    <?= $product->label->name ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($products_analog_count > 0) : ?>
                                                <div class="product-card__badge product-card__badge--analog"><?= Yii::t('app', 'Є аналоги') . ' ' . $products_analog_count ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <a href="<?= '/product/' . $image->webp_name ?>" data-width="700"
                                           data-height="700" class="product-image__body" target="_blank">
                                            <img class="product-image__img"
                                                 src=" <?= '/product/' . $image->webp_extra_extra_large ?> "
                                                 width="336" height="336"
                                                 alt="<?= $product->name ?>">
                                            <?php }else{ ?>
                                            <div class="product-image product-image--location--gallery">
                                                <div class="product-card__badges-list">
                                                    <?php if (isset($product->label->name)) : ?>
                                                        <div class="product-card__badge product-card__badge--new"><?= $product->label->name ?></div>
                                                    <?php endif; ?>
                                                </div>
                                                <a href="<?= '/product/' . $image->name ?>" data-width="700"
                                                   data-height="700" class="product-image__body" target="_blank">
                                                    <img class="product-image__img"
                                                         src=" <?= '/product/' . $image->extra_extra_large ?> "
                                                         width="336" height="336"
                                                         alt="<?= $product->name ?>">
                                                    <?php } ?>
                                                </a>
                                            </div>
                                            <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (!$mobile): ?>
                                    <?php if ($this->beginCache('tags-product_' . $language . $product->id, ['duration' => 3600])): ?>
                                        <?= $this->render('tags', [
                                            'product' => $product,
                                            'language' => $language,
                                        ]) ?>
                                        <?php $this->endCache() ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="product__info">
                            <div class="product__wishlist-compare">
                                <button type="button"
                                        class="btn btn-sm btn-light btn-svg-icon product-card__wish"
                                        aria-label="add wish list"
                                        id="add-from-wish-btn-<?= $product->id ?>"
                                        data-url-wish="<?= Yii::$app->urlManager->createUrl(['wish/add-to-wish']) ?>"
                                        data-wish-product-id="<?= $product->id ?>">
                                    <svg width="16px" height="16px">
                                        <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                    </svg>
                                </button>
                                <button type="button"
                                        class="btn btn-sm btn-light btn-svg-icon product-card__compare"
                                        aria-label="add compare list"
                                        id="add-from-compare-btn-<?= $product->id ?>"
                                        data-url-compare="<?= Yii::$app->urlManager->createUrl(['compare/add-to-compare']) ?>"
                                        data-compare-product-id="<?= $product->id ?>">
                                    <svg width="16px" height="16px">
                                        <use xlink:href="/images/sprite.svg#compare-16"></use>
                                    </svg>
                                </button>
                            </div>
                            <?php if ($product->category->prefix) { ?>
                                <h1 class="product__name">
                                    <?= $product->category->prefix ? '<span class="category-prefix">' . $product->category->prefix . '</span>' : '' ?>
                                    <?= $product->name ?>
                                </h1>
                            <?php } else { ?>
                                <h1 class="product__name"><?= $product->name ?></h1>
                            <?php } ?>
                            <div class="product__rating">
                                <div class="product__rating-stars">
                                    <?= $product->getRating($product->id) ?>
                                </div>
                                <div class="product__rating-legend">
                                    <?= $product->getRatingCount($product->id) ?>
                                </div>
                            </div>
                            <?php if (!$mobile): ?>
                                <?php if ($this->beginCache('product_properties-product_' . $language . $product->id, ['duration' => 3600])): ?>
                                <?= $this->render('properties', ['product_properties' => $product_properties]) ?>
                                    <?php $this->endCache() ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?= $this->render('sidebar', [
                            'mobile' => $mobile,
                            'product' => $product,
                            'img_brand' => $img_brand,
                            'isset_to_cart' => $isset_to_cart,
                            'products_analog' => $products_analog,
                            'products_analog_count' => $products_analog_count,
                        ]) ?>
                    </div>
                </div>
            </div>
            <?= $this->render('description', [
                'product' => $product,
                'product_properties' => $product_properties,
                'model_review' => $model_review,
                'products_analog' => $products_analog,
                'products_analog_count' => $products_analog_count,
            ]) ?>
            <?php if ($mobile): ?>
                <?php if ($this->beginCache('tags-product-mobile_' . $language . $product->id, ['duration' => 3600])): ?>
                    <div style="margin-left: 15px;">
                        <?= $this->render('tags', [
                            'product' => $product,
                            'language' => $language,
                        ]) ?>
                    </div>
                    <?php $this->endCache() ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php if (!$mobile): ?>
        <?php if ($this->beginCache('related-product_' . $language, ['duration' => 3600])): ?>
            <?php echo RelatedProducts::widget(['package' => $product->package,]) ?>
            <?php $this->endCache() ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($mobile): ?>
        <div class="container">
            <?= $this->render('info-accordion', [
                'product' => $product,
                'mobile' => $mobile,
                'img_brand' => $img_brand,
            ]) ?>
        </div>
    <?php endif; ?>
    <?php echo ViewProduct::widget(['id' => $product->id,]) ?>
</div>
<?= $this->render('@frontend/views/layouts/photoswipe.php') ?>
<style>
    .category-prefix {
        color: #a9a8a8;
    }

    .product-card__badge--analog {
        background: #fbe720;
        color: #3d464d;
        font-weight: 600;
    }

    .breadcrumb-anim a {
        position: relative;
        text-decoration: none;
        color: #01080e;
        display: inline-block;
    }

    .breadcrumb-anim a::before,
    .breadcrumb-anim a::after {
        content: '';
        position: absolute;
        transition: transform .5s ease;
        left: -4px;
        top: 0;
        width: calc(100% + 8px);
        height: 100%;
        border-style: solid;
        border-color: #47991f;
        box-sizing: border-box;
    }

    .breadcrumb-anim a::before {
        border-width: 1px 0 1px 0;
        transform: scaleX(0);
    }

    .breadcrumb-anim a::after {
        border-width: 0 1px 0 1px;
        transform: scaleY(0);
    }

    .breadcrumb-anim a:hover::before,
    .breadcrumb-anim a:hover::after {
        transform: scale(1, 1);
    }
</style>