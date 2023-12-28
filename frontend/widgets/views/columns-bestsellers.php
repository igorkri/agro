<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\shop\Product $products */

?>
<div class="col-4">
    <div class="block-header">
        <a href="<?= Url::to(['product-list/insektitsidi']) ?>"
        <h3 class="block-header__title">Інсектициди</h3>
        </a>
        <div class="block-header__divider"></div>
    </div>
    <div class="block-product-columns__column">
        <?php foreach ($products
                       as $product): ?>
            <div class="block-product-columns__item">
                <div class="product-card product-card--hidden-actions product-card--layout--horizontal">
                    <?php if (isset($product->label)): ?>
                        <div class="product-card__badges-list">
                            <div class="product-card__badge product-card__badge--hot"><?= $product->label->name ?></div>
                        </div>
                    <?php endif; ?>
                    <div class="product-card__image product-image">
                        <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"
                           class="product-image__body">
                            <img class="product-image__img" src="<?= $product->getImgOneSmall($product->getId()) ?>"
                                 alt="<?= $product->name ?>" loading="lazy">
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
                            <div class="product-card__rating-legend"><?= count($product->reviews) ?> відгуків</div>
                        </div>
                    </div>
                    <div class="product-card__actions">
                        <div class="product-card__availability">
                                  <span class="text-success">
                                        <?= $this->render('status', ['product' => $product]) ?>
                                        </span>
                        </div>
                        <?php if ($product->old_price == null) { ?>
                            <div class="product-card__prices">
                                <?= Yii::$app->formatter->asCurrency($product->getPrice()) ?>
                                <?= Html::a('<svg width="16px" height="16px">
                                                    <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                                </svg>',
                                    ['wish/add-to-wish', 'id' => $product->id],
                                    [
                                        'class' => 'btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare',
                                        'id' => 'add-from-wish-btn',
                                        'data-toggle' => 'tooltip',
                                        'title' => 'Додати в список бажань',
                                        'style' => 'width: 20px; height: 20px; margin-left: 80px;',
                                    ]) ?>
                                <?= Html::a('<svg width="16px" height="16px">
                <use xlink:href="/images/sprite.svg#compare-16"></use>
            </svg>
            <span class="fake-svg-icon fake-svg-icon--compare-16"></span>',
                                    ['compare/add-to-compare', 'id' => $product->id],
                                    [
                                        'class' => 'btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare',
                                        'id' => 'add-from-compare-btn',
                                        'data-toggle' => 'tooltip',
                                        'title' => 'Додати в список порівняння',
                                        'style' => 'width: 20px; height: 20px;', // Установите нужные значения ширины и высоты
                                    ]) ?>
                            </div>
                        <?php } else { ?>
                            <div class="product-card__prices">
                                <span class="product-card__new-price"><?= Yii::$app->formatter->asCurrency($product->getPrice()) ?></span>
                                <span class="product-card__old-price"><?= Yii::$app->formatter->asCurrency($product->getOldPrice()) ?></span>
                                <?= Html::a('<svg width="16px" height="16px">
                                                    <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                                </svg>',
                                    ['wish/add-to-wish', 'id' => $product->id],
                                    [
                                        'class' => 'btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare',
                                        'id' => 'add-from-wish-btn',
                                        'data-toggle' => 'tooltip',
                                        'title' => 'Додати в список бажань',
                                        'style' => 'width: 20px; height: 20px; margin-left: 10px;',
                                    ]) ?>
                                <?= Html::a('<svg width="16px" height="16px">
                <use xlink:href="/images/sprite.svg#compare-16"></use>
            </svg>
            <span class="fake-svg-icon fake-svg-icon--compare-16"></span>',
                                    ['compare/add-to-compare', 'id' => $product->id],
                                    [
                                        'class' => 'btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare',
                                        'id' => 'add-from-compare-btn',
                                        'data-toggle' => 'tooltip',
                                        'title' => 'Додати в список порівняння',
                                        'style' => 'width: 20px; height: 20px;', // Установите нужные значения ширины и высоты
                                    ]) ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>