<?php

use yii\helpers\Url;

?>
<!-- .block-posts -->
<div class="block block-posts" data-layout="grid-4" data-mobile-columns="2">
    <div class="container">
        <div class="block-header">
            <h3 class="block-header__title">Статті</h3>
            <div class="block-header__divider"></div>
            <div class="block-header__arrows-list">
                <button class="block-header__arrow block-header__arrow--left" type="button" aria-label="Left">
                    <svg width="7px" height="11px">
                        <use xlink:href="images/sprite.svg#arrow-rounded-left-7x11"></use>
                    </svg>
                </button>
                <button class="block-header__arrow block-header__arrow--right" type="button" aria-label="Right">
                    <svg width="7px" height="11px">
                        <use xlink:href="images/sprite.svg#arrow-rounded-right-7x11"></use>
                    </svg>
                </button>
            </div>
        </div>
        <?php if (Yii::$app->devicedetect->isMobile()) { ?>
            <div class="block-posts__slider">
                <div class="owl-carousel">
                    <?php foreach ($posts as $post): ?>
                        <div class="post-card">
                            <div class="post-card__image">
                                <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>">
                                    <?php if ($post->image != null) ?>
                                    <img src="posts/<?= $post->medium ?>" width="159" height="107"
                                         alt="<?= $post->title ?>">
                                </a>
                            </div>
                            <div class="post-card__info">
                                <div class="post-card__category">
                                    <!--                                        <a href="/">Special Offers</a>-->
                                </div>
                                <div class="post-card__name">
                                    <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>"><?= $post->title ?></a>
                                </div>
                                <div class="post-card__date"><?= Yii::$app->formatter->asDate($post->date_public) ?></div>
                                <div class="post-card__content">
                                    <?= $post->description ?>
                                </div>
                                <div class="post-card__read-more">
                                    <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>"
                                       class="btn btn-secondary btn-sm">Докладніше...</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="block-posts__slider">
                <div class="owl-carousel">
                    <?php foreach ($posts as $post): ?>
                        <div class="post-card">
                            <div class="post-card__image">
                                <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>">
                                    <?php if ($post->image != null) ?>
                                    <img src="posts/<?= $post->large ?>" width="263" height="177"
                                         alt="<?= $post->title ?>">
                                </a>
                            </div>
                            <div class="post-card__info">
                                <div class="post-card__category">
                                    <!--                                        <a href="/">Special Offers</a>-->
                                </div>
                                <div class="post-card__name">
                                    <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>"><?= $post->title ?></a>
                                </div>
                                <div class="post-card__date"><?= Yii::$app->formatter->asDate($post->date_public) ?></div>
                                <div class="post-card__content">
                                    <?= $post->description ?>
                                </div>
                                <div class="post-card__read-more">
                                    <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>"
                                       class="btn btn-secondary btn-sm">Докладніше...</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- .block-posts / end -->