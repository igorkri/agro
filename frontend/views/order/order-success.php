<?php

//debug($order->orderItems);

\common\models\shop\ActivePages::setActiveUser();

?>

<!-- site__body -->
<div class="site__body">
    <div class="block order-success">
        <div class="container">
            <div class="order-success__body">
                <div class="order-success__header">
                    <svg class="order-success__icon" width="100" height="100">
                        <use xlink:href="/images/sprite.svg#check-100"></use>
                    </svg>
                    <h1 class="order-success__title">Дякуємо!</h1>
                    <div class="order-success__subtitle">Ваше замовлення отримано</div>
                    <div class="order-success__subtitle">Найближчим часом з вами звяжеться наш менеджер</div>
                    <div class="order-success__actions">
                        <a href="/" class="btn btn-xs btn-secondary">На головну</a>
                    </div>
                </div>
                <div class="order-success__meta">
                    <ul class="order-success__meta-list">
                        <li class="order-success__meta-item">
                            <span class="order-success__meta-title">№ Замовлення:</span>
                            <span class="order-success__meta-value">#<?=$order->id?></span>
                        </li>
                        <li class="order-success__meta-item">
                            <span class="order-success__meta-title">Дата:</span>
                            <span class="order-success__meta-value"><?=Yii::$app->formatter->asDate($order->created_at)?></span>
                        </li>
                        <li class="order-success__meta-item">
                            <span class="order-success__meta-title">К-ть:</span>
                            <span class="order-success__meta-value"><?=$order->getTotalQty($order->id)?></span>
                        </li>
                        <li class="order-success__meta-item">
                            <span class="order-success__meta-title">Сума:</span>
                            <span class="order-success__meta-value"><?=Yii::$app->formatter->asCurrency($order->getTotalSumm($order->id))?></span>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="order-list">
                        <table>
                            <thead class="order-list__header">
                            <tr>
                                <th class="order-list__column-label" colspan="2">Товар</th>
                                <th class="order-list__column-quantity">К-ть</th>
                                <th class="order-list__column-total">Всього</th>
                            </tr>
                            </thead>
                            <tbody class="order-list__products">
                            <?php foreach ($order->orderItems as $orderItem): ?>
                            <tr>
                                <td class="order-list__column-image">
                                    <div class="product-image">
                                        <a href="" class="product-image__body">
                                            <img class="product-image__img" src="<?= $orderItem->product->getImgOne($orderItem->product->getId())?>" alt="<?=$orderItem->product->name?>">
                                        </a>
                                    </div>
                                </td>
                                <td class="order-list__column-product">
                                <?=$orderItem->product->name?></a>

                                </td>
                                <td class="order-list__column-quantity" data-title="К-ть:"><?=$orderItem->quantity?></td>
                                <td class="order-list__column-total"><?= $orderItem->price * $orderItem->quantity ?></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot class="order-list__footer">
                            <tr>
                                <th class="order-list__column-label" colspan="3">Всього</th>
                                <td class="order-list__column-total"><?=Yii::$app->formatter->asCurrency($order->getTotalSumm($order->id))?></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row mt-3 no-gutters mx-n2">
                    <div class="col-sm-12 col-12 px-2">
                        <div class="card address-card">
                            <div class="address-card__body">
                                <div class="address-card__badge address-card__badge--muted">Адреса доставки</div>
                                <div class="address-card__name"><?=$order->fio?></div>
                                <div class="address-card__row">
                                    <?=$order->city?><br>
                                    <?=$order->note?>
                                </div>
                                <div class="address-card__row">
                                    <div class="address-card__row-title">Телефон</div>
                                    <div class="address-card__row-content"><?=$order->phone?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- site__body / end -->
