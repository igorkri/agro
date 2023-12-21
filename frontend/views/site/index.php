<?php

/** @var yii\web\View $this */

use frontend\widgets\ProductsCarouselGazon;
use frontend\widgets\ColumnsSpecialOffers;
use frontend\widgets\ColumnsBestsellers;
use frontend\widgets\PopularCategories;
use frontend\widgets\BestsellersDacha;
use frontend\widgets\ProductsCarousel;
use frontend\widgets\FeaturedProduct;
use frontend\widgets\ColumnsTopRated;
use frontend\widgets\BlockSlideshow;
use common\models\shop\ActivePages;
use frontend\widgets\BlockFeatures;
use frontend\widgets\Bestsellers;
use frontend\widgets\BlockBrands;
use frontend\widgets\BlockBanner;
use frontend\widgets\ViewProduct;
use frontend\widgets\BlockPosts;

ActivePages::setActiveUser();

?>
<div class="site__body">
    <?php echo BlockSlideshow::widget() ?>
    <?php echo BlockFeatures::widget() ?>
    <?php echo ProductsCarouselGazon::widget() ?>
    <?php echo FeaturedProduct::widget() ?>
    <?php echo BlockBanner::widget() ?>
    <?php echo Bestsellers::widget() ?>
    <?php if (!\Yii::$app->devicedetect->isMobile()) echo PopularCategories::widget(); ?>
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
    <?php if (Yii::$app->session->get('viewedProducts', [])) echo ViewProduct::widget() ?>
</div>
