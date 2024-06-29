<?php

use common\models\shop\ActivePages;
use frontend\assets\CategoryListPageAsset;
use yii\helpers\Url;

/** @var \common\models\shop\Product $categories */

CategoryListPageAsset::register($this);
ActivePages::setActiveUser();

?>
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/"> <i class="fas fa-home"></i> <?=Yii::t('app','Головна')?></a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?=Yii::t('app','Категорії')?></li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1><?=Yii::t('app','Категорії')?></h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="block">
                    <div class="products-view">
                        <div class="products-view__list products-list" data-layout="grid-4-full"
                             data-with-features="false" data-mobile-grid-columns="2">
                            <div class="products-list__body">
                                <?php foreach ($categories as $category): ?>
                                    <div class="products-list__item">
                                        <div class="product-card ">
                                            <div class="product-card__image product-image">
                                                <?php if (empty($category->products)): ?>
                                                <a href="<?= Url::to(['category/children', 'slug' => $category->slug]) ?>"
                                                   class="product-image__body">
                                                    <?php else: ?>
                                                    <a href="<?= Url::to(['category/catalog', 'slug' => $category->slug]) ?>"
                                                       class="product-image__body">
                                                        <?php endif; ?>
                                                        <img class="product-image__img"
                                                             src="/category/<?= $category->file ?>"
                                                             width="231" height="231"
                                                             alt="<?= $category->name ?>">
                                                    </a>
                                            </div>
                                            <div class="product-card__info">
                                                <div class="product-card__name">
                                                    <?php if (empty($category->products)): ?>
                                                        <a href="<?= Url::to(['category/children', 'slug' => $category->slug]) ?>"><?= $category->name ?></a>
                                                    <?php else: ?>
                                                        <a href="<?= Url::to(['category/catalog', 'slug' => $category->slug]) ?>"><?= $category->name ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="product-card__actions">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="spec__disclaimer">
                                Знаходьте найкращі Захистні Засоби Рослин, Добрива, Посівний Матеріал та Боротьбу з
                                Гризунами в
                                AgroPro – вашому надійному інтернет-магазині для сільського господарства та
                                сільськогосподарських потреб.
                                Оптимізуйте врожаї та збільшуйте врожайність за допомогою наших високоякісних товарів.
                                Доставка та консультації
                                експертів - завжди на вашому боці.
                                Придбайте Фуміганти та Родентициди для боротьби з шкідниками, а також найкращі Добрива
                                та Посівний Матеріал
                                для успішного вирощування рослин.
                                Оберіть AgroPro для найкращого відповідного сільськогосподарського рішення!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>