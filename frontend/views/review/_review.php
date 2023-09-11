<?php

use kartik\rating\StarRating;

?>

<ol class="reviews-list__content">
    <?php foreach ($product->reviews as $review):
        $rating = $review->rating;
        ?>
        <li class="reviews-list__item">
            <div class="review">
                <div class="review__avatar"><img src="/images/avatars/avatar-1.jpg" alt=""></div>
                <div class="review__content">
                    <div class="review__author"><?= $review->name ?></div>
                    <div class="review__rating">
                        <div class="rating">
                            <div class="rating__body">
                                <?php if ($rating != 0): ?>
                                    <?php for ($i = 1; $i <= $rating; $i++): ?>
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
                                    <?php if (5 - $rating != 0): ?>
                                        <?php for ($i = 1; $i <= 5 - $rating; $i++): ?>
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
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
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
                    <div class="review__text"><?= $review->message ?></div>
                    <div class="review__date"><?= Yii::$app->formatter->asDate($review->created_at) ?></div>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ol>

