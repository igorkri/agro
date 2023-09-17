<?php

use common\models\shop\ActivePages;
use yii\helpers\Url;

ActivePages::setActiveUser();

if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false) {
    $webp_support = true; // webp поддерживается
} else {
    $webp_support = false; // webp не поддерживается
}

?>
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
                        <li class="breadcrumb-item active" aria-current="page">Результати пошуку</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Результати пошуку</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="block">
                    <div class="posts-view">
                        <div class="posts-view__list posts-list posts-list--layout--grid2">
                            <div class="posts-list__body">
                                <?php foreach ($blogs as $post): ?>
                                    <div class="posts-list__item">
                                        <div class="post-card post-card--layout--grid post-card--size--nl">
                                            <div class="post-card__image">
                                                <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>">
                                                    <?php if ($webp_support == true && isset($post->webp_extra_large)) { ?>
                                                        <img src="/posts/<?= $post->webp_extra_large ?>" width="350"
                                                             height="235" alt="<?= $post->title ?>">
                                                    <?php } else { ?>
                                                        <img src="/posts/<?= $post->extra_large ?>" width="350"
                                                             height="235" alt="<?= $post->title ?>">
                                                    <?php } ?>
                                                </a>
                                            </div>
                                            <div class="post-card__info">
                                                <div class="post-card__category">
                                                    <a href="">Special Offers</a>
                                                </div>
                                                <div class="post-card__name">
                                                    <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>"><?= $post->title ?></a>
                                                </div>
                                                <div class="post-card__date"><?= Yii::$app->formatter->asDate($post->date_public) ?></div>
                                                <div class="post-card__content">
                                                    <?= $post->description ?>
                                                </div>
                                                <div class="post-card__read-more">
                                                    <a href="" class="btn btn-secondary btn-sm">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>