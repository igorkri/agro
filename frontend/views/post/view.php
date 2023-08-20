<?php

use common\models\shop\ActivePages;
use frontend\widgets\ProductsCarousel;
use frontend\widgets\TagCloud;
use yii\helpers\Url;

ActivePages::setActiveUser();

if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false) {
    $webp_support = true; // webp поддерживается
} else {
    $webp_support = false; // webp не поддерживается
}

?>
<!-- site__body -->
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/"> <i class="fas fa-home"></i> Головна</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= Url::to(['blogs/view']) ?>">Статті</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $post->title ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="block post post--layout--classic">
                    <div class="post__header post-header post-header--layout--classic">
                        <h1 class="post-header__title"><?= $post->title ?></h1>
                        <div class="post-header__meta">
                            <div class="post-header__meta-item">
                                <a><?= Yii::$app->formatter->asDate($post->date_public) ?></a></div>
                        </div>
                    </div>
                    <div class="post__featured">
                        <?php if (Yii::$app->devicedetect->isMobile()) { ?>
                            <?php if ($webp_support == true && isset($post->webp_extra_large)) { ?>
                                <img src="/posts/<?= $post->webp_extra_large ?>" alt="<?= $post->title ?>">
                            <?php } else { ?>
                                <img src="/posts/<?= $post->extra_large ?>" alt="<?= $post->title ?>">
                            <?php } ?>
                        <?php } else { ?>
                            <?php if ($webp_support == true && isset($post->webp_image)) { ?>
                                <img src="/posts/<?= $post->webp_image ?>" alt="<?= $post->title ?>">
                            <?php } else { ?>
                                <img src="/posts/<?= $post->image ?>" alt="<?= $post->title ?>">
                            <?php } ?>
                        <?php } ?>
                        </a>
                    </div>
                    <div class="post__content typography ">
                        <p>
                            <?= $post->description ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="block block-sidebar block-sidebar--position--end">
                    <div class="block-sidebar__item">
                        <div class="widget-search">
                            <form class="widget-search__body">
                                <input class="widget-search__input" placeholder="Blog search..." type="text"
                                       autocomplete="off" spellcheck="false">
                                <button class="widget-search__button" type="submit">
                                    <svg width="20px" height="20px">
                                        <use xlink:href="/images/sprite.svg#search-20"></use>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!--- Останні статті --->
                    <div class="block-sidebar__item">
                        <div class="widget-posts widget">
                            <h4 class="widget__title">Останні статті</h4>
                            <div class="widget-posts__list">
                                <?php foreach ($blogs as $post): ?>
                                    <div class="widget-posts__item">
                                        <div class="widget-posts__image">
                                            <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>">
                                                <?php if ($webp_support == true && isset($post->webp_small)) { ?>
                                                <img src="/posts/<?= $post->webp_small ?>" alt="<?= $post->title ?>">
                                                <?php }else{ ?>
                                                    <img src="/posts/<?= $post->small ?>" alt="<?= $post->title ?>">
                                                <?php } ?>
                                            </a>
                                        </div>
                                        <div class="widget-posts__info">
                                            <div class="widget-posts__name">
                                                <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>"><?= $post->title ?></a>
                                            </div>
                                            <div class="widget-posts__date"><?= Yii::$app->formatter->asDate($post->date_public) ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!--- Останні статті /end --->

                    <!--- Хмара тегів /end --->
                    <?php echo TagCloud::widget() ?>
                    <!--- Хмара тегів /end --->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <!-- .block-products-carousel -->
    <?php echo ProductsCarousel::widget() ?>
    <!-- .block-products-carousel / end -->
</div>
<!-- site__body / end -->