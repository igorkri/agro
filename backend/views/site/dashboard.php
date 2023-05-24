<?php

use backend\widgets\ActiveUsers;
use backend\widgets\AverageOrder;
use backend\widgets\BrandOrders;
use backend\widgets\IncomeStatistics;
use backend\widgets\RecentActivity;
use backend\widgets\RecentOrders;
use backend\widgets\RecentReviews;
use backend\widgets\TotalOrders;
use backend\widgets\TotalSells;

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
</div>
