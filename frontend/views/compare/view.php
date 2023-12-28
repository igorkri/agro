<?php

use common\models\shop\ActivePages;
use yii\helpers\Html;
use yii\helpers\Url;

ActivePages::setActiveUser();

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
                        <li class="breadcrumb-item active" aria-current="page">Порівняння</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Порівняння товарів</h1>
            </div>
        </div>
    </div>
    <div id="compare-list">
        <?php if ($products) { ?>
            <div class="block">
                <div class="container">
                    <div class="table-responsive">
                        <table class="compare-table">
                            <tbody>
                            <tr>
                                <th>Продукт</th>
                                <?php foreach ($products as $product): ?>
                                    <td>
                                        <a class="compare-table__product-link"
                                           href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>">
                                            <div class="compare-table__product-image product-image">
                                                <div class="product-image__body">
                                                    <img class="product-image__img"
                                                         src="<?= $product->getImgOneLarge($product->getId()) ?>"
                                                         alt="<?= $product->name ?>">
                                                </div>
                                            </div>
                                            <?php if ($product->category->prefix) { ?>
                                                <div class="product-card__name">
                                                    <?php echo $product->category->prefix ? '<span class="category-prefix">' . $product->category->prefix . '</span>' : '' ?>
                                                </div>
                                            <?php } ?>
                                            <div class="compare-table__product-name"><?= $product->name ?>
                                            </div>
                                        </a>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <th>Наявність</th>
                                <?php foreach ($products as $product): ?>
                                    <td><span class="product-card__availability text-success"> <?php
                                            $statusIcon = '';
                                            $statusStyle = '';

                                            switch ($product->status_id) {
                                                case 1:
                                                    $statusIcon = '<i style="font-size:1.5rem; margin: 5px;" class="fas fa-check"></i>';
                                                    $statusStyle = '';
                                                    break;
                                                case 2:
                                                    $statusIcon = '<i style="font-size:1.5rem; margin: 5px; color: #ff0000;" class="fas fa-ban"></i>';
                                                    $statusStyle = 'color: #ff0000; font-weight: 600; letter-spacing: 0.6px;';
                                                    break;
                                                case 3:
                                                    $statusIcon = '<i style="font-size:1.5rem; margin: 5px; color: #ff8300;" class="fas fa-truck"></i>';
                                                    $statusStyle = 'color: #ff8300; font-weight: 600; letter-spacing: 0.6px;';
                                                    break;
                                                case 4:
                                                    $statusIcon = '<i style="font-size:1.5rem; margin: 5px; color: #0331fc;" class="fa fa-bars"></i>';
                                                    $statusStyle = 'color: #0331fc; font-weight: 600; letter-spacing: 0.6px;';
                                                    break;
                                                default:
                                                    $statusStyle = 'color: #060505; font-weight: 600; letter-spacing: 0.6px;';
                                                    break;
                                            }

                                            echo $statusIcon . '<span style="' . $statusStyle . '">' . $product->status->name . '</span>';
                                            ?></span></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <th>Ціна</th>
                                <?php foreach ($products as $product): ?>
                                    <td>
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
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <th></th>
                                <?php foreach ($products as $product): ?>
                                    <td>
                                        <?php if ($product->status_id != 2) { ?>
                                                <button class="btn btn-primary btn-sm product-card__addtocart"
                                                        type="button"
                                                        data-product-id="<?= $product->id ?>">
                                                    <svg width="20px" height="20px" style="display: unset;">
                                                        <use xlink:href="/images/sprite.svg#cart-20"></use>
                                                    </svg>
                                                    <?= !$product->getIssetToCart($product->id) ? 'В Кошик' : 'Уже в кошику' ?>
                                                </button>
                                            </div>
                                        <?php } else { ?>
                                                <button class="btn btn-secondary btn-sm disabled"
                                                        type="button"
                                                        data-product-id="<?= $product->id ?>">
                                                    <svg width="20px" height="20px" style="display: unset;">
                                                        <use xlink:href="/images/sprite.svg#cart-20"></use>
                                                    </svg>
                                                    <?= !$product->getIssetToCart($product->id) ? 'В Кошик' : 'Уже в кошику' ?>
                                                </button>
                                        <?php } ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <th></th>
                                <?php foreach ($products as $product): ?>
                                    <td>
                                        <?= Html::a('<i class="fas fa-trash-alt"></i> Видалити', ['compare/delete-from-compare', 'id' => $product->id], [
                                            'class' => 'btn btn-dark btn-sm',
                                            'id' => 'delete-from-compare-btn',
                                        ]) ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <?php foreach ($properties as $property): ?>
                                <tr>
                                    <th><?= $property ?></th>
                                    <?php foreach ($products as $product): ?>
                                        <td>
                                            <?= $product->getCompareProperty($product->id, $property) ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="block">
                <div class="container">
                    <div class="not-found">
                        <div class="not-found__content">
                            <h2 class="not-found__title">Список порівняння порожній!</h2>
                            <p class="not-found__text">
                                Додайте товари для порівняння.
                                <br>
                                Спробуйте скористатися пошуком.
                            </p>
                            <img src="/images/no-compare.jpg" alt="Список порівняння порожній">
                            <p class="not-found__text">
                                Або перейдіть на головну сторінку, щоб почати все спочатку.
                            </p>
                            <a class="btn btn-secondary btn-sm" href="/">На Головну Сторінку</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<style>
    .category-prefix {
        color: #a9a8a8;
    }
</style>

<?php
$script = <<< JS
    $(document).on('click', '#delete-from-compare-btn', function(e) {
    e.preventDefault();
    var compareIndicator = $('#compare-indicator');
    var compareListContainer = $('#compare-list');
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
    if (response.success) {
        compareListContainer.html(response.compareListHtml);
        compareIndicator.text(response.compareCount);
    } else {
        console.log('Произошла ошибка при удалении товара из списка сравнения')
    }
},
        error: function() {
            console.log('Произошла ошибка при выполнении AJAX-запроса')
        }
    });
});
JS;
// Регистрируем скрипт
$this->registerJs($script);
?>
