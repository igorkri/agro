<?php

use yii\helpers\Html;
use yii\helpers\Url;

\common\models\shop\ActivePages::setActiveUser();

if ($total_summ === 0) {
    $h = 'Ваш кошик порожній';
} else {
    $h = 'Ваш кошик';
}

?>
<div class="quickview">
    <button class="quickview__close" type="button">
        <svg width="20px" height="20px">
            <use xlink:href="/images/sprite.svg#cross-20"></use>
        </svg>
    </button>
    <div class="product product--layout--quickview" data-layout="quickview">
        <!-- site__body -->
        <div class="site__body">
            <div class="page-header">
                <div class="page-header__container container">
                    <div class="page-header__title">
                        <h1 style="font-size: 28px"> <?= $h ?> </h1>
                    </div>
                </div>
            </div>
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
                                            <img class="product-image__img"
                                                 src="<?= $order->getImgOne($order->getId()) ?>"
                                                 alt="<?= $order->name ?>">
                                        </a>
                                    </div>
                                </td>
                                <td class="cart-table__column cart-table__column--product">
                                    <a href="<?= Url::to(['product/view', 'slug' => $order->slug]) ?>"
                                       class="cart-table__product-name"><?= $order->name ?></a>
                                </td>
                                <?php if ($order->currency == 'UAH'): ?>
                                    <td class="cart-table__column cart-table__column--price"
                                        data-title="Ціна"><?= Yii::$app->formatter->asCurrency($order->price) ?></td>
                                <?php else: ?>
                                    <td class="cart-table__column cart-table__column--price"
                                        data-title="Ціна"><?= Yii::$app->formatter->asCurrency($order->price * \common\models\Settings::currencyRate($order->currency)) ?></td>
                                <?php endif; ?>
                                <td class="cart-table__column cart-table__column--quantity" data-title="Кількість">
                                    <div class="input-number">
                                        <input class="form-control input-number__input" type="number" min="1"
                                               value="<?= $order->getQuantity() ?>"
                                               onchange="updateQty(<?= $order->getId() ?>, $(this).val());"
                                               onkeyup="this.onchange();" onpaste="this.onchange();"
                                               oninput="this.onchange();">
                                        <div class="input-number__add"
                                             onclick="updateQty(<?= $order->getId() ?>, <?= $order->getQuantity() + 1 ?>)"></div>
                                        <div class="input-number__sub"
                                             onclick="updateQty(<?= $order->getId() ?>, <?= $order->getQuantity() - 1 ?>)"></div>
                                    </div>
                                </td>
                                <?php if ($order->currency == 'UAH'): ?>
                                    <td class="cart-table__column cart-table__column--total"
                                        data-title="Всього"><?= Yii::$app->formatter->asCurrency($order->price * $order->getQuantity()) ?></td>
                                <?php else: ?>
                                    <td class="cart-table__column cart-table__column--total"
                                        data-title="Всього"><?= Yii::$app->formatter->asCurrency($order->price * \common\models\Settings::currencyRate($order->currency) * $order->getQuantity()) ?></td>
                                <?php endif; ?>
                                <td class="cart-table__column cart-table__column--remove"
                                    onclick="removeProduct(<?= $order->id ?>)">
                                    <button type="button" class="btn btn-light btn-sm btn-svg-icon">
                                        <svg width="12px" height="12px">
                                            <use xlink:href="/images/sprite.svg#cross-12"></use>
                                        </svg>
                                    </button>
                                    <?php // Html::a('
                                    //                            <button type="button" class="btn btn-light btn-sm btn-svg-icon">
                                    //                                    <svg width="12px" height="12px">
                                    //                                        <use xlink:href="/images/sprite.svg#cross-12"></use>
                                    //                                    </svg>
                                    //                                </button>',
                                    //                                    Url::to(['cart/remove', 'id' => $order->getId()]),
                                    //                                    ['class' => 'reset-quantity',
                                    //                                        'data' => [
                                    //                                            'method' => 'post',
                                    //                                            'pjax' => 1,
                                    //                                        ],
                                    //                                    ]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="row justify-content-end pt-5">
                        <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                            <div class="card">
                                <div class="card-body">
                                    <?php if ($total_summ < 500) { ?>
                                        <h5 class="card-title" style="color: red">Замовлення від 500 ₴</h5>
                                    <?php } ?>
                                    <table class="cart__totals">
                                        <tfoot class="cart__totals-footer">
                                        <tr>
                                            <th>Загальна сума</th>
                                            <td><?= Yii::$app->formatter->asCurrency($total_summ) ?></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <?php if ($total_summ != 0) { ?>
                                        <?php if ($total_summ < 500) { ?>
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
        </div>
        <!-- site__body / end -->
    </div>
</div>
<!--<div class="qty">--><? //=$qty_cart?><!--</div>-->
