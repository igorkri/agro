<?php

use yii\helpers\Url;

/** @var \common\models\shop\Product $products */

?>

<div class="col-4">
    <div class="block-header">
        <h3 class="block-header__title">Фунгіциди</h3>
        <div class="block-header__divider"></div>
    </div>
    <div class="block-product-columns__column">
        <?php foreach ($products as $product): ?>
            <div class="block-product-columns__item">
                <div class="product-card product-card--hidden-actions product-card--layout--horizontal">

                    <?php if (isset($product->label)): ?>
                        <div class="product-card__badges-list">
                            <div class="product-card__badge product-card__badge--sale"><?= $product->label->name ?></div>
                        </div>
                    <?php endif; ?>

                        <div class="product-card__image product-image">
                            <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"
                               class="product-image__body">
                                <img class="product-image__img" src="<?= $product->getImgOne($product->getId()) ?>" alt="">
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
                            <span class="product-card__new-price"><?= Yii::$app->formatter->asCurrency($product->price) ?></span>
                            <span class="product-card__old-price"><?= Yii::$app->formatter->asCurrency($product->old_price) ?></span>
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
        <?php endforeach ?>
    </div>
</div>