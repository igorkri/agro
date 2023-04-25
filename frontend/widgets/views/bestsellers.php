<?php

use yii\helpers\Url;

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
                        <div class="product-card__badges-list">
                            <div class="product-card__badge product-card__badge--new"><?= $products[0]->label->name ?></div>
                        </div>
                        <div class="product-card__image product-image">
                            <a href="<?= Url::to(['product/view', 'slug' => $products[0]->slug]) ?>"
                               class="product-image__body">
                                <img class="product-image__img" src="<?= $products[0]->getImgOne($products[0]->getId()) ?>"
                                     alt="">
                            </a>
                        </div>
                        <div class="product-card__info">
                            <div class="product-card__name">
                                <a href="<?= Url::to(['product/view', 'slug' => $products[0]->slug]) ?>"><?= $products[0]->name ?></a>
                            </div>
                            <div class="product-card__rating">
                                <div class="product-card__rating-stars">
                                    <?=$products[0]->getRating($products[0]->id, 13, 12)?>
                                </div>
                                <div class="product-card__rating-legend"><?=count($products[0]->reviews)?> відгуків</div>
                            </div>

                        </div>
                        <div class="product-card__actions">
                            <div class="product-card__prices">
                                <?= Yii::$app->formatter->asCurrency($products[0]->getPrice()) ?>
                            </div>
                            <div class="form-group product__option">
                                        <span class="text-success" style="padding: 3px 1px;font-size: 25px;">
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
                            </span>

                            </div>
                            <div class="product-card__buttons">
                                <button class="btn btn-primary product-card__addtocart "
                                        type="button"
                                        data-product-id="<?=$products[0]->id?>">
                                    <?= !$products[0]->getIssetToCart($products[0]->id) ? 'В Кошик' : 'Уже в кошику' ?>
                                </button>
                                <button class="btn btn-secondary product-card__addtocart product-card__addtocart--list"
                                        type="button"
                                        data-product-id="<?=$products[0]->id?>">
                                    <?= !$products[0]->getIssetToCart($products[0]->id) ? 'В Кошик' : 'Уже в кошику' ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-products__list">
                <?php $i=0;?>
                <?php foreach ($products as $product): ?>
                <?php if ($i != 0): ?>
                    <div class="block-products__list-item">
                        <div class="product-card product-card--hidden-actions ">
                            <?php if (isset($product->label)): ?>
                                <div class="product-card__badges-list">
                                    <div class="product-card__badge product-card__badge--hot"><?= $product->label->name ?></div>
                                </div>
                            <?php endif; ?>
                                <div class="product-card__image product-image">
                                    <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"
                                       class="product-image__body">
                                        <img class="product-image__img" src="<?= $product->getImgOne($product->getId()) ?>"
                                             alt="">
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
                                <div class="product-card__prices">
                                    <?= Yii::$app->formatter->asCurrency($product->getPrice()) ?>
                                    <div class="form-group product__option">
                                        <span class="text-success" style="padding: 3px 1px">
                                <?php
                                if ($product->status_id == 1) {
                                    echo '<i style="font-size:1rem; margin: 5px;" class="fas fa-check"></i> ' . $product->status->name;
                                } elseif ($product->status_id == 2) {
                                    echo '<i style="font-size:1rem; color: #ff0000!important; margin: 5px;" class="fas fa-ban"></i> ';
                                    echo "<span style='color: #ff0000 !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                } elseif ($product->status_id == 3) {
                                    echo '<i style="font-size:1rem; color: #ff8300!important; margin: 5px;" class="fas fa-truck"></i> ';
                                    echo "<span style='color: #ff8300 !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                } elseif ($product->status_id == 4) {
                                    echo '<i style="font-size:1rem; color: #0331fc!important; margin: 5px;" class="fa fa-bars"></i> ';
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
                                </div>
                                <div class="product-card__buttons">
                                    <button class="btn btn-primary product-card__addtocart "
                                            type="button"
                                            data-product-id="<?=$product->id?>">
                                        <?= !$product->getIssetToCart($product->id) ? 'В Кошик' : 'Уже в кошику' ?>
                                    </button>
                                    <button class="btn btn-secondary product-card__addtocart product-card__addtocart--list"
                                            type="button"
                                            data-product-id="<?=$product->id?>">
                                        <?= !$product->getIssetToCart($product->id) ? 'В Кошик' : 'Уже в кошику' ?>
                                    </button>
                                </div>
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