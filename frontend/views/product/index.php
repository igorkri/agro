<?php

use common\models\shop\ProductProperties;
use frontend\widgets\ProductsCarousel;
use frontend\widgets\RelatedProducts;
use common\models\shop\ProductImage;
use common\models\shop\ActivePages;
use frontend\widgets\ViewProduct;
use common\models\shop\Product;
use common\models\shop\Review;
use common\models\shop\Brand;
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

ActivePages::setActiveUser();

$webp_support = ProductImage::imageWebp();

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
                                    <?php foreach ($images as $image) : ?>
                                    <?php if ($webp_support == true && isset($image->webp_extra_extra_large)){ ?>
                                    <div class="product-image product-image--location--gallery">
                                        <div class="product-card__badges-list">
                                            <?php if (isset($product->label->name)) : ?>
                                                <div class="product-card__badge product-card__badge--sale"><?= $product->label->name ?></div>
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
                            </div>
                            <hr>
                            <div class="tags tags--lg">
                                <div class="tags__list">
                                    <?php foreach ($product->tags as $brand): ?>
                                        <a href="<?= Url::to(['tag/view', 'id' => $brand->id]) ?>"><?= $brand->name ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="product__info">
                            <div class="product__wishlist-compare">
                                <button type="button"
                                        class="btn btn-sm btn-light btn-svg-icon"
                                        aria-label="add wish list"
                                        id="add-from-wish-btn"
                                        data-wish-product-id="<?= $product->id ?>">
                                    <svg width="16px" height="16px">
                                        <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                    </svg>
                                </button>
                                <button type="button"
                                        class="btn btn-sm btn-light btn-svg-icon"
                                        aria-label="add compare list"
                                        id="add-from-compare-btn"
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
                            <div class="product__description">
                                <?php if ($product_properties != null) { ?>
                                    <?php foreach ($product_properties as $property): ?>
                                        <?php if ($property->value && $property->value != '*'): ?>
                                            <div class="spec__row">
                                                <div class="spec__name"><?= $property->properties ?></div>
                                                <div class="spec__value"><?= $property->value ?></div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php } else { ?>
                                    <div class="spec__row">
                                        <div class="spec__name">- - -</div>
                                        <div class="spec__value">- - -</div>
                                    </div>
                                    <div class="spec__row">
                                        <div class="spec__name">- - -</div>
                                        <div class="spec__value">- - -</div>
                                    </div>
                                    <div class="spec__row">
                                        <div class="spec__name">- - -</div>
                                        <div class="spec__value">- - -</div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="product__sidebar">
                            <div class="product__availability">
                                <span class="text-success" style="font-size: 1.5rem; font-weight: 600; margin-left: 7px">
                                <?php
                                $statusIcon = '';
                                $statusStyle = '';

                                switch ($product->status_id) {
                                    case 1:
                                        $statusIcon = '<i style="font-size:1.5rem; margin: 5px;" class="fas fa-check"></i>';
                                        $statusStyle = '';
                                        break;
                                    case 2:
                                        $statusIcon = '<i style="font-size:1.5rem; margin: 5px; color: #ff0000;" class="fas fa-ban"></i>';
                                        $statusStyle = 'color: #ff0000; font-weight: 600; letter-spacing: 0.6px;';
                                        break;
                                    case 3:
                                        $statusIcon = '<i style="font-size:1.5rem; margin: 5px; color: #ff8300;" class="fas fa-truck"></i>';
                                        $statusStyle = 'color: #ff8300; font-weight: 600; letter-spacing: 0.6px;';
                                        break;
                                    case 4:
                                        $statusIcon = '<i style="font-size:1.5rem; margin: 5px; color: #0331fc;" class="fa fa-bars"></i>';
                                        $statusStyle = 'color: #0331fc; font-weight: 600; letter-spacing: 0.6px;';
                                        break;
                                    default:
                                        $statusStyle = 'color: #060505; font-weight: 600; letter-spacing: 0.6px;';
                                        break;
                                }

                                echo $statusIcon . '<span style="' . $statusStyle . '">' . $product->status->name . '</span>';
                                ?>
                                </span>
                            </div>
                            <div class="product__prices" style="margin-left: 14px">
                                <?php $price = Yii::$app->formatter->asCurrency($product->getPrice()) ?>
                                <?php if ($product->old_price == null) { ?>
                                    <div class="product-card__prices">
                                        <?= $price ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="product-card__prices">
                                        <span class="product-card__new-price"><?= $price ?></span>
                                        <span class="product-card__old-price"><?= Yii::$app->formatter->asCurrency($product->getOldPrice()) ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="product__options">
                                <div class="form-group product__option">
                                    <div class="product__actions">
                                        <div class="product__actions-item product__actions-item--addtocart">
                                            <?php if ($product->status_id != 2) { ?>
                                                <button class="btn btn-primary btn-lg product-card__addtocart"
                                                        aria-label="В кошик"
                                                        type="button"
                                                        data-product-id="<?= $product->id ?>">
                                                    <svg width="20px" height="20px" style="display: unset;">
                                                        <use xlink:href="/images/sprite.svg#cart-20"></use>
                                                    </svg>
                                                    <?= !$isset_to_cart ? 'Купити' : 'В кошику' ?>
                                                </button>
                                            <?php } else { ?>
                                                <button class="btn btn-primary disabled"
                                                        type="button"
                                                        data-product-id="">
                                                    <svg width="20px" height="20px" style="display: unset;">
                                                        <use xlink:href="/images/sprite.svg#cart-20"></use>
                                                    </svg>
                                                    <?= !$isset_to_cart ? 'Купити' : 'В кошику' ?>
                                                </button>
                                            <?php } ?>
                                        </div>

                                        <div class="product__actions-item product__actions-item--wishlist">
                                        <button type="button"
                                                class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                                aria-label="add wish list"
                                                id="add-from-wish-btn"
                                                data-wish-product-id="<?= $product->id ?>">
                                            <svg width="32px" height="32px">
                                                <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                            </svg>
                                        </button>
                                        </div>
                                        <div class="product__actions-item product__actions-item--compare">
                                        <button type="button"
                                                class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                                aria-label="add compare list"
                                                id="add-from-compare-btn"
                                                data-compare-product-id="<?= $product->id ?>">
                                            <svg width="32px" height="32px">
                                                <use xlink:href="/images/sprite.svg#compare-16"></use>
                                            </svg>
                                        </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-methods">
                                <ul class="payment-methods__list">
                                    <li class="payment-methods__item payment-methods__item--active">
                                        <label class="payment-methods__item-header">
                                        <span class="payment-methods__item-radio input-radio">
                                            <span class="input-radio__body">
                                                <input class="input-radio__input" name="checkout_payment_method"
                                                       value="" type="radio" checked="">
                                                <span class="input-radio__circle"></span>
                                            </span>
                                        </span>
                                            <span class="delivery-methods__item-name"><i style="font-size: 25px"
                                                                                         class="fas fa-qrcode"></i>
                                            <span style="font-size:20px; margin:0 20px">Артикул</span></span>
                                        </label>
                                        <div class="payment-methods__item-container" style="">
                                            <div class="payment-methods__item-description text-muted"
                                                 style="text-align: center;">
                                                <b><?= $product->sku ?></b>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="payment-methods__item">
                                        <label class="payment-methods__item-header">
                                        <span class="payment-methods__item-radio input-radio">
                                            <span class="input-radio__body">
                                                <input class="input-radio__input" name="checkout_payment_method"
                                                       value="" type="radio">
                                                <span class="input-radio__circle"></span>
                                            </span>
                                        </span>
                                            <span class="delivery-methods__item-name"><i style="font-size: 25px"
                                                                                         class="fas fa-truck"></i>
                                            <span style="font-size:20px; margin:0 20px">Доставка</span></span>
                                        </label>
                                        <div class="payment-methods__item-container" style="">
                                            <div class="payment-methods__item-description text-muted">
                                                <b>Новая почта</b>
                                                <ul>
                                                    <li>
                                                        Вартість доставки по тарифу <a
                                                                href="https://novaposhta.ua/ru/basic_tariffs"
                                                                target="_bank">перевізника</a>
                                                    </li>
                                                    <li>
                                                        Самовивіз
                                                    </li>
                                                    <li>
                                                        Відвантаження з Полтави
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="payment-methods__item">
                                        <label class="payment-methods__item-header">
                                        <span class="payment-methods__item-radio input-radio">
                                            <span class="input-radio__body">
                                                <input class="input-radio__input" name="checkout_payment_method"
                                                       value="beznal" type="radio">
                                                <span class="input-radio__circle"></span>
                                            </span>
                                        </span>
                                            <span class="payment-methods__item-name"><i style="font-size: 25px"
                                                                                        class="fas fa-credit-card"></i> <span
                                                        style="font-size:20px; margin:0 20px">Оплата</span></span>
                                        </label>
                                        <div class="payment-methods__item-container" style="">
                                            <div class="payment-methods__item-description text-muted">
                                                <ul>
                                                    <li>Visa/Mastercard</li>
                                                    <li>Оплатити готівкою</li>
                                                    <li>Наложенний платіж</li>
                                                    <li>Розрахунковий рахунок</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="payment-methods__item">
                                        <label class="payment-methods__item-header">
                                        <span class="payment-methods__item-radio input-radio">
                                            <span class="input-radio__body">
                                                <input class="input-radio__input" name="checkout_payment_method"
                                                       value="online" type="radio">
                                                <span class="input-radio__circle"></span>
                                            </span>
                                        </span>
                                            <span class="shield-methods__item-name"><i style="font-size: 25px"
                                                                                       class="fas fa-shield-alt"></i> <span
                                                        style="font-size:20px; margin:0 12px">
                                                    Повернення</span></span>
                                        </label>
                                        <div class="payment-methods__item-container" style="">
                                            <div class="payment-methods__item-description text-muted">
                                                <a target="_blank" href="<?= Url::to(['/order/conditions']) ?>"> Умови
                                                    повернення та обміну</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <?php if (!Yii::$app->devicedetect->isMobile()):?>
                                <div>
                                    <?php if ($product->brand_id != null): ?>
                                        <img src="/brand/<?= $img_brand->file ?>"
                                             width="330" height="54"
                                             alt="<?= $img_brand->name ?>"
                                             loading="lazy"
                                             style="width: 100%; margin-top: 10px;">
                                    <?php endif; ?>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
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
        </div>
    </div>
    <?php echo RelatedProducts::widget(['package' => $product->package,]) ?>
    <?php echo ProductsCarousel::widget() ?>
    <?php echo ViewProduct::widget(['id' => $product->id,]) ?>
</div>

<style>
    .category-prefix {
        color: #a9a8a8;
    }
</style>

<?php
$js = <<<JS
$( document ).ready(function() {

      $('table').each(function() {
              $( this ).addClass( "table table-bordered table-responsive" );
      });
});

JS;
$this->registerJs($js);
?>
