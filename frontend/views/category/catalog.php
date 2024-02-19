<?php

use common\models\shop\ActivePages;
use common\models\shop\Product;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

ActivePages::setActiveUser();

/** @var \common\models\shop\Product $products */
/** @var \common\models\shop\Product $pages */
/** @var \common\models\shop\Product $products_all */
/** @var \common\models\shop\Product $propertiesFilter */
/** @var \common\models\shop\AuxiliaryCategories $auxiliaryCategories */

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
                            <?php if (isset($category->parent)): ?>
                                <li class="breadcrumb-item">
                                    <a href="<?= Url::to(['category/children', 'slug' => $category->parent->slug]) ?>"><?= $category->parent->name ?></a>
                                    <svg class="breadcrumb-arrow" width="6px" height="9px">
                                        <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                    </svg>
                                </li>
                            <?php endif; ?>
                            <li class="breadcrumb-item active" aria-current="page"><?= $category->name ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title">
                    <h1><?= $category->name ?></h1>
                </div>
            </div>
        </div>
        <?php echo Html::beginForm(Url::current(), 'post', ['class' => 'form-inline']); ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="block">
                        <div class="products-view">
                            <div class="products-view__options">
                                <div class="view-options view-options--offcanvas--always">
                                    <div class="view-options__filters-button">
                                        <button type="button" class="filters-button">
                                            <svg class="filters-button__icon" width="16px" height="16px">
                                                <use xlink:href="/images/sprite.svg#filters-16"></use>
                                            </svg>
                                            <span class="filters-button__title">Фільтр</span>
                                            <span class="filters-button__counter"><?= $category->getCounterFilter() ?></span>
                                        </button>
                                    </div>
                                    <div class="view-options__layout">
                                        <div class="layout-switcher">
                                            <div class="layout-switcher__list">
                                                <button data-layout="grid-4-full" data-with-features="false"
                                                        title="Плитка"
                                                        type="button" class="layout-switcher__button">
                                                    <svg width="16px" height="16px">
                                                        <use xlink:href="/images/sprite.svg#layout-grid-16x16"></use>
                                                    </svg>
                                                </button>
                                                <button data-layout="list" data-with-features="false" title="Список"
                                                        type="button" class="layout-switcher__button">
                                                    <svg width="16px" height="16px">
                                                        <use xlink:href="/images/sprite.svg#layout-list-16x16"></use>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-options__legend">Показано <?= count($products) ?> товарів
                                        з <?= $products_all ?></div>
                                    <div class="view-options__divider"></div>
                                    <div class="view-options__control">
                                        <label for="">Сортувати</label>
                                        <div>
                                            <?php echo Html::dropDownList('sort', Yii::$app->session->get('sort'), [
                                                '' => 'Наявність',
                                                'price_lowest' => 'Ціна Дешевші',
                                                'price_highest' => 'Ціна Дорожчі',
                                                'name_a' => 'Назва A-я',
                                                'name_z' => 'Назва Я-а',
                                            ], ['class' => 'form-control form-control-sm', 'id' => 'sort-form']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="view-options__control">
                                        <label for="">Показати</label>
                                        <div>
                                            <?php
                                            echo Html::dropDownList('count', Yii::$app->session->get('count'), [
                                                '4' => '4',
                                                '8' => '8',
                                                '12' => '12',
                                                '24' => '24',
                                                '32' => '32',
                                            ], ['class' => 'form-control form-control-sm', 'id' => 'count-form']);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="products-view__list products-list" data-layout="grid-4-full"
                                 data-with-features="false" data-mobile-grid-columns="2">
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
                                                    <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"
                                                       class="product-image__body">
                                                        <img class="product-image__img"
                                                             src="<?= $product->getImgOne($product->getId()) ?>"
                                                             alt="<?= $product->name ?>">
                                                    </a>
                                                </div>
                                                <div class="product-card__info">
                                                    <?php if ($product->category->prefix) { ?>
                                                        <div class="product-card__name">
                                                            <?php echo $product->category->prefix ? '<span class="category-prefix">' . $product->category->prefix . '</span>' : '' ?>
                                                        </div>
                                                    <?php } ?>
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
                                                    <?= $this->render('@frontend/widgets/views/add-to-cart-button.php', ['product' => $product]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="block block-sidebar block-sidebar--offcanvas--always">
                                <div class="block-sidebar__backdrop"></div>
                                <div class="block-sidebar__body">
                                    <div class="block-sidebar__header">
                                        <div class="block-sidebar__title">Фільтр</div>
                                        <button class="block-sidebar__close" type="button">
                                            <svg width="20px" height="20px">
                                                <use xlink:href="/images/sprite.svg#cross-20"></use>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="block-sidebar__item">
                                        <div class="widget-filters widget widget-filters--offcanvas--always"
                                             data-collapse
                                             data-collapse-opened-class="filter--opened">
                                            <h4 class="widget-filters__title widget__title">Фільтр</h4>
                                            <div class="widget-filters__list">
                                                <div class="widget-filters__item">
                                                    <div class="filter filter--opened" data-collapse-item>
                                                        <button type="button" class="filter__title"
                                                                data-collapse-trigger>
                                                            Категорії
                                                            <svg class="filter__arrow" width="12px" height="7px">
                                                                <use xlink:href="/images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                            </svg>
                                                        </button>
                                                        <div class="filter__body" data-collapse-content>
                                                            <div class="filter__container">
                                                                <div class="filter-categories">
                                                                    <ul class="filter-categories__list">
                                                                        <li class="filter-categories__item filter-categories__item--parent">
                                                                            <svg class="filter-categories__arrow"
                                                                                 width="6px"
                                                                                 height="9px">
                                                                                <use xlink:href="/images/sprite.svg#arrow-rounded-left-6x9"></use>
                                                                            </svg>
                                                                            <?php if ($category->parent) { ?>
                                                                                <a href="<?= Url::to(['category/children', 'slug' => $category->parent->slug]) ?>"><?= $category->parent->name ?></a>
                                                                            <?php } else { ?>
                                                                                <a href="<?= Url::to(['category/catalog', 'slug' => $category->slug]) ?>"><?= $category->name ?></a>
                                                                            <?php } ?>
                                                                            <div class="filter-categories__counter">
                                                                                <?= ($category->parent) ? $category->getCountProductCategoryFilter($category->parent->id) : $category->getCountProductCategoryFilter($category->id); ?>
                                                                            </div>
                                                                        </li>
                                                                        <?php if ($category->parent): ?>
                                                                            <?php $categoryChilds = $category->getCategoryChildFilter($category->parent->id) ?>
                                                                            <?php foreach ($categoryChilds as $categoryChild): ?>
                                                                                <?php if ($category->id == $categoryChild->id) { ?>
                                                                                    <li class="filter-categories__item filter-categories__item--current">
                                                                                        <a href="<?= Url::to(['category/catalog', 'slug' => $categoryChild->slug]) ?>"><?= $categoryChild->name ?></a>
                                                                                        <div class="filter-categories__counter"><?= $categoryChild->getCountProductCategoryFilter($categoryChild->id) ?></div>
                                                                                    </li>
                                                                                <?php } else { ?>
                                                                                    <li class="filter-categories__item filter-categories__item--child">
                                                                                        <a href="<?= Url::to(['category/catalog', 'slug' => $categoryChild->slug]) ?>"><?= $categoryChild->name ?></a>
                                                                                        <div class="filter-categories__counter"><?= $categoryChild->getCountProductCategoryFilter($categoryChild->id) ?></div>
                                                                                    </li>
                                                                                <?php } ?>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if (isset($auxiliaryCategories) and $auxiliaryCategories != null): ?>
                                                    <div class="widget-filters__item">
                                                        <div class="filter filter--opened" data-collapse-item>
                                                            <button type="button" class="filter__title"
                                                                    data-collapse-trigger>
                                                                Категорії допоміжні
                                                                <svg class="filter__arrow" width="12px" height="7px">
                                                                    <use xlink:href="/images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                                </svg>
                                                            </button>
                                                            <div class="filter__body" data-collapse-content>
                                                                <div class="filter__container">
                                                                    <div class="filter-categories-alt">
                                                                        <ul class="filter-categories-alt__list filter-categories-alt__list--level--1"
                                                                            data-collapse-opened-class="filter-categories-alt__item--open">
                                                                            <?php foreach ($auxiliaryCategories as $auxiliaryCategory): ?>
                                                                                <li class="filter-categories-alt__item"
                                                                                    data-collapse-item>
                                                                                    <a href="<?= Url::to(['category/auxiliary-catalog', 'slug' => $auxiliaryCategory->slug]) ?>"><?php echo $auxiliaryCategory->name ?></a>
                                                                                </li>
                                                                            <?php endforeach; ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="widget-filters__item">
                                                    <div class="filter filter--opened" data-collapse-item>
                                                        <button type="button" class="filter__title"
                                                                data-collapse-trigger>
                                                            Ціна
                                                            <svg class="filter__arrow" width="12px" height="7px">
                                                                <use xlink:href="/images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                            </svg>
                                                        </button>
                                                        <div class="filter__body" data-collapse-content>
                                                            <?php
                                                            $minPrice = round(Product::find()->min('price'), 2);
                                                            $maxPrice = round(Product::find()->max('price'), 2);

                                                            $request = Yii::$app->request;
                                                            $submittedMinPrice = $request->post('minPrice', $minPrice);
                                                            $submittedMaxPrice = $request->post('maxPrice', $maxPrice);
                                                            ?>
                                                            <div class="filter__container">
                                                                <div class="filter-price" data-min="<?= $minPrice ?>"
                                                                     data-max="<?= $maxPrice ?>"
                                                                     data-from="<?= $submittedMinPrice ?>"
                                                                     data-to="<?= $submittedMaxPrice ?>">
                                                                    <div class="filter-price__slider"></div>
                                                                    <div class="filter-price__title">Ціна: ₴
                                                                        <span class="filter-price__min-value"></span> –
                                                                        ₴
                                                                        <span class="filter-price__max-value"></span>
                                                                        <input type="hidden" name="minPrice"
                                                                               id="minPrice"
                                                                               value="<?= $submittedMinPrice ?>"
                                                                               class="filter-price__min-value"/>
                                                                        <input type="hidden" name="maxPrice"
                                                                               id="maxPrice"
                                                                               value="<?= $submittedMaxPrice ?>"
                                                                               class="filter-price__max-value"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-filters__item">
                                                    <div class="filter" data-collapse-item>
                                                        <button type="button" class="filter__title"
                                                                data-collapse-trigger>
                                                            Бренд
                                                            <svg class="filter__arrow" width="12px" height="7px">
                                                                <use xlink:href="/images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                            </svg>
                                                        </button>
                                                        <div class="filter__body" data-collapse-content>
                                                            <div class="filter__container">
                                                                <div class="filter-list">
                                                                    <div class="filter-list__list">
                                                                        <?php $brandsCategory = $category->getBrandsCategoryFilter($category->id) ?>
                                                                        <?php foreach ($brandsCategory as $brand): ?>
                                                                            <label class="filter-list__item ">
                                                                <span class="filter-list__input input-check">
                                                                    <span class="input-check__body">
                                                                        <input class="input-check__input"
                                                                               type="checkbox"
                                                                               name="brandCheck[]"
                                                                               value="<?= Html::encode($brand->id) ?>"
                                                                               <?= in_array($brand->id, Yii::$app->request->post('brandCheck', [])) ? 'checked' : '' ?>
                                                                               >
                                                                        <span class="input-check__box"></span>
                                                                        <svg class="input-check__icon" width="9px"
                                                                             height="7px">
                                                                            <use xlink:href="/images/sprite.svg#check-9x7"></use>
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                                                <span class="filter-list__title">
                                                                 <?= $brand->name ?>
                                                                </span>
                                                                                <span class="filter-list__counter"><?= $brand->getBrandProductCountFilter($brand->id, $category->id) ?></span>
                                                                            </label>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php foreach ($propertiesFilter as $value): ?>
                                                    <div class="widget-filters__item">
                                                        <div class="filter" data-collapse-item>
                                                            <button type="button" class="filter__title"
                                                                    data-collapse-trigger>
                                                                <?= $value ?>
                                                                <svg class="filter__arrow" width="12px" height="7px">
                                                                    <use xlink:href="/images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                                </svg>
                                                            </button>
                                                            <div class="filter__body" data-collapse-content>
                                                                <div class="filter__container">
                                                                    <div class="filter-list">
                                                                        <div class="filter-list__list">
                                                                            <?php $properties = $category->getPropertiesFilter($category->id, $value) ?>
                                                                            <?php foreach ($properties as $property): ?>
                                                                                <label class="filter-list__item ">
                                                                <span class="filter-list__input input-check">
                                                                    <span class="input-check__body">
                                                                        <input class="input-check__input"
                                                                               type="checkbox"
                                                                               name="propertiesCheck[]"
                                                                               value="<?= Html::encode($property) ?>"
                                                                               <?= in_array($property, Yii::$app->request->post('propertiesCheck', [])) ? 'checked' : '' ?>
                                                                               >
                                                                        <span class="input-check__box"></span>
                                                                        <svg class="input-check__icon" width="9px"
                                                                             height="7px">
                                                                            <use xlink:href="/images/sprite.svg#check-9x7"></use>
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                                                    <span class="filter-list__title">
                                                                  <?= $property ?>
                                                                </span>
                                                                                    <span class="filter-list__counter">
                                                                                        <?= $category->getPropertiesCountPruductFilter
                                                                                        ($category->id, $property) ?>
                                                                                    </span>
                                                                                </label>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="widget-filters__actions d-flex">
                                                <button type="submit" class="btn btn-primary btn-sm">Фільтрувати
                                                </button>
                                                <?= Html::a('Скинути', ['product-list/' . $category->slug], ['class' => 'btn btn-secondary btn-sm']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="d-flex justify-content-center">
                                    <?= LinkPager::widget([
                                        'pagination' => $pages,
                                        'options' => ['class' => 'pagination'],
                                        'linkOptions' => ['class' => 'page-link'],
                                        'activePageCssClass' => 'active',
                                        'disabledPageCssClass' => 'disabled',
                                        'nextPageLabel' => '»',
                                        'prevPageLabel' => '«',
                                    ]); ?>
                                </div>
                            </div>
                            <div class="spec__disclaimer">
                                <?= $category->description ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo Html::hiddenInput('slug', $category->slug);
        echo Html::endForm();
        ?>
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

$this->registerJs($script, View::POS_END);
?>