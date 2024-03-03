<?php

use backend\widgets\ActiveUsers;
use backend\widgets\ActiveUsersSite;
use backend\widgets\AverageOrder;
use backend\widgets\BrandOrders;
use backend\widgets\IncomeStatistics;
use backend\widgets\RecentActivity;
use backend\widgets\RecentOrders;
use backend\widgets\RecentReviews;
use backend\widgets\TotalOrders;
use backend\widgets\TotalSells;
use backend\widgets\UserDevice;

?>

<div class="row g-4 g-xl-5">
    <!-- Total sells -->
    <?php echo TotalSells::widget() ?>
    <!-- End Total sells -->

    <!-- Average order value -->
    <?php echo AverageOrder::widget() ?>
    <!-- End Average order value -->

    <!-- Total orders -->
    <?php echo TotalOrders::widget() ?>
    <!-- End Total orders -->

    <!-- Active users -->
    <?php echo ActiveUsers::widget() ?>
    <!-- End Active users -->

    <!-- Income statistics -->
    <?php echo IncomeStatistics::widget() ?>
    <!-- End Income statistics -->

    <!-- Recent orders -->
    <?php echo RecentOrders::widget() ?>
    <!-- End Recent orders -->

    <!-- Brand orders -->
    <?php echo BrandOrders::widget() ?>
    <!-- End Brand orders -->

    <!-- Recent activity -->
    <?php echo RecentActivity::widget() ?>
    <!-- End Recent activity -->

    <!-- Recent reviews -->
    <?php echo RecentReviews::widget() ?>
    <!-- End Recent reviews -->

    <!-- Brand orders -->
    <?php echo UserDevice::widget() ?>
    <!-- End Brand orders -->

    <!-- Income statistics -->
    <?php echo ActiveUsersSite::widget() ?>
    <!-- End Income statistics -->
</div>
