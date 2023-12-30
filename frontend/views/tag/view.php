<?php

use common\models\shop\ActivePages;
use common\models\shop\Product;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;

ActivePages::setActiveUser();

/** @var \common\models\shop\Product $products */
/** @var \common\models\shop\Product $pages */

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
                        <li class="breadcrumb-item active" aria-current="page">Продукти запиту</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Продукти запиту  "<?= $tag_name->name ?>"</h1>
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
                                <div class="view-options__layout">
                                    <div class="layout-switcher">
                                        <div class="layout-switcher__list">
                                            <button data-layout="grid-4-full" data-with-features="false" title="Плитка" type="button" class="layout-switcher__button">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="/images/sprite.svg#layout-grid-16x16"></use>
                                                </svg>
                                            </button>
                                            <button data-layout="list" data-with-features="false" title="Список" type="button" class="layout-switcher__button">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="/images/sprite.svg#layout-list-16x16"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-options__legend">Показано <?= count($products) ?> товарів з <?= $products_all ?></div>
                                <div class="view-options__divider"></div>
                                <div class="view-options__control">
                                    <label for="">Сортувати</label>
                                    <div>
                                        <?php
                                        echo \yii\helpers\Html::beginForm(['tag/view'], 'get', ['class' => 'form-inline']);
                                        echo \yii\helpers\Html::dropDownList('sort', Yii::$app->request->get('sort'), [
                                            '' => 'Наявність',
                                            'price_lowest' => 'Дешевші',
                                            'price_highest' => 'Дорожчі',
                                        ], ['class' => 'form-control form-control-sm', 'id' => 'sort-form']);
                                        ?>
                                    </div>
                                </div>
                                <div class="view-options__control">
                                    <label for="">Показати</label>
                                    <div>
                                        <?php
                                        echo \yii\helpers\Html::dropDownList('count', Yii::$app->request->get('count'), [
                                            '12' => '12',
                                            '24' => '24',
                                        ], ['class' => 'form-control form-control-sm', 'id' => 'count-form']);
                                        echo \yii\helpers\Html::hiddenInput('id', $tag_name->id);
                                        echo \yii\helpers\Html::endForm();
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="products-view__list products-list" data-layout="grid-4-full" data-with-features="false" data-mobile-grid-columns="2">
                            <div class="products-list__body">
                                <?php foreach ($products as $product): ?>
                                    <div class="products-list__item">
                                        <div class="product-card product-card--hidden-actions ">
                                            <?php if (isset($product->label)): ?>
                                                <div class="product-card__badges-list">
                                                    <div class="product-card__badge product-card__badge--new"><?= $product->label->name ?></div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="product-card__image product-image">
                                                <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>" class="product-image__body">
                                                    <img class="product-image__img" src="<?= $product->getImgOneExtraLarge($product->getId()) ?>" alt="<?= $product->name ?>">
                                                </a>
                                            </div>
                                            <div class="product-card__info">
                                                <?php if ($product->category->prefix) { ?>
                                                    <div class="product-card__name">
                                                        <?php  echo $product->category->prefix ? '<span class="category-prefix">' . $product->category->prefix . '</span>' : '' ?>
                                                    </div>
                                                <?php } ?>
                                                <div class="product-card__name">
                                                    <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"><?= $product->name ?></a>
                                                </div>
                                                <div class="product-card__rating">
                                                    <div class="product-card__rating-stars">
                                                        <?=$product->getRating($product->id, 13, 12)?>
                                                    </div>
                                                    <div class="product-card__rating-legend"><?=count($product->reviews)?> відгуків</div>
                                                </div>
                                                <ul class="product-card__features-list">
                                                    <?= Product::productParamsList($product->id) ?>
                                                </ul>
                                            </div>
                                            <div class="product-card__actions">
                                                <div class="product-card__availability">
                                                    <span class="text-success">
                                                        <?= $this->render('@frontend/widgets/views/status.php', ['product' => $product]) ?>
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
                                                            <?= !$product->getIssetToCart($product->id) ? 'В Кошик' : 'В кошику' ?>
                                                        </button>
                                                        <?= Html::a('<svg width="16px" height="16px">
                                                    <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                                </svg>',
                                                            ['wish/add-to-wish', 'id' => $product->id],
                                                            [
                                                                'class' => 'btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare',
                                                                'id' => 'add-from-wish-btn',
                                                                'data-toggle' => 'tooltip',
                                                                'title' => 'Додати в список бажань',
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
                                                            ]) ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="product-card__buttons">
                                                        <button class="btn btn-secondary disabled"
                                                                type="button"
                                                                data-product-id="<?= $product->id ?>">
                                                            <svg width="20px" height="20px" style="display: unset;">
                                                                <use xlink:href="/images/sprite.svg#cart-20"></use>
                                                            </svg>
                                                            <?= !$product->getIssetToCart($product->id) ? 'В Кошик' : 'В кошику' ?>
                                                        </button>
                                                        <?= Html::a('<svg width="16px" height="16px">
                                                    <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                                </svg>',
                                                            ['wish/add-to-wish', 'id' => $product->id],
                                                            [
                                                                'class' => 'btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare',
                                                                'id' => 'add-from-wish-btn',
                                                                'data-toggle' => 'tooltip',
                                                                'title' => 'Додати в список бажань',
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
                                                            ]) ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div style="display: block;margin: 60px 0px 0px 0px;">
                            <ul class="pagination justify-content-center">
                                <li>
                                    <?= LinkPager::widget(['pagination' => $pages,]) ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .category-prefix {
        color: #a9a8a8;
    }
</style>

<?php
$script = <<< JS

$(document).ready(function () {
    $('#sort-form, #count-form').change(function () {
        console.log('Select changed!');
        this.form.submit();
    });
});


$(function () {
    // Загрузка предыдущего выбранного макета из localStorage при загрузке страницы
    const savedLayout = localStorage.getItem('selectedLayout');
    if (savedLayout) {
        const productsList = $('.products-view .products-list');
        
        // Установка предыдущего выбранного макета
        productsList.attr('data-layout', savedLayout);
        
        // Пометка соответствующей кнопки как активной
        $('.layout-switcher__button[data-layout="' + savedLayout + '"]').addClass('layout-switcher__button--active');
    }

    $('.layout-switcher__button').on('click', function() {
        const selectedLayout = $(this).data('layout');
        const layoutSwitcher = $(this).closest('.layout-switcher');
        const productsView = $(this).closest('.products-view');
        const productsList = productsView.find('.products-list');
        
        layoutSwitcher.find('.layout-switcher__button').removeClass('layout-switcher__button--active');
        $(this).addClass('layout-switcher__button--active');
        
        // Сохранение выбранного макета в localStorage
        localStorage.setItem('selectedLayout', selectedLayout);

        // Установка выбранного макета
        productsList.attr('data-layout', selectedLayout);
    });
});


JS;

$this->registerJs($script, \yii\web\View::POS_END);
?>