<?php

use common\models\shop\ActivePages;
use common\models\shop\ProductImage;
use frontend\assets\PostPageAsset;
use frontend\widgets\LatestProduct;
use frontend\widgets\ProductsCarousel;
use frontend\widgets\TagCloud;
use kartik\rating\StarRating;
use yii\helpers\Url;

/** @var \common\models\Posts $postItem */
/** @var \common\models\Posts $blogs */
/** @var \common\models\PostProducts $products_id */
/** @var \common\models\shop\Product $products */

PostPageAsset::register($this);
ActivePages::setActiveUser();
$webp_support = ProductImage::imageWebp();
$request = Yii::$app->request;
$currentUrl = $request->absoluteUrl;

?>
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/"> <i class="fas fa-home"></i> <?=Yii::t('app', 'Головна')?></a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= Url::to(['blogs/view']) ?>"><?=Yii::t('app', 'Статті')?></a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $postItem->title ?></li>
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
                        <h1 class="post-header__title"><?= $postItem->title ?></h1>
                        <div class="post-header__meta">
                            <div class="post-header__meta-item">
                                <a><?= Yii::$app->formatter->asDate($postItem->date_public) ?></a></div>
                        </div>
                    </div>
                    <div class="post__featured">
                        <?php if (Yii::$app->devicedetect->isMobile()) { ?>
                            <?php if ($webp_support == true && isset($post->webp_extra_large)) { ?>
                                <img src="/posts/<?= $postItem->webp_extra_large ?>" alt="<?= $postItem->title ?>">
                            <?php } else { ?>
                                <img src="/posts/<?= $postItem->extra_large ?>" alt="<?= $postItem->title ?>">
                            <?php } ?>
                        <?php } else { ?>
                            <?php if ($webp_support == true && isset($postItem->webp_image)) { ?>
                                <img src="/posts/<?= $postItem->webp_image ?>" alt="<?= $postItem->title ?>">
                            <?php } else { ?>
                                <img src="/posts/<?= $postItem->image ?>" alt="<?= $postItem->title ?>">
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="post__content typography ">
                        <p>
                            <?= $postItem->description ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="block block-sidebar block-sidebar--position--end">
                    <div class="block-sidebar__item">
                        <div class="widget-search">
                            <form class="widget-search__body" action="/search/blogs">
                                <input class="widget-search__input" name="f" placeholder="<?=Yii::t('app','Пошук статтів...')?>" type="text"
                                       autocomplete="off" spellcheck="false">
                                <button class="search__button widget-search__button" type="submit">
                                    <svg width="20px" height="20px">
                                        <use xlink:href="/images/sprite.svg#search-20"></use>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php if ($products) { ?>
                        <?php echo LatestProduct::widget(['products' => $products,]) ?>
                    <?php } ?>
                    <div class="block-sidebar__item">
                        <div class="widget-posts widget">
                            <h4 class="widget__title"><?=Yii::t('app', 'Останні статті')?></h4>
                            <div class="widget-posts__list">
                                <?php foreach ($blogs as $post): ?>
                                    <div class="widget-posts__item">
                                        <div class="widget-posts__image">
                                            <a href="<?= Url::to(['post/view', 'slug' => $post->slug]) ?>">
                                                <?php if ($webp_support == true && isset($post->webp_small)) { ?>
                                                    <img src="/posts/<?= $post->webp_small ?>"
                                                         width="89" height="60"
                                                         alt="<?= $post->title ?>">
                                                <?php } else { ?>
                                                    <img src="/posts/<?= $post->small ?>"
                                                         width="89" height="60"
                                                         alt="<?= $post->title ?>">
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
                    <?php echo TagCloud::widget(['productsId' => $products_id]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <?php echo ProductsCarousel::widget() ?>
</div>
<div class="container reviews-view">
    <div class="reviews-view__list">
        <?php if ($postItem->reviews) { ?>
            <h3 class="reviews-view__header"><?=Yii::t('app', 'Відгуки читачів')?></h3>
        <?php } ?>
        <div class="reviews-list">
            <ol class="reviews-list__content">
                <?php foreach ($postItem->reviews as $review):
                    $rating = $review->rating;
                    ?>
                    <li class="reviews-list__item">
                        <div class="review">
                            <div class="review__avatar">
                                <?php $avatar = $review->getAvatar($review->id) ?>
                                <img src="/images/avatars/<?= $avatar ?>.jpg"
                                     width="70" height="70"
                                     alt="<?= $avatar ?>">
                            </div>
                            <div class="review__content">
                                <div class="review__author"><?= $review->name ?></div>
                                <div class="review__rating">
                                    <div class="rating">
                                        <div class="rating__body">
                                            <?php if ($rating != 0): ?>
                                                <?php for ($i = 1; $i <= $rating; $i++): ?>
                                                    <svg class="rating__star rating__star--active"
                                                         width="16px" height="15px">
                                                        <g class="rating__fill">
                                                            <use xlink:href="/images/sprite.svg#star-normal"></use>
                                                        </g>
                                                        <g class="rating__stroke">
                                                            <use xlink:href="/images/sprite.svg#star-normal-stroke"></use>
                                                        </g>
                                                    </svg>
                                                    <div class="rating__star rating__star--only-edge rating__star--active">
                                                        <div class="rating__fill">
                                                            <div class="fake-svg-icon"></div>
                                                        </div>
                                                        <div class="rating__stroke">
                                                            <div class="fake-svg-icon"></div>
                                                        </div>
                                                    </div>
                                                <?php endfor; ?>
                                                <?php if (5 - $rating != 0): ?>
                                                    <?php for ($i = 1; $i <= 5 - $rating; $i++): ?>
                                                        <svg class="rating__star " width="16px"
                                                             height="15px">
                                                            <g class="rating__fill">
                                                                <use xlink:href="/images/sprite.svg#star-normal"></use>
                                                            </g>
                                                            <g class="rating__stroke">
                                                                <use xlink:href="/images/sprite.svg#star-normal-stroke"></use>
                                                            </g>
                                                        </svg>
                                                        <div class="rating__star rating__star--only-edge ">
                                                            <div class="rating__fill">
                                                                <div class="fake-svg-icon"></div>
                                                            </div>
                                                            <div class="rating__stroke">
                                                                <div class="fake-svg-icon"></div>
                                                            </div>
                                                        </div>
                                                    <?php endfor; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <svg class="rating__star " width="16px"
                                                         height="15px">
                                                        <g class="rating__fill">
                                                            <use xlink:href="/images/sprite.svg#star-normal"></use>
                                                        </g>
                                                        <g class="rating__stroke">
                                                            <use xlink:href="/images/sprite.svg#star-normal-stroke"></use>
                                                        </g>
                                                    </svg>
                                                    <div class="rating__star rating__star--only-edge ">
                                                        <div class="rating__fill">
                                                            <div class="fake-svg-icon"></div>
                                                        </div>
                                                        <div class="rating__stroke">
                                                            <div class="fake-svg-icon"></div>
                                                        </div>
                                                    </div>
                                                <?php endfor; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="review__text"><?= $review->message ?></div>
                                <div class="review__date"><?= Yii::$app->formatter->asDate($review->created_at) ?></div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
    <form id="form-review">
        <h3 class="reviews-view__header"><?=Yii::t('app', 'Залишити відгук')?></h3>
        <div class="row">
            <div class="col-12 col-lg-9 col-xl-8">
                <input type="hidden" name="post_id" value="<?= $postItem->id ?>">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="w0"><?=Yii::t('app', 'Ваша оцінка')?></label>
                        <?php
                        echo StarRating::widget([
                            'name' => 'starrating',
                            'language' => 'uk',
                            'value' => 5,
                            'pluginOptions' => [
                                'min' => 0,
                                'max' => 5,
                                'step' => 1,
                                'size' => 'sm',
                                'showClear' => false,
                                'showCaption' => false,
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="form-group col-md-4" id="url-review"
                    data-url-review="<?= Yii::$app->urlManager->createUrl(['posts-review/create']) ?>">
                        <label for="review-name"><?=Yii::t('app', 'Ваше ім\'я')?></label>
                        <input type="text" name="name" class="form-control" id="review-name"
                               oninvalid="this.setCustomValidity('Укажіть будь ласка Ваше ім’я')"
                               oninput="this.setCustomValidity('')"
                               placeholder="Ваше ім’я" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="review-email">Email</label>
                        <input type="text" name="email" class="form-control" id="review-email"
                               placeholder="Email"
                               oninvalid="this.setCustomValidity('Укажіть будь ласка Ваш email')"
                               oninput="this.setCustomValidity('')"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="review-text"><?=Yii::t('app', 'Ваш відгук')?></label>
                    <textarea class="form-control" name="message" id="review-text"
                              rows="6" oninvalid="this.setCustomValidity('Напишіть будь ласка Ваш відгук')"
                              oninput="this.setCustomValidity('')"
                              required></textarea>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" id="review-form-submit" class="btn btn-primary btn-lg">
                        <?=Yii::t('app', 'Залишити відгук')?>
                    </button>
                    <div class="alert alert-success" style="display: none;" id="success-message" role="alert">
                        <?=Yii::t('app', 'Вітаемо Ваш відгук -- надіслано !!!')?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="additional-text" style="display: none;"><?= $currentUrl ?></div>
<style>
    #success-message {
        position: absolute;
        top: -24%;
        left: 15px;
        width: 95%;
    }

    #form-review {
        position: relative;
    }
</style>

<?php
$js = <<<JS
     $('#review-form-submit').click(function(event) {
        event.preventDefault();
     var postId = $('input[name=post_id]').val();
     var star = $('input[name=starrating]').val();
     var name = $('input[name=name]').val();
     var email = $('input[name=email]').val();
     var mess = $('textarea[name=message]').val();
     var urlReview = $('#url-review').data('url-review');
     if(name !== ''){
     $.ajax({
         url: urlReview,
         type: 'post',
         data: {
             id: postId,
             rating: star,
             name: name,
             email: email,
             mess: mess
             },
         success: function(data){
             $('#form-review')[0].reset();
              $('#success-message').fadeIn(); // Показать сообщение

    setTimeout(function() {
        $('#success-message').fadeOut(); // Скрыть сообщение после 2 секунд
    }, 2500);
             $('.reviews-list__content').html(data);
         },
         error: function(data){
             console.log("error",data) 
         }
     });
     
      }    
     return false;
});

 document.addEventListener('copy', function(e) {
    var selectedText = window.getSelection().toString();
    var additionalText = document.getElementById('additional-text').textContent;
    var link1 = '<a href="';
    var link2 = '">';
    var link3 = '</a>';
    
    if (selectedText && additionalText && selectedText.length > 20) {
        var copiedText = selectedText + link1 + additionalText 
        + link2 + ' Детальніше на: ' + additionalText + link3 ;
        e.clipboardData.setData('text/html', copiedText);
        e.clipboardData.setData('text/plain', copiedText);
        e.preventDefault();
    }
});

JS;
$this->registerJs($js);

?>
