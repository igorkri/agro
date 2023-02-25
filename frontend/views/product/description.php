<?php
use yii\helpers\Url;

/** @var \common\models\shop\Product $product */

?>


<div class="product-tabs  product-tabs--sticky">
                        <div class="product-tabs__list">
                            <div class="product-tabs__list-body">
                                <div class="product-tabs__list-container container">
                                    <a href="#tab-description" class="product-tabs__item product-tabs__item--active">Опис</a>
                                    <a href="#tab-specification" class="product-tabs__item">Specification</a>
                                    <a href="#tab-reviews" class="product-tabs__item">Reviews</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-tabs__content">
                            <div class="product-tabs__pane product-tabs__pane--active" id="tab-description">
                                <div class="typography">
                                    <?= $product->description ?>
                                </div>
                            </div>
                            <div class="product-tabs__pane" id="tab-specification">
                                <div class="spec">
                                    <h3 class="spec__header">Specification</h3>
                                    <div class="spec__section">
                                        <h4 class="spec__section-title">General</h4>
                                        <div class="spec__row">
                                            <div class="spec__name">Material</div>
                                            <div class="spec__value">Aluminium, Plastic</div>
                                        </div>
                                        <div class="spec__row">
                                            <div class="spec__name">Engine Type</div>
                                            <div class="spec__value">Brushless</div>
                                        </div>
                                        <div class="spec__row">
                                            <div class="spec__name">Battery Voltage</div>
                                            <div class="spec__value">18 V</div>
                                        </div>
                                        <div class="spec__row">
                                            <div class="spec__name">Battery Type</div>
                                            <div class="spec__value">Li-lon</div>
                                        </div>
                                        <div class="spec__row">
                                            <div class="spec__name">Number of Speeds</div>
                                            <div class="spec__value">2</div>
                                        </div>
                                        <div class="spec__row">
                                            <div class="spec__name">Charge Time</div>
                                            <div class="spec__value">1.08 h</div>
                                        </div>
                                        <div class="spec__row">
                                            <div class="spec__name">Weight</div>
                                            <div class="spec__value">1.5 kg</div>
                                        </div>
                                    </div>
                                    <div class="spec__section">
                                        <h4 class="spec__section-title">Dimensions</h4>
                                        <div class="spec__row">
                                            <div class="spec__name">Length</div>
                                            <div class="spec__value">99 mm</div>
                                        </div>
                                        <div class="spec__row">
                                            <div class="spec__name">Width</div>
                                            <div class="spec__value">207 mm</div>
                                        </div>
                                        <div class="spec__row">
                                            <div class="spec__name">Height</div>
                                            <div class="spec__value">208 mm</div>
                                        </div>
                                    </div>
                                    <div class="spec__disclaimer">
                                        Information on technical characteristics, the delivery set, the country of manufacture and the appearance
                                        of the goods is for reference only and is based on the latest information available at the time of publication.
                                    </div>
                                </div>
                            </div>
                            <div class="product-tabs__pane" id="tab-reviews">
                                <div class="reviews-view">
                                    <div class="reviews-view__list">
                                        <h3 class="reviews-view__header">Customer Reviews</h3>
                                        <div class="reviews-list">
                                            <ol class="reviews-list__content">
                                                <li class="reviews-list__item">
                                                    <div class="review">
                                                        <div class="review__avatar"><img src="/images/avatars/avatar-1.jpg" alt=""></div>
                                                        <div class="review__content">
                                                            <div class="review__author">Samantha Smith</div>
                                                            <div class="review__rating">
                                                                <div class="rating">
                                                                    <div class="rating__body">
                                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
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
                                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
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
                                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
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
                                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
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
                                                                        <svg class="rating__star " width="13px" height="12px">
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="review__text">Phasellus id mattis nulla. Mauris velit nisi, imperdiet vitae sodales in, maximus ut lectus. Vivamus commodo scelerisque lacus, at porttitor dui iaculis id. Curabitur imperdiet ultrices fermentum.</div>
                                                            <div class="review__date">27 May, 2018</div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="reviews-list__item">
                                                    <div class="review">
                                                        <div class="review__avatar"><img src="/images/avatars/avatar-2.jpg" alt=""></div>
                                                        <div class="review__content">
                                                            <div class="review__author">Adam Taylor</div>
                                                            <div class="review__rating">
                                                                <div class="rating">
                                                                    <div class="rating__body">
                                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
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
                                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
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
                                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
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
                                                                        <svg class="rating__star " width="13px" height="12px">
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
                                                                        <svg class="rating__star " width="13px" height="12px">
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="review__text">Aenean non lorem nisl. Duis tempor sollicitudin orci, eget tincidunt ex semper sit amet. Nullam neque justo, sodales congue feugiat ac, facilisis a augue. Donec tempor sapien et fringilla facilisis. Nam maximus consectetur diam. Nulla ut ex mollis, volutpat tellus vitae, accumsan ligula.</div>
                                                            <div class="review__date">12 April, 2018</div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="reviews-list__item">
                                                    <div class="review">
                                                        <div class="review__avatar"><img src="/images/avatars/avatar-3.jpg" alt=""></div>
                                                        <div class="review__content">
                                                            <div class="review__author">Helena Garcia</div>
                                                            <div class="review__rating">
                                                                <div class="rating">
                                                                    <div class="rating__body">
                                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
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
                                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
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
                                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
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
                                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
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
                                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="review__text">Duis ac lectus scelerisque quam blandit egestas. Pellentesque hendrerit eros laoreet suscipit ultrices.</div>
                                                            <div class="review__date">2 January, 2018</div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ol>
                                            <div class="reviews-list__pagination">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link page-link--with-arrow" href="" aria-label="Previous">
                                                            <svg class="page-link__arrow page-link__arrow--left" aria-hidden="true" width="8px" height="13px">
                                                                <use xlink:href="/images/sprite.svg#arrow-rounded-left-8x13"></use>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="">1</a></li>
                                                    <li class="page-item active"><a class="page-link" href="">2 <span class="sr-only">(current)</span></a></li>
                                                    <li class="page-item"><a class="page-link" href="">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link page-link--with-arrow" href="" aria-label="Next">
                                                            <svg class="page-link__arrow page-link__arrow--right" aria-hidden="true" width="8px" height="13px">
                                                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-8x13"></use>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="reviews-view__form">
                                        <h3 class="reviews-view__header">Write A Review</h3>
                                        <div class="row">
                                            <div class="col-12 col-lg-9 col-xl-8">
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="review-stars">Review Stars</label>
                                                        <select id="review-stars" class="form-control">
                                                            <option>5 Stars Rating</option>
                                                            <option>4 Stars Rating</option>
                                                            <option>3 Stars Rating</option>
                                                            <option>2 Stars Rating</option>
                                                            <option>1 Stars Rating</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="review-author">Your Name</label>
                                                        <input type="text" class="form-control" id="review-author" placeholder="Your Name">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="review-email">Email Address</label>
                                                        <input type="text" class="form-control" id="review-email" placeholder="Email Address">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="review-text">Your Review</label>
                                                    <textarea class="form-control" id="review-text" rows="6"></textarea>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-lg">Post Your Review</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                