<?php

use common\models\shop\Product;
use frontend\assets\SuggestionsPageAsset;
use frontend\widgets\ViewProduct;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

SuggestionsPageAsset::register($this);

?>
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
                            <li class="breadcrumb-item active"
                                aria-current="page"><?= Yii::$app->request->get('q') ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title">
                    <h1>Знайдено <?php echo $products_all ?> товарів за пошуковим запитом
                        "<?= Yii::$app->request->get('q') ?>"</h1>
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
                                                <button data-layout="grid-4-full" data-with-features="false"
                                                        title="Плитка" type="button" class="layout-switcher__button">
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
                                    <div class="view-options__legend">Показано
                                        <?= count($products) ?> товарів
                                        з <?= $products_all ?>
                                    </div>
                                    <div class="view-options__divider"></div>
                                    <div class="view-options__control">
                                        <label for="">Сортувати</label>
                                        <div>
                                            <?php
                                            echo Html::beginForm(Url::current(), 'post', ['class' => 'form-inline']);
                                            echo Html::dropDownList('sort', Yii::$app->session->get('sort'), [
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
                                            echo Html::endForm();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?= $this->render('@frontend/views/layouts/products-list.php', ['product' => $product]) ?>
                            <div style="display: block;margin: 60px 0px 0px 0px;">
                                <ul class="pagination justify-content-center">
                                    <li>
                                        <?= LinkPager::widget(['pagination' => $pages,]) ?>
                                    </li>
                                </ul>
                            </div>
                            <br>
                            <?php if (Yii::$app->session->get('viewedProducts', [])) echo ViewProduct::widget() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

$this->registerJs($script, View::POS_END);
?>