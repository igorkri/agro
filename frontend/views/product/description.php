<?php

use common\models\shop\Product;
use kartik\rating\StarRating;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\shop\Product $product */

$request = Yii::$app->request;
$currentUrl = $request->absoluteUrl;

$rating = 3;
?>
    <div class="product-tabs  product-tabs--sticky">
        <div class="product-tabs__list">
            <div class="product-tabs__list-body">
                <div class="product-tabs__list-container container">
                    <a href="#tab-description" class="product-tabs__item product-tabs__item--active">Опис</a>
                    <?php if ($products_analog_count != null) { ?>
                        <a href="#tab-analog" class="product-tabs__item">Аналог <span
                                    class="indicator-analog__value"> <?= $products_analog_count ?></span></a>
                    <?php } ?>
                    <a href="#tab-specification" class="product-tabs__item">Специфікація</a>
                    <a href="#tab-reviews" class="product-tabs__item">Відгуки</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="product-tabs__content">
                <div class="product-tabs__pane product-tabs__pane--active" id="tab-description">
                    <div class="typography" id="product-description">
                        <h3 class="spec__header">Опис товару</h3>
                        <div class="short-description"><?= $product->short_description ?></div>
                        <div class="full-description" style="display: none;"><?= $product->description ?></div>
                        <div class="footer-description"
                             style="display: none;"><?= $product->getFooterDescription($product->id) ?></div>
                        <button class="btn btn-secondary" id="show-more-btn">Розгорнути опис >></button>
                        <button class="btn btn-secondary" id="hide-description-btn" style="display: none;">Приховати
                            опис <<
                        </button>
                    </div>
                </div>
                <div class="product-tabs__pane" id="tab-analog">
                    <div class="spec">
                        <h3 class="spec__header">Аналог товару</h3>
                        <?php if ($products_analog) { ?>
                            <div class="block-sidebar__item">
                                <div class="widget">
                                    <div class="widget-products__list">
                                        <?php $i = 1;
                                        foreach ($products_analog as $product_analog): ?>
                                            <?php if (\Yii::$app->devicedetect->isMobile()) { ?>
                                                <div class="widget-products__item">
                                                    <div class="widget-products__image">
                                                        <div class="product-image">
                                                            <a href="<?= Url::to(['product/view', 'slug' => $product_analog->slug]) ?>"
                                                               class="product-image__body">
                                                                <img class="product-image__img"
                                                                     src="<?= $product_analog->getImgOneExtraSmal($product_analog->getId()) ?>"
                                                                     alt="<?= $product_analog->name ?>">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="widget-products__info">
                                                        <div class="widget-products__name" style="font-weight: 550;">
                                                            <a href="<?= Url::to(['product/view', 'slug' => $product_analog->slug]) ?>"><?= $product_analog->name ?></a>
                                                        </div>
                                                        <div class="product-card__rating">
                                                            <div class="product-card__rating-stars">
                                                                <?= $product_analog->getRating($product_analog->id, 13, 12) ?>
                                                            </div>
                                                            <div class="product-card__rating-legend"><?= count($product_analog->reviews) ?>
                                                                відгуків
                                                            </div>
                                                        </div>
                                                        <div class="product-card__availability">
                                                         <span class="text-success">
                                                 <?= $this->render('@frontend/widgets/views/status', ['product' => $product_analog]) ?>
                                                         </span>
                                                        </div>
                                                        <?php if ($product_analog->old_price == null) { ?>
                                                            <div class="widget-products__prices"
                                                                 style="font-size: 15px;">
                                                                <?= Yii::$app->formatter->asCurrency($product_analog->getPrice()) ?>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="widget-products__prices">
                                                                <span class="widget-products__new-price"><?= Yii::$app->formatter->asCurrency($product_analog->getPrice()) ?></span>
                                                                <span class="widget-products__old-price"><?= Yii::$app->formatter->asCurrency($product_analog->getOldPrice()) ?></span>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                        class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                                        aria-label="add wish list"
                                                        id="add-from-wish-btn"
                                                        data-wish-product-id="<?= $product_analog->id ?>">
                                                    <svg width="16px" height="16px">
                                                        <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                        class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                                        aria-label="add compare list"
                                                        id="add-from-compare-btn"
                                                        data-compare-product-id="<?= $product_analog->id ?>">
                                                    <svg width="16px" height="16px">
                                                        <use xlink:href="/images/sprite.svg#compare-16"></use>
                                                    </svg>
                                                </button>
                                                <?php if ($products_analog_count != $i) { ?>
                                                    <hr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <div class="products-view__list products-list" data-layout="list"
                                                     data-with-features="false" data-mobile-grid-columns="2">
                                                    <div class="products-list__body">
                                                        <div class="products-list__item">
                                                            <div class="product-card product-card--hidden-actions ">
                                                                <?php if (isset($products_analog->label)): ?>
                                                                    <div class="product-card__badges-list">
                                                                        <div class="product-card__badge product-card__badge--new"><?= $products_analog->label->name ?></div>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="product-card__image product-image">
                                                                    <a href="<?= Url::to(['product/view', 'slug' => $product_analog->slug]) ?>"
                                                                       class="product-image__body">
                                                                        <img class="product-image__img"
                                                                             src="<?= $product_analog->getImgOneExtraLarge($product_analog->getId()) ?>"
                                                                             alt="<?= $product_analog->name ?>">
                                                                    </a>
                                                                </div>
                                                                <div class="product-card__info">
                                                                    <div class="product-card__name">
                                                                        <a href="<?= Url::to(['product/view', 'slug' => $product_analog->slug]) ?>"><?= $product_analog->name ?></a>
                                                                    </div>
                                                                    <div class="product-card__rating">
                                                                        <div class="product-card__rating-stars">
                                                                            <div class="rating">
                                                                                <div class="rating__body">
                                                                                    <?= $product_analog->getRating($product_analog->id, 13, 12) ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-card__rating-legend"><?= count($product_analog->reviews) ?>
                                                                            відгуків
                                                                        </div>
                                                                    </div>
                                                                    <ul class="product-card__features-list">
                                                                        <?= Product::productParamsList($product_analog->id) ?>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-card__actions">
                                                                    <div class="product-card__availability">
                                                                     <span class="text-success">
                                                                        <?= $this->render('@frontend/widgets/views/status', ['product' => $product_analog]) ?>
                                                                     </span>
                                                                    </div>
                                                                    <?php if ($product_analog->old_price == null) { ?>
                                                                        <div class="product-card__prices">
                                                                            <?= Yii::$app->formatter->asCurrency($product_analog->getPrice()) ?>
                                                                        </div>
                                                                    <?php } else { ?>
                                                                        <div class="product-card__prices">
                                                                            <span class="widget-products__new-price"><?= Yii::$app->formatter->asCurrency($product_analog->getPrice()) ?></span>
                                                                            <span class="widget-products__old-price"><?= Yii::$app->formatter->asCurrency($product_analog->getOldPrice()) ?></span>
                                                                        </div>
                                                                    <?php } ?>

                                                                    <?php if ($product_analog->status_id != 2) { ?>
                                                                        <div class="product-card__buttons">
                                                                            <button class="btn btn-primary product-card__addtocart "
                                                                                    type="button"
                                                                                    data-product-id="<?= $product_analog->id ?>">
                                                                                <svg width="20px" height="20px"
                                                                                     style="display: unset;">
                                                                                    <use xlink:href="/images/sprite.svg#cart-20"></use>
                                                                                </svg>
                                                                                <?= !$product_analog->getIssetToCart($product_analog->id) ? 'В Кошик' : 'В кошику' ?>
                                                                            </button>
                                                                            <button type="button"
                                                                                    class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                                                                    aria-label="add wish list"
                                                                                    id="add-from-wish-btn"
                                                                                    data-wish-product-id="<?= $product_analog->id ?>">
                                                                                <svg width="16px" height="16px">
                                                                                    <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                                                                </svg>
                                                                            </button>
                                                                            <button type="button"
                                                                                    class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                                                                    aria-label="add compare list"
                                                                                    id="add-from-compare-btn"
                                                                                    data-compare-product-id="<?= $product_analog->id ?>">
                                                                                <svg width="16px" height="16px">
                                                                                    <use xlink:href="/images/sprite.svg#compare-16"></use>
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                    <?php } else { ?>
                                                                        <div class="product-card__buttons">
                                                                            <button class="btn btn-secondary disabled"
                                                                                    type="button"
                                                                                    data-product-id="<?= $product_analog->id ?>">
                                                                                <svg width="20px" height="20px"
                                                                                     style="display: unset;">
                                                                                    <use xlink:href="/images/sprite.svg#cart-20"></use>
                                                                                </svg>
                                                                                <?= !$product_analog->getIssetToCart($product_analog->id) ? 'В Кошик' : 'В кошику' ?>
                                                                            </button>
                                                                            <button type="button"
                                                                                    class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                                                                    aria-label="add wish list"
                                                                                    id="add-from-wish-btn"
                                                                                    data-wish-product-id="<?= $product_analog->id ?>">
                                                                                <svg width="16px" height="16px">
                                                                                    <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                                                                </svg>
                                                                            </button>
                                                                            <button type="button"
                                                                                    class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                                                                    aria-label="add compare list"
                                                                                    id="add-from-compare-btn"
                                                                                    data-compare-product-id="<?= $product_analog->id ?>">
                                                                                <svg width="16px" height="16px">
                                                                                    <use xlink:href="/images/sprite.svg#compare-16"></use>
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php $i++; endforeach ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="spec__disclaimer">
                            Інформація про характеристики, комплект поставки, країну виробника та зовнішній
                            вигляд товару є довідковою та базується на актуальній на момент публікації інформації.
                        </div>
                    </div>
                </div>
                <div class="product-tabs__pane" id="tab-specification">
                    <div class="spec">
                        <h3 class="spec__header">Специфікація товару</h3>
                        <div class="spec__section">
                            <h4 class="spec__section-title">Загальна</h4>
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
                        <div class="spec__disclaimer">
                            Інформація про технічні характеристики, комплект поставки, країну виробника та зовнішній
                            вигляд товару є довідковою та базується на актуальній на момент публікації інформації.
                        </div>
                    </div>
                </div>
                <div class="product-tabs__pane" id="tab-reviews">
                    <div class="reviews-view">
                        <div class="reviews-view__list">
                            <h3 class="reviews-view__header">Відгуки покупців</h3>
                            <div class="reviews-list">
                                <ol class="reviews-list__content">
                                    <?php foreach ($product->reviews as $review):
                                        $rating = $review->rating;
                                        ?>
                                        <li class="reviews-list__item">
                                            <div class="review">
                                                <div class="review__avatar"><img
                                                            src="/images/avatars/<?= $review->getAvatar($review->id) ?>.jpg"
                                                            alt=""></div>
                                                <div class="review__content">
                                                    <div class="review__author"><?= $review->name ?></div>
                                                    <div class="review__rating">
                                                        <div class="rating">
                                                            <div class="rating__body">
                                                                <?php if ($rating != 0): ?>
                                                                    <?php for ($i = 1; $i <= $rating; $i++): ?>
                                                                        <svg class="rating__star rating__star--active"
                                                                             width="16px" height="15px">
                                                                            <g class="rating__fill">
                                                                                <use xlink:href="/images/sprite.svg#star-normal"></use>
                                                                            </g>
                                                                            <g class="rating__stroke">
                                                                                <use xlink:href="/images/sprite.svg#star-normal-stroke"></use>
                                                                            </g>
                                                                        </svg>
                                                                        <div class="rating__star rating__star--only-edge rating__star--active">
                                                                            <div class="rating__fill">
                                                                                <div class="fake-svg-icon"></div>
                                                                            </div>
                                                                            <div class="rating__stroke">
                                                                                <div class="fake-svg-icon"></div>
                                                                            </div>
                                                                        </div>
                                                                    <?php endfor; ?>
                                                                    <?php if (5 - $rating != 0): ?>
                                                                        <?php for ($i = 1; $i <= 5 - $rating; $i++): ?>
                                                                            <svg class="rating__star " width="16px"
                                                                                 height="15px">
                                                                                <g class="rating__fill">
                                                                                    <use xlink:href="/images/sprite.svg#star-normal"></use>
                                                                                </g>
                                                                                <g class="rating__stroke">
                                                                                    <use xlink:href="/images/sprite.svg#star-normal-stroke"></use>
                                                                                </g>
                                                                            </svg>
                                                                            <div class="rating__star rating__star--only-edge ">
                                                                                <div class="rating__fill">
                                                                                    <div class="fake-svg-icon"></div>
                                                                                </div>
                                                                                <div class="rating__stroke">
                                                                                    <div class="fake-svg-icon"></div>
                                                                                </div>
                                                                            </div>
                                                                        <?php endfor; ?>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                                        <svg class="rating__star " width="16px"
                                                                             height="15px">
                                                                            <g class="rating__fill">
                                                                                <use xlink:href="/images/sprite.svg#star-normal"></use>
                                                                            </g>
                                                                            <g class="rating__stroke">
                                                                                <use xlink:href="/images/sprite.svg#star-normal-stroke"></use>
                                                                            </g>
                                                                        </svg>
                                                                        <div class="rating__star rating__star--only-edge ">
                                                                            <div class="rating__fill">
                                                                                <div class="fake-svg-icon"></div>
                                                                            </div>
                                                                            <div class="rating__stroke">
                                                                                <div class="fake-svg-icon"></div>
                                                                            </div>
                                                                        </div>
                                                                    <?php endfor; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="review__text"><?= $review->message ?></div>
                                                    <div class="review__date"><?= Yii::$app->formatter->asDate($review->created_at) ?></div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                        </div>
                        <form id="form-review">
                            <h3 class="reviews-view__header">Залишити відгук</h3>
                            <div class="row">
                                <div class="col-12 col-lg-9 col-xl-8">
                                    <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="w0">Ваша оцінка</label>
                                            <?php
                                            echo StarRating::widget([
                                                'name' => 'starrating',
                                                'language' => 'uk',
                                                'value' => 5,
                                                'pluginOptions' => [
                                                    'min' => 0,
                                                    'max' => 5,
                                                    'step' => 1,
                                                    'size' => 'sm',
                                                    'showClear' => false,
                                                    'showCaption' => false,
                                                ],
                                            ]);
                                            ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="review-name">Ваше ім'я</label>
                                            <input type="text" name="name" class="form-control" id="review-name"
                                                   oninvalid="this.setCustomValidity('Укажіть будь ласка Ваше ім’я')"
                                                   oninput="this.setCustomValidity('')"
                                                   placeholder="Ваше ім’я" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="review-email">Email</label>
                                            <input type="text" name="email" class="form-control" id="review-email"
                                                   placeholder="Email"
                                                   oninvalid="this.setCustomValidity('Укажіть будь ласка Ваш email')"
                                                   oninput="this.setCustomValidity('')"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="review-text">Ваш відгук</label>
                                        <textarea class="form-control" name="message" id="review-text"
                                                  rows="6"
                                                  oninvalid="this.setCustomValidity('Напишіть будь ласка Ваш відгук')"
                                                  oninput="this.setCustomValidity('')"
                                                  required></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" id="review-form-submit" class="btn btn-primary btn-lg">
                                            Залишити відгук
                                        </button>
                                        <div class="alert alert-success" style="display: none;" id="success-message"
                                             role="alert">
                                            Вітаемо Ваш відгук -- надіслано !!!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="additional-text" style="display: none;">Детальніше на: <?= $currentUrl ?></div>
    <style>
        .rating-md {
            font-size: 22px;
        }

        .indicator-analog__value {
            height: 15px;
            font-size: 16px;
            padding: 0 5px;
            border-radius: 1000px;
            position: relative;
            top: -5px;
            background: #fbe720;
            color: #3d464d;
            font-weight: 700;
        }

        #success-message {
            position: absolute;
            top: -24%;
            left: 15px;
            width: 95%;
        }

        #form-review {
            position: relative;
        }
    </style>

<?php
$js = <<<JS
     $('#review-form-submit').click(function(event) {
        event.preventDefault();
     var productId = $('input[name=product_id]').val();
     var star = $('input[name=starrating]').val();
     var name = $('input[name=name]').val();
     var email = $('input[name=email]').val();
     var mess = $('textarea[name=message]').val();
     if(name != ''){
     $.ajax({
         url: '/review/create',
         type: 'post',
         data: {
             id: productId,
             rating: star,
             name: name,
             email: email,
             mess: mess
             },
         success: function(data){
             $('#form-review')[0].reset();
              $('#success-message').fadeIn(); // Показать сообщение
    setTimeout(function() {
        $('#success-message').fadeOut(); // Скрыть сообщение после 2 секунд
    }, 2500);
             $('.reviews-list__content').html(data);
         },
         error: function(data){
             console.log("error",data) 
         }
     });
      }    
     return false;
});

   document.addEventListener('copy', function(e) {
    var selectedText = window.getSelection().toString();
    var additionalText = document.getElementById('additional-text').innerText;
    if (selectedText && additionalText) {
        var copiedText = selectedText + ' ' + additionalText;
        e.clipboardData.setData('text/plain', copiedText);
        e.preventDefault();
    }
});
   
   $(document).ready(function () {
        var fullDescription = $('.full-description');
        var footerDescription = $('.footer-description');
        var showMoreBtn = $('#show-more-btn');
        var hideDescriptionBtn = $('#hide-description-btn');

        fullDescription.hide();
        footerDescription.hide();

        showMoreBtn.click(function () {
            fullDescription.fadeIn();
            footerDescription.fadeIn();
             hideDescriptionBtn.show();
            showMoreBtn.hide();
        });
        hideDescriptionBtn.click(function () {
            fullDescription.fadeOut();
            footerDescription.fadeOut();
            hideDescriptionBtn.hide();
            showMoreBtn.show();
        });
    });

JS;
$this->registerJs($js);

?>