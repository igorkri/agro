<?php


?>

<div class="sa-suggestions__section">
    <div class="sa-suggestions__section-title">Actions</div>
    <div class="sa-suggestions__item sa-suggestions__item--type--default">Add new product</div>
</div>
<div class="sa-suggestions__section">
        <div class="sa-suggestions__section-title">Products</div>
    <?php foreach ($results as $result): ?>
        <div class="sa-suggestions__item sa-suggestions__item--type--product">
            <div class="sa-suggestions__product">
                <div class="sa-suggestions__product-image"><?php if (isset($result->images[0])): ?>
                        <img src="<?= Yii::$app->request->hostInfo . '/product/' . $result->images[0]->extra_small ?>"
                             width="40" height="40" alt=""/>
                    <?php else: ?>
                        <img src="<?= Yii::$app->request->hostInfo . '/images/no-image.png' ?>"
                             width="40" height="40" alt=""/>
                    <?php endif; ?></div>
                <div class="sa-suggestions__product-info">
                    <div class="sa-suggestions__product-name"><?= $result->name ?></div>
                    <div class="sa-suggestions__product-meta sa-meta">
                        <ul class="sa-meta__list">
                            <li class="sa-meta__item"><?= $result->sku ?></li>
                            <li class="sa-meta__item"><?= $result->price ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="sa-suggestions__item sa-suggestions__item--type--link">Show all 10 results</div>
</div>