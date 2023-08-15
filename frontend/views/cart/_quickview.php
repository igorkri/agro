<?php

use common\models\shop\ActivePages;
use yii\helpers\Html;
use yii\helpers\Url;

ActivePages::setActiveUser();

$min_order = 100;  //минимальная сумма заказа

?>

<div class="cart block">
    <div class="container">
        <table class="cart__table cart-table">
            <thead class="cart-table__head">
            <tr class="cart-table__row">
                <th class="cart-table__column cart-table__column--image">Зображення</th>
                <th class="cart-table__column cart-table__column--product">Товар</th>
                <th class="cart-table__column cart-table__column--price">Ціна</th>
                <th class="cart-table__column cart-table__column--quantity">К-ть</th>
                <th class="cart-table__column cart-table__column--total">Всього</th>
                <th class="cart-table__column cart-table__column--remove"></th>
            </tr>
            </thead>
            <tbody class="cart-table__body">
            <?php foreach ($orders as $order): ?>
                <tr class="cart-table__row">
                    <td class="cart-table__column cart-table__column--image">
                        <div class="product-image">
                            <a href="<?= Url::to(['product/view', 'slug' => $order->slug]) ?>"
                               class="product-image__body">
                                <img class="product-image__img" src="<?= $order->getImgOne($order->getId()) ?>" alt="<?= $order->name ?>">
                            </a>
                        </div>
                    </td>
                    <td class="cart-table__column cart-table__column--product">
                        <a href="<?= Url::to(['product/view', 'slug' => $order->slug]) ?>"
                           class="cart-table__product-name"><?= $order->name ?></a>
                    </td>
                    <td class="cart-table__column cart-table__column--price"
                        data-title="Ціна"><?= Yii::$app->formatter->asCurrency($order->getPrice()) ?></td>
                    <td class="cart-table__column cart-table__column--quantity" data-title="Кількість">
                        <div class="input-number">
                            <input class="form-control input-number__input" type="number" min="1"
                                   value="<?= $order->getQuantity() ?>"
                                   onchange="updateQty(<?= $order->getId() ?>, $(this).val());"
                                   onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();">
                            <div class="input-number__add"
                                 onclick="updateQty(<?= $order->getId() ?>, <?= $order->getQuantity() + 1 ?>)"></div>
                            <div class="input-number__sub"
                                 onclick="updateQty(<?= $order->getId() ?>, <?= $order->getQuantity() - 1 ?>)"></div>
                        </div>
                    </td>
                    <td class="cart-table__column cart-table__column--total"
                        data-title="Всього"><?= Yii::$app->formatter->asCurrency($order->getPrice() * $order->getQuantity()) ?></td>
                    <td class="cart-table__column cart-table__column--remove"
                        onclick="removeProduct(<?= $order->id ?>)">
                        <button type="button" class="btn btn-light btn-sm btn-svg-icon">
                            <svg width="12px" height="12px">
                                <use xlink:href="/images/sprite.svg#cross-12"></use>
                            </svg>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="row justify-content-end pt-5">
            <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <?php if ($total_summ < $min_order and $total_summ > 0) { ?>
                            <h5 class="card-title" style="color: red">Замовлення від <?= $min_order ?> ₴</h5>
                        <?php } ?>
                        <table class="cart__totals">
                            <tfoot class="cart__totals-footer">
                            <tr>
                                <th>Загальна сума</th>
                                <td><?= Yii::$app->formatter->asCurrency($total_summ) ?></td>
                            </tr>
                            </tfoot>
                        </table>
                        <?php if ($total_summ != 0){ ?>
                            <?php if ($total_summ < $min_order) { ?>
                                <a class="btn btn-primary btn-xl btn-block disabled cart__checkout-button"
                                   href="<?= Url::to(['/order/checkout']) ?>">Замовити</a>
                            <?php } else { ?>
                                <a class="btn btn-primary btn-xl btn-block cart__checkout-button"
                                   href="<?= Url::to(['/order/checkout']) ?>">Замовити</a>
                            <?php } ?>
                        <?php } else { ?>
                            <a class="btn btn-primary btn-xl btn-block cart__checkout-button"
                               href="<?= Url::to(['/']) ?>">Дивитись товари</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

