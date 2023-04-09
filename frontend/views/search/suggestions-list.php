<?php

use yii\helpers\Url;

?>

<!-- site__body -->
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">Головна</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?=Yii::$app->request->get('q')?></li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Знайдено <?php echo count($products) ?> товарів за пошуковим запитом "<?=Yii::$app->request->get('q')?>"</h1>
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

                                <div class="view-options__legend">Знайдено <?php echo count($products) ?> товарів</div>
                                <div class="view-options__divider"></div>
                            </div>
                        </div>
                        <div class="products-view__list products-list" data-layout="grid-4-full" data-with-features="false" data-mobile-grid-columns="2">
                            <div class="products-list__body">
                                <?php foreach ($products as $product): ?>

                                <div class="products-list__item">
                                    <div class="product-card product-card--hidden-actions ">
<!--                                        <div class="product-card__badges-list">-->
                                            <!--                                            <div class="product-card__badge product-card__badge--new">New</div>-->
                                            <!--                                        </div>-->

                                            <div class="product-card__image product-image">
                                            <a href="<?=Url::to(['product/view', 'slug' => $product->slug])?>" class="product-image__body">
                                                <img class="product-image__img" src="<?= $product->getImgOne($product->getId())?>" alt="">
                                            </a>
                                        </div>

                                        <div class="product-card__info">
                                            <div class="product-card__name">
                                                <a href="<?=Url::to(['product/view', 'slug' => $product->slug])?>"><?=$product->name?></a>
                                            </div>
                                        </div>
                                        <div class="product-card__actions">
                                            <div class="product-card__prices">
                                                <?=Yii::$app->formatter->asCurrency($product->getPrice())?>
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
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- site__body / end -->
