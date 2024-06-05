<?php

use backend\widgets\ActiveUsers;
use backend\widgets\ActiveUsersSite;
use backend\widgets\ActiveUsersSiteDay;
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
    <?php echo TotalSells::widget() ?>
    <?php echo AverageOrder::widget() ?>
    <?php echo TotalOrders::widget() ?>
    <?php echo ActiveUsers::widget() ?>
    <?php echo IncomeStatistics::widget() ?>
    <?php echo RecentOrders::widget() ?>
    <?php echo BrandOrders::widget() ?>
    <?php echo RecentActivity::widget() ?>
    <?php echo RecentReviews::widget() ?>
    <?php echo UserDevice::widget() ?>
    <?php echo ActiveUsersSite::widget() ?>
    <?php echo ActiveUsersSiteDay::widget() ?>
</div>
