<?php

use frontend\widgets\TagCloud;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

\common\models\shop\ActivePages::setActiveUser();

?>
<!-- site__body -->
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/"> <i class="fas fa-home"></i>  Головна</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Статті</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="block">
                    <div class="posts-view">
                        <!-- Пости -->
                        <div class="posts-view__list posts-list posts-list--layout--list">
                            <div class="posts-list__body">
                                <?php foreach ($blogs as $post ): ?>
                                <div class="posts-list__item">
                                    <div class="post-card post-card--layout--list post-card--size--nl">
                                        <div class="post-card__image">
                                            <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>">
                                                <img src="/posts/<?= $post->image ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="post-card__info">
                                            <div class="post-card__category">
                                            </div>
                                            <div class="post-card__name">
                                                <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>"><?= $post->title ?></a>
                                            </div>
                                            <div class="post-card__date"><?= Yii::$app->formatter->asDate($post->date_public) ?></div>
                                            <div class="post-card__content">
                                                <?= $post->description ?>
                                            </div>
                                            <div class="post-card__read-more">
                                                <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>" class="btn btn-secondary btn-sm">Докладніше...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Пости /end -->

                        <!-- Пагінація -->
                        <div class="posts-view__pagination">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
<!--                                    --><?php //= LinkPager::widget(['pagination' => $pages,]) ?>
                                </li>
                            </ul>
                        </div>
                        <!-- Пагінація /end -->
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="block block-sidebar block-sidebar--position--end">
                    <!-- Хмара тегів -->
                    <?php echo TagCloud::widget() ?>
                    <!-- Хмара тегів /end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- site__body / end -->
