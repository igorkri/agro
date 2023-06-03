<?php

/** @var yii\web\View $this */

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

\common\models\shop\ActivePages::setActiveUser();

$this->title = Yii::$app->name;
?>
<!-- site__body -->
<div class="site__body">
    
    <!-- .block-slideshow -->
    <?php echo BlockSlideshow::widget() ?>
    <!-- .block-slideshow / end -->
    
    <!-- .block-features -->
    <?php echo BlockFeatures::widget() ?>
    <!-- .block-features / end -->
   
    <!-- .block-products-carousel -->
    <?php echo FeaturedProduct::widget() ?>
    <!-- .block-products-carousel / end -->
    
    <!-- .block-banner -->
    <?php echo BlockBanner::widget() ?>
    <!-- .block-banner / end -->
    
    <!-- .block-products -->
    <?php echo Bestsellers::widget() ?>
    <!-- .block-products / end -->
   
    <!-- .block-categories -->
    <?php echo PopularCategories::widget() ?>
    <!-- .block-categories / end -->
   
    <!-- .block-products-carousel -->
    <?php echo ProductsCarousel::widget() ?>
    <!-- .block-products-carousel / end -->
    
    <!-- .block-posts -->
    <?php echo BlockPosts::widget() ?>
    <!-- .block-posts / end -->
   
    <!-- .block-brands -->
    <?php echo BlockBrands::widget() ?>
    <!-- .block-brands / end -->
   
    <!-- .block-product-columns -->
    <div class="block block-product-columns d-lg-block d-none">
        <div class="container">
            <div class="row">
   <!-- .block-product-columns Top Rated Products-->
   <?php echo ColumnsTopRated::widget() ?>
   <!-- .block-product-columns Top Rated Products /end -->

   <!-- .block-product-columns Special Offers -->           
   <?php echo ColumnsSpecialOffers::widget() ?>
   <!-- .block-product-columns Special Offers /end -->

   <!-- .block-product-columns Bestsellers -->            
   <?php echo ColumnsBestsellers::widget() ?>
   <!-- .block-product-columns Bestsellers /end -->
            </div>
        </div>
    </div>
    <!-- .block-product-columns / end -->
</div>
<!-- site__body / end -->
