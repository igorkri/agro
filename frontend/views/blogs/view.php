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
                                <?php foreach ($posts as $post ): ?>
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
                                    <a class="page-link page-link--with-arrow" href="" aria-label="Previous">
                                        <svg class="page-link__arrow page-link__arrow--left" aria-hidden="true" width="8px" height="13px">
                                            <use xlink:href="images/sprite.svg#arrow-rounded-left-8x13"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="">1</a></li>
                                <li class="page-item active"><a class="page-link" href="">2 <span class="sr-only">(current)</span></a></li>
                                <li class="page-item"><a class="page-link" href="">3</a></li>
                                <li class="page-item">
                                    <a class="page-link page-link--with-arrow" href="" aria-label="Next">
                                        <svg class="page-link__arrow page-link__arrow--right" aria-hidden="true" width="8px" height="13px">
                                            <use xlink:href="images/sprite.svg#arrow-rounded-right-8x13"></use>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Пагінація /end -->
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="block block-sidebar block-sidebar--position--end">
                    <!-- Категорії -->
                    <div class="block-sidebar__item">
                        <div class="widget-categories widget-categories--location--blog widget">
                            <h4 class="widget__title">Категорії</h4>
                            <ul class="widget-categories__list" data-collapse data-collapse-opened-class="widget-categories__item--open">
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg>
                                            Latest News
                                        </a>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg>
                                            Special Offers
                                        </a>
                                        <button class="widget-categories__expander" type="button" data-collapse-trigger></button>
                                    </div>
                                    <div class="widget-categories__subs" data-collapse-content>
                                        <ul>
                                            <li><a href="">Spring Sales</a></li>
                                            <li><a href="">Summer Sales</a></li>
                                            <li><a href="">Autumn Sales</a></li>
                                            <li><a href="">Christmas Sales</a></li>
                                            <li><a href="">Other Sales</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg>
                                            New Arrivals
                                        </a>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg>
                                            Reviews
                                        </a>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg>
                                            Drills and Mixers
                                        </a>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg>
                                            Cordless Screwdrivers
                                        </a>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg>
                                            Screwdrivers
                                        </a>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg>
                                            Wrenches
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Категорії /end -->

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
