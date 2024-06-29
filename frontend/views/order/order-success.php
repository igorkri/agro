<?php

use common\models\shop\ActivePages;
use frontend\assets\OrderSuccessPageAsset;

OrderSuccessPageAsset::register($this);
ActivePages::setActiveUser();

?>
<div class="site__body">
    <div class="block order-success">
        <div class="container">
            <div class="order-success__body">
                <div class="order-success__header">
                    <svg class="order-success__icon" width="100" height="100">
                        <use xlink:href="/images/sprite.svg#check-100"></use>
                    </svg>
                    <h1 class="order-success__title"><?=Yii::t('app','Дякуємо!')?></h1>
                    <div class="order-success__subtitle"><?=Yii::t('app','Ваше замовлення отримано')?></div>
                    <div class="order-success__subtitle"><?=Yii::t('app','Найближчим часом з вами звяжеться наш менеджер')?></div>
                    <div class="order-success__actions">
                        <a href="/" class="btn btn-xs btn-secondary"><?=Yii::t('app','На головну')?></a>
                    </div>
                </div>
                <div class="order-success__meta">
                    <ul class="order-success__meta-list">
                        <li class="order-success__meta-item">
                            <span class="order-success__meta-title">№ <?=Yii::t('app','Замовлення')?>:</span>
                            <span class="order-success__meta-value">#<?= $order->id ?></span>
                        </li>
                        <li class="order-success__meta-item">
                            <span class="order-success__meta-title"><?=Yii::t('app','Дата')?>:</span>
                            <span class="order-success__meta-value"><?= Yii::$app->formatter->asDate($order->created_at) ?></span>
                        </li>
                        <li class="order-success__meta-item">
                            <span class="order-success__meta-title"><?=Yii::t('app','К-ть')?>:</span>
                            <span class="order-success__meta-value"><?= $order->getTotalQty($order->id) ?></span>
                        </li>
                        <li class="order-success__meta-item">
                            <span class="order-success__meta-title"><?=Yii::t('app','Сума')?>:</span>
                            <span class="order-success__meta-value"><?= Yii::$app->formatter->asCurrency($order->getTotalSumm($order->id)) ?></span>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="order-list">
                        <table>
                            <thead class="order-list__header">
                            <tr>
                                <th class="order-list__column-label" colspan="2"><?=Yii::t('app','Товар')?></th>
                                <th class="order-list__column-quantity"><?=Yii::t('app','К-ть')?></th>
                                <th class="order-list__column-total"><?=Yii::t('app','Всього')?></th>
                            </tr>
                            </thead>
                            <tbody class="order-list__products">
                            <?php foreach ($order->orderItems as $orderItem): ?>
                                <tr>
                                    <td class="order-list__column-image">
                                        <div class="product-image">
                                            <a href="" class="product-image__body">
                                                <img class="product-image__img"
                                                     src="<?= $orderItem->product->getImgOne($orderItem->product->getId()) ?>"
                                                     alt="<?= $orderItem->product->name ?>">
                                            </a>
                                        </div>
                                    </td>
                                    <td class="order-list__column-product">
                                        <?= $orderItem->product->name ?>
                                    </td>
                                    <td class="order-list__column-quantity"
                                        data-title="К-ть:"><?= $orderItem->quantity ?></td>
                                    <td class="order-list__column-total"><?= Yii::$app->formatter->asCurrency($orderItem->price * $orderItem->quantity) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot class="order-list__footer">
                            <tr>
                                <th class="order-list__column-label" colspan="3"><?=Yii::t('app','Всього')?></th>
                                <td class="order-list__column-total"><?= Yii::$app->formatter->asCurrency($order->getTotalSumm($order->id)) ?></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row mt-3 no-gutters mx-n2">
                    <div class="col-sm-12 col-12 px-2">
                        <div class="card address-card">
                            <div class="address-card__body">
                                <div class="address-card__badge address-card__badge--muted"><?=Yii::t('app','Адреса доставки')?></div>
                                <div class="address-card__name"><?= $order->fio ?></div>
                                <div class="address-card__row">
                                    <div class="address-card__row-title"><?=Yii::t('app','Телефон')?></div>
                                    <div class="address-card__row-content"><?= $order->phone ?></div>
                                </div>
                                <?php if ($order->area): ?>
                                    <div class="address-card__row">
                                        <div class="address-card__row-title"><?=Yii::t('app','Область')?></div>
                                        <div class="address-card__row-content"><?= $order->getNameArea($order->area) ?></div>
                                    </div>
                                    <div class="address-card__row">
                                        <div class="address-card__row-title"><?=Yii::t('app','Місто')?></div>
                                        <div class="address-card__row-content"><?= $order->getNameCity($order->city) ?></div>
                                    </div>
                                    <div class="address-card__row">
                                        <div class="address-card__row-title"><?=Yii::t('app','Відділення')?></div>
                                        <div class="address-card__row-content"><?= $order->getNameWarehouse($order->warehouses) ?></div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($order->note): ?>
                                    <div class="address-card__row">
                                        <div class="address-card__row-title"><?=Yii::t('app','Коментар')?></div>
                                        <div class="address-card__row-content"><?= $order->note ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

