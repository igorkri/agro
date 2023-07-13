<?php

use common\models\shop\Product;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var \common\models\shop\Product $products */

?>

    <div class="block block-products block-products--layout--large-first" data-mobile-grid-columns="2">
        <div class="container">
            <div class="block-header">
                <h3 class="block-header__title">Найкращі товари</h3>
                <div class="block-header__divider"></div>
            </div>
            <div class="block-products__body">
                <div class="block-products__featured">
                    <div class="block-products__featured-item">
                        <div class="product-card product-card--hidden-actions ">
                            <button class="product-card__quickview ttp_inf" type="button"
                                    aria-label="Info"
                                    data-title=" <?= Product::productParams($products[0]->id) ?> ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                                <span class="fake-svg-icon"></span>
                            </button>
                            <div class="product-card__badges-list">
                                <?php if (isset($products[0]->label->name)) : ?>
                                    <div class="product-card__badge product-card__badge--new"><?= $products[0]->label->name ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="product-card__image product-image">
                                <a href="<?= Url::to(['product/view', 'slug' => $products[0]->slug]) ?>"
                                   class="product-image__body">
                                    <img class="product-image__img"
                                         src="<?= $products[0]->getImgOneBestBig($products[0]->getId()) ?>"
                                         alt="<?= $products[0]->name ?>">
                                </a>
                            </div>
                            <div class="product-card__info">
                                <div class="product-card__name">
                                    <a href="<?= Url::to(['product/view', 'slug' => $products[0]->slug]) ?>"><?= $products[0]->name ?></a>
                                </div>
                                <div class="product-card__rating">
                                    <div class="product-card__rating-stars">
                                        <?= $products[0]->getRating($products[0]->id, 13, 12) ?>
                                    </div>
                                    <div class="product-card__rating-legend"><?= count($products[0]->reviews) ?>
                                        відгуків
                                    </div>
                                </div>
                            </div>
                            <div class="product-card__actions">
                                <div class="product-card__availability">
                                   <span class="text-success">
                                           <!-- status -->
                                              <?php
                                              if ($products[0]->status_id == 1) {
                                                  echo '<i style="font-size:1rem; margin: 5px;" class="fas fa-check"></i> ' . $products[0]->status->name;
                                              } elseif ($products[0]->status_id == 2) {
                                                  echo '<i style="font-size:1rem; color: #ff0000!important; margin: 5px;" class="fas fa-ban"></i> ';
                                                  echo "<span style='color: #ff0000 !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $products[0]->status->name . " </span>";
                                              } elseif ($products[0]->status_id == 3) {
                                                  echo '<i style="font-size:1rem; color: #ff8300!important; margin: 5px;" class="fas fa-truck"></i> ';
                                                  echo "<span style='color: #ff8300 !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $products[0]->status->name . " </span>";
                                              } elseif ($products[0]->status_id == 4) {
                                                  echo '<i style="font-size:1rem; color: #0331fc!important; margin: 5px;" class="fa fa-bars"></i> ';
                                                  echo "<span style='color: #0331fc !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $products[0]->status->name . " </span>";
                                              } else {
                                                  echo "<span style='color: #060505!important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $products[0]->status->name . " </span>";
                                              }
                                              ?>
                                        <!-- status / end -->
                                        </span>
                                </div>
                                <?php if ($products[0]->old_price == null) { ?>
                                    <div class="product-card__prices">
                                        <?= Yii::$app->formatter->asCurrency($products[0]->getPrice()) ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="product-card__prices">
                                        <span class="product-card__new-price"><?= Yii::$app->formatter->asCurrency($products[0]->getPrice()) ?></span>
                                        <span class="product-card__old-price"><?= Yii::$app->formatter->asCurrency($products[0]->getOldPrice()) ?></span>
                                    </div>
                                <?php } ?>
                                <div class="form-group product__option">
                                        <span class="text-success" style="padding: 3px 1px;font-size: 25px;">

                            </span>
                                </div>
                                <?php if ($products[0]->status_id != 2) { ?>
                                    <div class="product-card__buttons">
                                        <button class="btn btn-primary product-card__addtocart "
                                                type="button"
                                                data-product-id="<?= $products[0]->id ?>">
                                            <svg width="20px" height="20px" style="display: unset;">
                                                <use xlink:href="/images/sprite.svg#cart-20"></use>
                                            </svg>
                                            <?= !$products[0]->getIssetToCart($products[0]->id) ? 'В Кошик' : 'Уже в кошику' ?>
                                        </button>
                                    </div>
                                <?php } else { ?>
                                    <div class="product-card__buttons">
                                        <button class="btn btn-secondary disabled"
                                                type="button"
                                                data-product-id="<?= $products[0]->id ?>">
                                            <svg width="20px" height="20px" style="display: unset;">
                                                <use xlink:href="/images/sprite.svg#cart-20"></use>
                                            </svg>
                                            <?= !$products[0]->getIssetToCart($products[0]->id) ? 'В Кошик' : 'Уже в кошику' ?>
                                        </button>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-products__list">
                    <?php $i = 0; ?>
                    <?php foreach ($products as $product): ?>
                        <?php if ($i != 0): ?>
                            <div class="block-products__list-item">
                                <div class="product-card product-card--hidden-actions ">
                                    <button class="product-card__quickview ttp_inf" type="button"
                                            aria-label="Info"
                                            data-title=" <?= Product::productParams($product->id) ?> ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                        </svg>
                                        <span class="fake-svg-icon"></span>
                                    </button>
                                    <?php if (isset($product->label)): ?>
                                        <div class="product-card__badges-list">
                                            <div class="product-card__badge product-card__badge--hot"><?= $product->label->name ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="product-card__image product-image">
                                        <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"
                                           class="product-image__body">
                                            <img class="product-image__img"
                                                 src="<?= $product->getImgOneFeatured($product->getId()) ?>"
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
                                                <button class="btn btn-secondary product-card__addtocart product-card__addtocart--list"
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
                        <?php endif; ?>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

<?= $this->render('info-params') ?>