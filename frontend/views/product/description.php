<?php

use kartik\form\ActiveForm;
use kartik\rating\StarRating;
use yii\helpers\Url;

/** @var \common\models\shop\Product $product */

$rating = 3;
?>

<div class="product-tabs  product-tabs--sticky">
    <div class="product-tabs__list">
        <div class="product-tabs__list-body">
            <div class="product-tabs__list-container container">
                <a href="#tab-description" class="product-tabs__item product-tabs__item--active">Опис</a>
<!--                <a href="#tab-specification" class="product-tabs__item">Specification</a>-->
                <a href="#tab-reviews" class="product-tabs__item">Відгуки</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="product-tabs__content">
            <div class="product-tabs__pane product-tabs__pane--active" id="tab-description">
                <div class="typography">
                    <?= $product->description ?>
                </div>
            </div>
            <div class="product-tabs__pane" id="tab-reviews">
                <div class="reviews-view">
                    <div class="reviews-view__list">
                        <h3 class="reviews-view__header">Відгуки покупців</h3>
                        <div class="reviews-list">
                            <ol class="reviews-list__content">
                                <?php foreach ($product->reviews as $review):
                                    $rating = $review->rating;
                                    ?>
                                <li class="reviews-list__item">
                                    <div class="review">
<!--                                        <div class="review__avatar"><img src="/images/avatars/avatar-1.jpg" alt=""></div>-->
                                        <div class="review__content">
                                            <div class="review__author"><?=$review->name?></div>
                                            <div class="review__rating">
                                                <div class="rating">
                                                    <div class="rating__body">
                                                        <?php if($rating != 0): ?>
                                                            <?php for($i = 1; $i <= $rating; $i++): ?>
                                                                <svg class="rating__star rating__star--active" width="16px" height="15px">
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
                                                            <?php if(5 - $rating != 0): ?>
                                                                <?php for($i = 1; $i <= 5 - $rating; $i++): ?>
                                                                    <svg class="rating__star " width="16px" height="15px">
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
                                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                                <svg class="rating__star " width="16px" height="15px">
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
                                            <div class="review__text"><?=$review->message?></div>
                                            <div class="review__date"><?= Yii::$app->formatter->asDate($review->created_at) ?></div>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ol>

                        </div>
                    </div>
                    <form id="form-review">
                    <h3 class="reviews-view__header">Залишити відгук</h3>
                    <div class="row">
                        <div class="col-12 col-lg-9 col-xl-8">
                            <input type="hidden" name="product_id" value="<?=$product->id?>">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="review-author">Ваша оцінка</label>
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
                                <div class="form-group col-md-4">
                                    <label for="review-author">Ваше ім'я</label>
                                    <input type="text" name="name" class="form-control"
                                           oninvalid="this.setCustomValidity('Укажіть будь ласка Ваше ім’я')"
                                           oninput="this.setCustomValidity('')"
                                           placeholder="Ваше ім’я" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="review-email">Email</label>
                                    <input type="text" name="email" class="form-control" id="review-email" placeholder="Email"
                                           oninvalid="this.setCustomValidity('Укажіть будь ласка Ваш email')"
                                           oninput="this.setCustomValidity('')"
                                           required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="review-text">Ваш відгук</label>
                                <textarea class="form-control" name="message" id="review-text" rows="6"></textarea>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" id="review-form-submit" class="btn btn-primary btn-lg">Залишити відгук</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .rating-md {
        font-size: 22px;
    }
</style>

<?php
$js = <<<JS
     $('#review-form-submit').click(function(event) {
        event.preventDefault();
     var productId = $('input[name=product_id]').val();
     var star = $('input[name=starrating]').val();
     var name = $('input[name=name]').val();
     var email = $('input[name=email]').val();
     var mess = $('textarea[name=message]').val();
      if(name != ''){
     $.ajax({
         url: '/review/create',
         type: 'post',
         data: {
             id: productId,
             rating: star,
             name: name,
             email: email,
             mess: mess
             },
         success: function(data){
             $('#form-review')[0].reset();
             $('.reviews-list__content').html(data);
         },
         error: function(data){
             console.log("error",data) 
         }
     });
     
      }    
     return false;
     // }).on('submit', function(e){
     // e.preventDefault();
   
});

JS;
$this->registerJs($js);

?>