<?php

use yii\helpers\Url;

?>

<?php if ($products) { ?>
    <div class="block">
        <div class="container">
            <table class="wishlist">
                <thead class="wishlist__head">
                <tr class="wishlist__row">
                    <th class="wishlist__column wishlist__column--image">Зображення</th>
                    <th class="wishlist__column wishlist__column--product">Назва</th>
                    <th class="wishlist__column wishlist__column--stock">Наявність</th>
                    <th class="wishlist__column wishlist__column--price">Ціна</th>
                    <th class="wishlist__column wishlist__column--tocart"></th>
                    <th class="wishlist__column wishlist__column--remove"></th>
                </tr>
                </thead>
                <tbody class="wishlist__body">
                <?php foreach ($products as $product): ?>
                    <tr class="wishlist__row">
                        <td class="wishlist__column wishlist__column--image">
                            <div class="product-image">
                                <a class="product-image__body"
                                   href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>">
                                    <img class="product-image__img"
                                         src="<?= $product->getImgOneLarge($product->getId()) ?>"
                                         alt="<?= $product->name ?>">
                                </a>
                            </div>
                        </td>
                        <td class="wishlist__column wishlist__column--product">
                            <?php if ($product->category->prefix) { ?>
                                <div class="product-card__name">
                                    <?php echo $product->category->prefix ? '<span class="category-prefix">' . $product->category->prefix . '</span>' : '' ?>
                                </div>
                            <?php } ?>
                            <div class="product-card__name">
                                <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"><?= $product->name ?></a>
                            </div>
                            <div class="wishlist__product-rating">
                                <div class="rating">
                                    <?= $product->getRating($product->id, 13, 12) ?>
                                </div>
                                <div class="wishlist__product-rating-legend"><?= count($product->reviews) ?>
                                    відгуків
                                </div>
                            </div>
                        </td>
                        <td class="wishlist__column wishlist__column--stock">
                            <span class="product-card__availability text-success"> <?php
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
                                ?></span>
                        </td>
                        <td class="wishlist__column wishlist__column--price">
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
                        <td class="wishlist__column wishlist__column--tocart">
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
                        <td class="wishlist__column wishlist__column--remove">
                            <button type="button"
                                    class="btn btn-light btn-sm btn-svg-icon"
                                    id="delete-from-wish-btn"
                                    data-wish-product-id="<?= $product->id ?>">
                                <svg width="12px" height="12px">
                                    <use xlink:href="/images/sprite.svg#cross-12"></use>
                                </svg>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } else { ?>
    <div class="block">
        <div class="container">
            <div class="not-found">
                <div class="not-found__content">
                    <h2 class="not-found__title">Список бажань порожній!</h2>
                    <p class="not-found__text">
                        Додайте товари до списку бажань.
                        <br>
                        Спробуйте скористатися пошуком.
                    </p>
                    <img src="/images/no-wish.jpg" alt="Список бажань порожній">
                    <p class="not-found__text">
                        Або перейдіть на головну сторінку, щоб почати все спочатку.
                    </p>
                    <a class="btn btn-secondary btn-sm" href="/">На Головну Сторінку</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>