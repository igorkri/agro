<?php

/** @var \common\models\shop\Category $categories */

use yii\helpers\Url;

?>

<div class="block block--highlighted block-categories block-categories--layout--classic">
    <div class="container">
        <div class="block-header">
            <h3 class="block-header__title">Популярні Категорії</h3>
            <div class="block-header__divider"></div>
        </div>
        <div class="block-categories__list">
            <div class="block-categories__item category-card category-card--layout--classic">
                <div class="category-card__body">
                    <div class="category-card__image">
                        <a href="<?= Url::to(['/catalog/nazva-dlya-vidobrazhennya-seo']) ?>"><img src="/category/<?= $categories[0]->file ?>" alt=""></a>
                    </div>
                    <div class="category-card__content">
                        <div class="category-card__name">
                            <a href="<?= Url::to(['/catalog/nazva-dlya-vidobrazhennya-seo']) ?>"><?= $categories[0]->name ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i = 1;
            foreach ($categories as $category): ?>
                <?php if ($i >= 2): ?>
                    <div class="block-categories__item category-card category-card--layout--classic">
                        <div class="category-card__body">
                            <div class="category-card__image">
                                <?php if ($category->parentId == null) { ?>
                                <a href="<?= Url::to(['/catalog/'. $category->slug]) ?>"><img src="/category/<?= $category->file ?>" alt=""></a>
                                <?php } else { ?>
                                <a href="<?= Url::to(['/product-list/'. $category->slug]) ?>"><img src="/category/<?= $category->file ?>" alt=""></a>
                                <?php } ?>
                            </div>
                            <div class="category-card__content">
                                <div class="category-card__name">
                                    <?php if ($category->parentId == null) { ?>
                                    <a href="<?= Url::to(['/catalog/'. $category->slug]) ?>"><?= $category->name ?></a>
                                    <?php } else { ?>
                                    <a href="<?= Url::to(['/product-list/'. $category->slug]) ?>"><?= $category->name ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            <?php $i++; endforeach; ?>
        </div>
    </div>
</div>