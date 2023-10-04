<?php

/** @var yii\web\View $this */

use common\models\shop\ActivePages;
use frontend\widgets\BestsellersDacha;
use frontend\widgets\FeaturedProduct;
use frontend\widgets\PopularCategories;
use frontend\widgets\Bestsellers;
use frontend\widgets\ColumnsBestsellers;
use frontend\widgets\ColumnsTopRated;
use frontend\widgets\ColumnsSpecialOffers;
use frontend\widgets\ProductsCarousel;
use frontend\widgets\BlockFeatures;
use frontend\widgets\BlockPosts;
use frontend\widgets\BlockSlideshow;
use frontend\widgets\BlockBrands;
use frontend\widgets\BlockBanner;
use frontend\widgets\ProductsCarouselGazon;

ActivePages::setActiveUser();

?>
<div class="site__body">
    <?php echo BlockSlideshow::widget() ?>
    <?php echo BlockFeatures::widget() ?>
    <?php echo ProductsCarouselGazon::widget() ?>
    <?php echo FeaturedProduct::widget() ?>
    <?php echo BlockBanner::widget() ?>
    <?php echo Bestsellers::widget() ?>
    <?php echo PopularCategories::widget() ?>
    <?php echo BestsellersDacha::widget() ?>
    <?php echo ProductsCarousel::widget() ?>
    <?php echo BlockPosts::widget() ?>
    <?php echo BlockBrands::widget() ?>
    <div class="block block-product-columns d-lg-block d-none">
        <div class="container">
            <div class="row">
   <?php echo ColumnsTopRated::widget() ?>
   <?php echo ColumnsSpecialOffers::widget() ?>
   <?php echo ColumnsBestsellers::widget() ?>
            </div>
        </div>
    </div>
</div>

