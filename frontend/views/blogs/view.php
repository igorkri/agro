<?php

use yii\bootstrap5\LinkPager;

?>
<!-- site__body -->
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="">Breadcrumb</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Latest News</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
<!--                <h1>Статті</h1>-->
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
                                            <a href="/">
                                                <img src="/posts/<?= $post->image ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="post-card__info">
                                            <div class="post-card__category">
<!--                                                <a href="">Special Offers</a>-->
                                            </div>
                                            <div class="post-card__name">
                                                <a href="/"><?= $post->title ?></a>
                                            </div>
                                            <div class="post-card__date"><?= $post->date_public ?></div>
                                            <div class="post-card__content">
                                                <?= $post->description ?>
                                            </div>
                                            <div class="post-card__read-more">
                                                <a href="" class="btn btn-secondary btn-sm">Читати більше...</a>
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
                    <div class="block-sidebar__item">
                        <div class="widget-tags widget">
                            <h4 class="widget__title">Хмара тегів</h4>
                            <div class="tags tags--lg">
                                <div class="tags__list">
                                   <?php foreach ($tags as $tag): ?>
                                    <a href="/"><?= $tag->name ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Хмара тегів /end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- site__body / end -->
