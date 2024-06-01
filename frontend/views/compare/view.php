<?php

use common\models\shop\ActivePages;
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
                                                         width="131" height="131"
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
                                                    <?= !$product->getIssetToCart($product->id) ? 'Купити' : 'В кошику' ?>
                                                </button>
                                        <?php } else { ?>
                                                <button class="btn btn-secondary btn-sm disabled"
                                                        type="button"
                                                        data-product-id="<?= $product->id ?>">
                                                    <svg width="20px" height="20px" style="display: unset;">
                                                        <use xlink:href="/images/sprite.svg#cart-20"></use>
                                                    </svg>
                                                    <?= !$product->getIssetToCart($product->id) ? 'Купити' : 'В кошику' ?>
                                                </button>
                                        <?php } ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <th></th>
                                <?php foreach ($products as $product): ?>
                                    <td>
                                        <button type="button"
                                                class="btn btn-dark btn-sm"
                                                id="delete-from-compare-btn"
                                                data-compare-product-id="<?= $product->id ?>">
                                            <i class="fas fa-trash-alt"></i> Видалити
                                        </button>
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
                    <div class="compare-not-products">
                        <div class="compare-not-products__content">
                            <h2 class="compare-not-products__title">Список порівняння порожній!</h2>
                            <p class="compare-not-products__text">
                                Додайте товари для порівняння.
                                <br>
                                Спробуйте скористатися пошуком.
                            </p>
                            <img src="/images/no-compare.jpg" alt="Список порівняння порожній">
                            <p class="compare-not-products__text">
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
    .compare-not-products {
        text-align: center;
    }
    .compare-not-products__content{
        width: 480px;
        max-width: 100%;
        margin: 0 auto;
    }
    .compare-not-products__title{
        margin-bottom: 30px;
    }
    .compare-not-products__text{
        margin-bottom: 20px;
    }
</style>

<?php
$script = <<< JS
    $(document).on('click', '#delete-from-compare-btn', function(e) {
    e.preventDefault();
    var compareIndicator = $('#compare-indicator');
    var compareListContainer = $('#compare-list');
    var productId = $(this).data('compare-product-id');
    var url = '/compare/delete-from-compare';
    $.ajax({
        url: url,
        type: 'POST',
        data: { id: productId },
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
$this->registerJs($script);
?>
