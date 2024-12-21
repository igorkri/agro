<?php

use common\models\shop\ActivePages;
use common\models\shop\Product;
use frontend\assets\TagPageAsset;
use frontend\controllers\TagController;
use frontend\widgets\ViewProduct;
use yii\helpers\Html;
use yii\helpers\Url;

TagPageAsset::register($this);
ActivePages::setActiveUser();

/** @var Product $products */
/** @var Product $pages */
/** @var TagController $tag_name */
/** @var TagController $language */
/** @var TagController $products_all */

?>
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/"> <i class="fas fa-home"></i> <?= Yii::t('app', 'Головна') ?></a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= Url::to(['tag/index']) ?>"> <?= Yii::t('app', 'Теги') ?></a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active"
                            aria-current="page"><?= Yii::t('app', 'Продукти запиту') ?>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1><?= Yii::t('app', 'Продукти пов`язані тегом ') ?>
                    "<?= $tag_name->getTagTranslate($tag_name, $language) ?>"</h1>
            </div>
        </div>
    </div>
    <?php
    echo Html::beginForm(Url::current(), 'post', ['class' => 'form-inline']); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="block">
                    <div class="products-view">
                        <div class="products-view__options">
                            <div class="view-options view-options--offcanvas--always">
                                <?= $this->render('@frontend/views/layouts/products-sort.php', [
                                    'products' => $products,
                                    'products_all' => $products_all,
                                ]) ?>
                            </div>
                        </div>
                        <?= $this->render('@frontend/views/layouts/products-list.php', ['products' => $products]) ?>
                        <?= $this->render('@frontend/views/layouts/pagination.php', ['pages' => $pages]) ?>
                        <br>
                        <div class="spec__disclaimer">
                            <?= $tag_name->getDescriptionTranslate($tag_name, $language) ?>
                        </div>
                        <br>
                        <?php if (Yii::$app->session->get('viewedProducts', [])) echo ViewProduct::widget() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo Html::hiddenInput('id', $tag_name->id);
    echo Html::endForm();
    ?>
</div>