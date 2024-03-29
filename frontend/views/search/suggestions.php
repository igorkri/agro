<?php

use yii\helpers\Url;

?>
<ul class="suggestions__list">
    <?php foreach ($products as $product): ?>
    <li class="suggestions__item">
        <div class="suggestions__item-image product-image">
            <div class="product-image__body">
                <img class="product-image__img"
                     src="<?= $product->getImgOneExtraSmal($product->getId())?>"
                     width="44" height="44"
                     alt="<?= $product->name ?>">
            </div>
        </div>
        <div class="suggestions__item-info">
            <a href="<?=Url::to(['product/view', 'slug' => $product->slug])?>" class="suggestions__item-name">
                <?=$product->name?>
            </a>
            <div class="suggestions__item-meta">Артикул: <?=$product->sku?></div>
        </div>
        <div class="suggestions__item-price">
            <?=Yii::$app->formatter->asCurrency($product->getPrice())?>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
