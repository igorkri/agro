<?php
use yii\helpers\Url;

/** @var \common\models\shop\Product $products */

?>

<div class="col-4">
                    <div class="block-header">
                        <a href="<?= Url::to(['product-list/insektitsidi']) ?>"
                        <h3 class="block-header__title">Інсектециди</h3>
                        </a>
                        <div class="block-header__divider"></div>
                    </div>
                    <div class="block-product-columns__column">

                    <?php foreach($products as $product): ?>
                        <div class="block-product-columns__item">
                            <div class="product-card product-card--hidden-actions product-card--layout--horizontal">

                                <?php if(isset($product->label)): ?>
                            <div class="product-card__badges-list">
                                <div class="product-card__badge product-card__badge--hot"><?=$product->label->name?></div>
                            </div>
                            <?php endif; ?>

                                <div class="product-card__image product-image">
                                <a href="<?=Url::to(['product/view', 'slug' => $product->slug])?>" class="product-image__body">
                                        <img class="product-image__img" src="<?=$product->getImgOne($product->getId())?>" alt="">
                                    </a>
                                </div>

                                <div class="product-card__info">
                                    <div class="product-card__name">
                                    <a href="<?=Url::to(['product/view', 'slug' => $product->slug])?>"><?=$product->name?></a>
                                    </div>
                                    <div class="product-card__rating">
                                        <div class="product-card__rating-stars">
                                            <?=$product->getRating($product->id, 13, 12)?>
                                        </div>
                                        <div class="product-card__rating-legend"><?=count($product->reviews)?> відгуків</div>
                                    </div>
                                </div>
                                <div class="product-card__actions">
                                    <div class="product-card__prices">
                                    <?= Yii::$app->formatter->asCurrency($product->getPrice())?>
                                        <div class="form-group product__option">
                                        <span class="text-success" style="padding: 3px 1px">
                                <?php
                                if ($product->status_id == 1) {
                                    echo '<i style="font-size:1rem; margin: 5px;" class="fas fa-check"></i> ' . $product->status->name;
                                } elseif ($product->status_id == 2) {
                                    echo '<i style="font-size:1rem; color: #ff0000!important; margin: 5px;" class="fas fa-ban"></i> ';
                                    echo "<span style='color: #ff0000 !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                } elseif ($product->status_id == 3) {
                                    echo '<i style="font-size:1rem; color: #ff8300!important; margin: 5px;" class="fas fa-truck"></i> ';
                                    echo "<span style='color: #ff8300 !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                } elseif ($product->status_id == 4) {
                                    echo '<i style="font-size:1rem; color: #0331fc!important; margin: 5px;" class="fa fa-bars"></i> ';
                                    echo "<span style='color: #0331fc !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                } else {
                                    echo "<span style='color: #060505!important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                }
                                ?>
                            </span>

                                        </div>
                                    </div>
                                    <div class="product-card__buttons">
                                        <button class="btn btn-primary product-card__addtocart "
                                                type="button"
                                                data-product-id="<?=$product->id?>">
                                            <?= !$product->getIssetToCart($product->id) ? 'В Кошик' : 'Уже в кошику' ?>
                                        </button>
                                        <button class="btn btn-secondary product-card__addtocart product-card__addtocart--list"
                                                type="button"
                                                data-product-id="<?=$product->id?>">
                                            <?= !$product->getIssetToCart($product->id) ? 'В Кошик' : 'Уже в кошику' ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>