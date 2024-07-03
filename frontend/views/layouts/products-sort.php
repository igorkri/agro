<?php

use yii\helpers\Html;
use yii\web\View;

?>
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
<div class="view-options__legend"><?= Yii::t('app', 'Показано') ?> <?= count($products) ?> <?= Yii::t('app', 'товарів з') ?>
    <?= $products_all ?></div>
<div class="view-options__divider"></div>
<div class="view-options__control">
    <label for=""><?= Yii::t('app', 'Сортувати') ?></label>
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
    <label for=""><?= Yii::t('app', 'Показати') ?></label>
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