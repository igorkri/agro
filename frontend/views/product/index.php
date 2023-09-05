<?php
/** @var yii\web\View $this */
/** @var \common\models\shop\Product $product */
/** @var \common\models\shop\Brand $img_brand */
/** @var \common\models\shop\Product $products */

/** @var \common\models\shop\Review $model_review */

use common\models\shop\ActivePages;
use frontend\widgets\ProductsCarousel;
use yii\helpers\Url;
use frontend\widgets\RelatedProducts;

if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false) {
    $webp_support = true; // webp поддерживается
} else {
    $webp_support = false; // webp не поддерживается
}

ActivePages::setActiveUser();

$this->title = $product->seo_title;

?>

<?php //exit('<pre>'.print_r($isset_to_cart['_quantity'],true).'</pre>'); ?>
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
                                    <?php foreach ($product->images as $image) : ?>
                                    <?php if ($webp_support == true && isset($image->webp_extra_extra_large)){ ?>
                                    <div class="product-image product-image--location--gallery">
                                        <a href="<?= '/product/' . $image->webp_name ?>" data-width="700"
                                           data-height="700" class="product-image__body" target="_blank">
                                            <img class="product-image__img"
                                                 src=" <?= '/product/' . $image->webp_extra_extra_large ?> "
                                                 alt="<?= $product->name ?>">
                                            <?php }else{ ?>
                                            <div class="product-image product-image--location--gallery">
                                                <a href="<?= '/product/' . $image->name ?>" data-width="700"
                                                   data-height="700" class="product-image__body" target="_blank">
                                                    <img class="product-image__img"
                                                         src=" <?= '/product/' . $image->extra_extra_large ?> "
                                                         alt="<?= $product->name ?>">
                                                    <?php } ?>
                                                </a>
                                            </div>
                                            <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="product__info">
                            <h1 class="product__name"><?= $product->name ?></h1>
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
                                        <div class="spec__row">
                                            <div class="spec__name"><?= $property->properties ?></div>
                                            <div class="spec__value"><?= $property->value ?></div>
                                        </div>
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
                            <div class="payment-methods">
                                <div>
                                    <?php if ($product->brand_id != null): ?>
                                        <img src="/frontend/web/brand/<?= $img_brand->file ?>"
                                             alt="<?= $img_brand->name ?>"
                                             style="width: 100%;padding: 0px 0px 5px 0px;"">
                                    <?php endif; ?>
                                </div>
                                <ul class="payment-methods__list">
                                    <li class="payment-methods__item"
                                        style="background: #ffe484;padding: 10px;color: black;">
                                        Артикул: <span style="margin-right: 10px;" id="sku"><?= $product->sku ?> </span>
                                    </li>
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
                                                                                         class="fas fa-truck"></i>
                                            <span style="font-size:20px; margin:0px 20px">Доставка</span></span>
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
                                                        style="font-size:20px; margin:0px 20px">Оплата</span></span>
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
                                                        style="font-size:20px; margin:0px 12px">
                                                    Повернення</span></span>
                                        </label>
                                        <div class="payment-methods__item-container" style="">
                                            <div class="payment-methods__item-description text-muted">
                                                У нашому онлайн-магазині ми надаємо вам можливість повернути будь-який
                                                придбаний товар.
                                                Відповідно до "Закону про захист прав споживачів", протягом перших 14
                                                днів після покупки у нас ви можете здійснити обмін або повернення
                                                товару.
                                                Важливо зазначити, що ми приймаємо на обмін або повернення лише новий
                                                товар, який не має слідів використання і зберігає оригінальну
                                                комплектацію та упаковку.
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product__footer">
                            <div class="product__prices">
                                <div class="tags tags--lg">
                                    <div class="tags__list">
                                        <?php foreach ($product->tags as $brand): ?>
                                            <a href="<?= Url::to(['tag/view', 'id' => $brand->id]) ?>"><?= $brand->name ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group product__option">
                                    <span style="font-size: 18px; font-weight: 100">Наявність: </span>
                                    <span class="text-success" style="padding: 0px 12px">
                                <?php
                                if ($product->status_id == 1) {
                                    echo '<i style="font-size:1.5rem; margin: 5px;" class="fas fa-check"></i> ' . $product->status->name;
                                } elseif ($product->status_id == 2) {
                                    echo '<i style="font-size:1.5rem; color: #ff0000!important; margin: 5px;" class="fas fa-ban"></i> ';
                                    echo "<span style='color: #ff0000 !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                } elseif ($product->status_id == 3) {
                                    echo '<i style="font-size:1.5rem; color: #ff8300!important; margin: 5px;" class="fas fa-truck"></i> ';
                                    echo "<span style='color: #ff8300 !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                } elseif ($product->status_id == 4) {
                                    echo '<i style="font-size:1.5rem; color: #0331fc!important; margin: 5px;" class="fa fa-bars"></i> ';
                                    echo "<span style='color: #0331fc !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                } else {
                                    echo "<span style='color: #060505!important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                }
                                ?>
                            </span>
                                </div>
                                <div class="product__actions">
                                    <span style="margin: 0px 0px 0px 30px;font-size: 18px;font-weight: 100">Ціна: </span>
                                    <?php if ($product->old_price == null) { ?>
                                        <div class="product-card__prices" style="
   margin: 0px 19px;
">
                                            <?= Yii::$app->formatter->asCurrency($product->getPrice()) ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="product-card__prices" style="
   margin: 0px 19px;
">
                                            <span class="product-card__new-price"><?= Yii::$app->formatter->asCurrency($product->getPrice()) ?></span>
                                            <span class="product-card__old-price"><?= Yii::$app->formatter->asCurrency($product->getOldPrice()) ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div style="
                                padding: 0px 0px 10px 90px;
                                ">
                                    <?php if ($product->status_id != 2) { ?>
                                        <button class="btn btn-primary product-card__addtocart"
                                                aria-label="В кошик"
                                                type="button"
                                                data-product-id="<?= $product->id ?>"
                                                style="margin-top: 4px;
                                margin-left: 5px;
                                margin-right: -21px;
                                padding: 9px 39px;
                                height: 47px;">
                                            <svg width="20px" height="20px" style="display: unset;">
                                                <use xlink:href="/images/sprite.svg#cart-20"></use>
                                            </svg>
                                            <?= !$isset_to_cart ? 'В Кошик' : 'Уже в кошику' ?>
                                        </button>
                                    <?php } else { ?>
                                        <button class="btn btn-primary disabled"
                                                type="button"
                                                data-product-id=""
                                                style="margin-top: 4px;
                                margin-left: 5px;
                                margin-right: -21px;
                                padding: 9px 39px;
                                height: 47px;">
                                            <svg width="20px" height="20px" style="display: unset;">
                                                <use xlink:href="/images/sprite.svg#cart-20"></use>
                                            </svg>
                                            <?= !$isset_to_cart ? 'В Кошик' : 'Уже в кошику' ?>
                                        </button>
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->render('description', [
            'product' => $product,
            'product_properties' => $product_properties,
            'model_review' => $model_review
        ]) ?>
    </div>
</div>
<?php echo ProductsCarousel::widget() ?>
<?php echo RelatedProducts::widget() ?>
</div>

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
