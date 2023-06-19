<?php

use yii\helpers\Url;

?>
<div class="block-slideshow block-slideshow--layout--with-departments block">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 d-none d-lg-block"></div>
            <div class="col-12 col-lg-9">
                <div class="block-slideshow__body">
                    <div class="owl-carousel">
                        <?php foreach ($slides as $index => $slide): ?>
                            <div class="block-slideshow__slide<?= $index === 0 ? ' active' : '' ?>">
                                <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url('slider/<?= $slide->image ?>')"></div>
                                <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url('slider/<?= $slide->image_mob ?>')"></div>
                                <div class="block-slideshow__slide-content">
                                    <a href="<?= Url::to(['/product/'. $slide->slug]) ?>">
                                        <div class="block-slideshow__slide-button">
                                            <span class="btn btn-primary btn-lg">Переглянути</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var carousel = $('.owl-carousel');
        carousel.owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000, // Change slide every 1 second
            autoplayHoverPause: true
        });
    });
</script>

