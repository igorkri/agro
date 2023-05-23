<?php

use backend\widgets\ActiveUsers;
use backend\widgets\AverageOrder;
use backend\widgets\BrandOrders;
use backend\widgets\IncomeStatistics;
use backend\widgets\RecentOrders;
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
    <div class="col-12 col-lg-6 d-flex">
        <div class="card flex-grow-1">
            <div class="card-body">
                <div class="sa-widget-header mb-4">
                    <h2 class="sa-widget-header__title">Recent activity</h2>
                    <div class="sa-widget-header__actions">
                        <div class="dropdown">
                            <button
                                    type="button"
                                    class="btn btn-sm btn-sa-muted d-block"
                                    id="widget-context-menu-8"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    aria-label="More"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="3" height="13" fill="currentColor">
                                    <path
                                            d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z"
                                    ></path>
                                </svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="widget-context-menu-8">
                                <li><a class="dropdown-item" href="/#">Settings</a></li>
                                <li><a class="dropdown-item" href="/#">Move</a></li>
                                <li>
                                    <hr class="dropdown-divider"/>
                                </li>
                                <li><a class="dropdown-item text-danger" href="/#">Remove</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="sa-timeline mb-n2 pt-2">
                    <ul class="sa-timeline__list">
                        <li class="sa-timeline__item">
                            <div class="sa-timeline__item-title">Yesterday</div>
                            <div class="sa-timeline__item-content">
                                Phasellus id mattis nulla. Mauris velit nisi, imperdiet vitae sodales in, maximus ut
                                lectus. Vivamus
                                commodo scelerisque lacus, at porttitor dui iaculis id.
                                <a href="/#">Curabitur imperdiet ultrices fermentum.</a>
                            </div>
                        </li>
                        <li class="sa-timeline__item">
                            <div class="sa-timeline__item-title">5 days ago</div>
                            <div class="sa-timeline__item-content">
                                Nulla ut ex mollis, volutpat tellus vitae, accumsan ligula.
                                <a href="/#">Curabitur imperdiet ultrices fermentum.</a>
                            </div>
                        </li>
                        <li class="sa-timeline__item">
                            <div class="sa-timeline__item-title">March 27</div>
                            <div class="sa-timeline__item-content">
                                Donec tempor sapien et fringilla facilisis. Nam maximus consectetur diam.
                            </div>
                        </li>
                        <li class="sa-timeline__item">
                            <div class="sa-timeline__item-title">November 30</div>
                            <div class="sa-timeline__item-content">
                                Many philosophical debates that began in ancient times are still debated today. In one
                                general sense,
                                philosophy is associated with wisdom, intellectual culture and a search for knowledge.
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Recent activity -->

    <!-- Recent reviews -->
    <div class="col-12 col-lg-6 d-flex">
        <div class="card flex-grow-1">
            <div class="card-body">
                <div class="sa-widget-header">
                    <h2 class="sa-widget-header__title">Recent reviews</h2>
                    <div class="sa-widget-header__actions">
                        <div class="dropdown">
                            <button
                                    type="button"
                                    class="btn btn-sm btn-sa-muted d-block"
                                    id="widget-context-menu-9"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    aria-label="More"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="3" height="13" fill="currentColor">
                                    <path
                                            d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z"
                                    ></path>
                                </svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="widget-context-menu-9">
                                <li><a class="dropdown-item" href="/#">Settings</a></li>
                                <li><a class="dropdown-item" href="/#">Move</a></li>
                                <li>
                                    <hr class="dropdown-divider"/>
                                </li>
                                <li><a class="dropdown-item text-danger" href="/#">Remove</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item py-2">
                    <div class="d-flex align-items-center py-3">
                        <a href="/app-product.html" class="me-4">
                            <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                <img src="/admin/images/products/product-1-40x40.jpg" width="40" height="40" alt=""/>
                            </div>
                        </a>
                        <div class="d-flex align-items-center flex-grow-1 flex-wrap">
                            <div class="col">
                                <a href="/app-product.html" class="text-reset fs-exact-14">Wiper Blades Brandix WL2</a>
                                <div class="text-muted fs-exact-13">
                                    Reviewed by
                                    <a href="/app-customer.html" class="text-reset">Ryan Ford</a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-auto">
                                <div class="sa-rating ms-sm-3 my-2 my-sm-0" style="--sa-rating--value: 0.6">
                                    <div class="sa-rating__body"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item py-2">
                    <div class="d-flex align-items-center py-3">
                        <a href="/app-product.html" class="me-4">
                            <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                <img src="/admin/images/products/product-7-40x40.jpg" width="40" height="40" alt=""/>
                            </div>
                        </a>
                        <div class="d-flex align-items-center flex-grow-1 flex-wrap">
                            <div class="col">
                                <a href="/app-product.html" class="text-reset fs-exact-14">
                                    Electric Planer Brandix KL370090G 300 Watts
                                </a>
                                <div class="text-muted fs-exact-13">
                                    Reviewed by
                                    <a href="/app-customer.html" class="text-reset">Adam Taylor</a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-auto">
                                <div class="sa-rating ms-sm-3 my-2 my-sm-0" style="--sa-rating--value: 0.8">
                                    <div class="sa-rating__body"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item py-2">
                    <div class="d-flex align-items-center py-3">
                        <a href="/app-product.html" class="me-4">
                            <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                <img src="/admin/images/products/product-10-40x40.jpg" width="40" height="40" alt=""/>
                            </div>
                        </a>
                        <div class="d-flex align-items-center flex-grow-1 flex-wrap">
                            <div class="col">
                                <a href="/app-product.html" class="text-reset fs-exact-14">Water Tap</a>
                                <div class="text-muted fs-exact-13">
                                    Reviewed by
                                    <a href="/app-customer.html" class="text-reset">Jessica Moore</a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-auto">
                                <div class="sa-rating ms-sm-3 my-2 my-sm-0" style="--sa-rating--value: 0.4">
                                    <div class="sa-rating__body"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item py-2">
                    <div class="d-flex align-items-center py-3">
                        <a href="/app-product.html" class="me-4">
                            <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                <img src="/admin/images/products/product-5-40x40.jpg" width="40" height="40" alt=""/>
                            </div>
                        </a>
                        <div class="d-flex align-items-center flex-grow-1 flex-wrap">
                            <div class="col">
                                <a href="/app-product.html" class="text-reset fs-exact-14">Brandix Router Power Tool
                                    2017ERXPK</a>
                                <div class="text-muted fs-exact-13">
                                    Reviewed by
                                    <a href="/app-customer.html" class="text-reset">Helena Garcia</a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-auto">
                                <div class="sa-rating ms-sm-3 my-2 my-sm-0" style="--sa-rating--value: 0.6">
                                    <div class="sa-rating__body"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item py-2">
                    <div class="d-flex align-items-center py-3">
                        <a href="/app-product.html" class="me-4">
                            <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                <img src="/admin/images/products/product-2-40x40.jpg" width="40" height="40" alt=""/>
                            </div>
                        </a>
                        <div class="d-flex align-items-center flex-grow-1 flex-wrap">
                            <div class="col">
                                <a href="/app-product.html" class="text-reset fs-exact-14">Undefined Tool IRadix
                                    DPS3000SY 2700 Watts</a>
                                <div class="text-muted fs-exact-13">
                                    Reviewed by
                                    <a href="/app-customer.html" class="text-reset">Ryan Ford</a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-auto">
                                <div class="sa-rating ms-sm-3 my-2 my-sm-0" style="--sa-rating--value: 1">
                                    <div class="sa-rating__body"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item py-2">
                    <div class="d-flex align-items-center py-3">
                        <a href="/app-product.html" class="me-4">
                            <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                <img src="/admin/images/products/product-16-40x40.jpg" width="40" height="40" alt=""/>
                            </div>
                        </a>
                        <div class="d-flex align-items-center flex-grow-1 flex-wrap">
                            <div class="col">
                                <a href="/app-product.html" class="text-reset fs-exact-14">Brandix Screwdriver
                                    SCREW150</a>
                                <div class="text-muted fs-exact-13">
                                    Reviewed by
                                    <a href="/app-customer.html" class="text-reset">Charlotte Jones</a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-auto">
                                <div class="sa-rating ms-sm-3 my-2 my-sm-0" style="--sa-rating--value: 0.8">
                                    <div class="sa-rating__body"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- End Recent reviews -->
</div>
