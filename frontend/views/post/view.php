<?php

use yii\helpers\Url;

?>
<!-- site__body -->
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">Головна</a>
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
                        <h2 class="post-header__title"><?= $post->title ?></h2>
                        <div class="post-header__meta">
                            <div class="post-header__meta-item"><a href=""><?= $post->date_public ?></a></div>
                        </div>
                    </div>
                    <div class="post__featured">
                        <a href="">
                            <img src="/posts/<?= $post->image ?>" alt="">
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
                    <!--- Останні статті --->
                    <div class="block-sidebar__item">
                        <div class="widget-posts widget">
                            <h4 class="widget__title">Останні статті</h4>
                            <div class="widget-posts__list">
                                <?php foreach ($blogs as $post): ?>
                                <div class="widget-posts__item">
                                    <div class="widget-posts__image">
                                        <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>">
                                            <img src="/posts/<?= $post->image ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="widget-posts__info">
                                        <div class="widget-posts__name">
                                            <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>"><?= $post->title ?></a>
                                        </div>
                                        <div class="widget-posts__date"><?=$post->date_public ?></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!--- Останні статті /end --->

                    <!--- Хмара тегів /end --->
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
                    <!--- Хмара тегів /end --->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- site__body / end -->