<?php

use frontend\widgets\CategoryWidget;
use yii\helpers\Url;

?>

<header class="site__header d-lg-block d-none">
        <div class="site-header">
            <!-- .topbar -->

            <!-- .topbar / end -->
            <div class="site-header__middle container">
                <div class="site-header__logo">
                    <a href="/">
                        <!-- logo -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="196px" height="26px">
                            <img style="display: block;margin: -24px 0 0 0; width: 89px; " src="/frontend/web/images/logos/logoagro-1.png" alt="">
                        </svg>
                        <!-- logo / end -->
                    </a>
                </div>
                <div class="site-header__search">
                    <div class="search search--location--header ">
                        <div class="search__body">
                            <form class="search__form" action="">
                                <input class="search__input" name="search" placeholder="Пошук товарів" aria-label="Site search" type="text" autocomplete="off">
                                <button class="search__button search__button--type--submit" type="submit">
                                    <svg width="20px" height="20px">
                                        <use xlink:href="/images/sprite.svg#search-20"></use>
                                    </svg>
                                </button>
                                <div class="search__border"></div>
                            </form>
                            <div class="search__suggestions suggestions suggestions--location--header"></div>
                        </div>
                    </div>
                </div>
                <div class="site-header__phone">
                    <div class="site-header__phone-title">Номер для замовлення</div>
                    <div class="site-header__phone-number">(050) 871-20-76</div>
                </div>
            </div>
            <div class="site-header__nav-panel">
                <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
                <div class="nav-panel nav-panel--sticky" data-sticky-mode="pullToShow">
                    <div class="nav-panel__container container">
                        <div class="nav-panel__row">
                            <div class="nav-panel__departments">
                                <!-- .departments -->
                                <?= CategoryWidget::widget() ?>
                                <!-- .departments / end -->
                            </div>
                            <!-- .nav-links -->
                            <div class="nav-panel__nav-links nav-links">
                                <ul class="nav-links__list">
                                    <li class="nav-links__item  nav-links__item--has-submenu ">
                                        <a class="nav-links__item-link" href="#">
                                            <div class="nav-links__item-body">
                                                Доставка та оплата
                                            </div>
                                        </a>

                                    </li>
                                    <li class="nav-links__item  nav-links__item--has-submenu ">
                                        <a class="nav-links__item-link" href="">
                                            <div class="nav-links__item-body">
                                                Спеціальні пропозиції
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-links__item  nav-links__item--has-submenu ">
                                        <a class="nav-links__item-link" href="">
                                            <div class="nav-links__item-body">
                                                Про нас
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-links__item  nav-links__item--has-submenu ">
                                        <a class="nav-links__item-link" href="">
                                            <div class="nav-links__item-body">
                                                Звязок з нами
                                            </div>
                                        </a>
                                    </li> <li class="nav-links__item  nav-links__item--has-submenu ">
                                        <a class="nav-links__item-link" href="">
                                            <div class="nav-links__item-body">
                                                Статті
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <!-- .nav-links / end -->
                            <div class="nav-panel__indicators">

                                <div class="indicator indicator--trigger--click">
                                    <a href="cart.html" class="indicator__button">
                                            <span class="indicator__area">
                                                <svg width="20px" height="20px">
                                                    <use xlink:href="/images/sprite.svg#cart-20"></use>
                                                </svg>
                                                <span class="indicator__value">3</span>
                                            </span>
                                    </a>
                                    <div class="indicator__dropdown">
                                        <!-- .dropcart -->
                                        <div class="dropcart dropcart--style--dropdown">
                                            <div class="dropcart__body">
                                                <div class="dropcart__products-list">
                                                    <div class="dropcart__product">
                                                        <div class="product-image dropcart__product-image">
                                                            <a href="product.html" class="product-image__body">
                                                                <img class="product-image__img" src="/images/products/product-1.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="dropcart__product-info">
                                                            <div class="dropcart__product-name"><a href="product.html">Electric Planer Brandix KL370090G 300 Watts</a></div>
                                                            <ul class="dropcart__product-options">
                                                                <li>Color: Yellow</li>
                                                                <li>Material: Aluminium</li>
                                                            </ul>
                                                            <div class="dropcart__product-meta">
                                                                <span class="dropcart__product-quantity">2</span> ×
                                                                <span class="dropcart__product-price">$699.00</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="dropcart__product-remove btn btn-light btn-sm btn-svg-icon">
                                                            <svg width="10px" height="10px">
                                                                <use xlink:href="/images/sprite.svg#cross-10"></use>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="dropcart__product">
                                                        <div class="product-image dropcart__product-image">
                                                            <a href="product.html" class="product-image__body">
                                                                <img class="product-image__img" src="/images/products/product-2.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="dropcart__product-info">
                                                            <div class="dropcart__product-name"><a href="product.html">Undefined Tool IRadix DPS3000SY 2700 watts</a></div>
                                                            <div class="dropcart__product-meta">
                                                                <span class="dropcart__product-quantity">1</span> ×
                                                                <span class="dropcart__product-price">$849.00</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="dropcart__product-remove btn btn-light btn-sm btn-svg-icon">
                                                            <svg width="10px" height="10px">
                                                                <use xlink:href="/images/sprite.svg#cross-10"></use>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="dropcart__product">
                                                        <div class="product-image dropcart__product-image">
                                                            <a href="product.html" class="product-image__body">
                                                                <img class="product-image__img" src="/images/products/product-5.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="dropcart__product-info">
                                                            <div class="dropcart__product-name"><a href="product.html">Brandix Router Power Tool 2017ERXPK</a></div>
                                                            <ul class="dropcart__product-options">
                                                                <li>Color: True Red</li>
                                                            </ul>
                                                            <div class="dropcart__product-meta">
                                                                <span class="dropcart__product-quantity">3</span> ×
                                                                <span class="dropcart__product-price">$1,210.00</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="dropcart__product-remove btn btn-light btn-sm btn-svg-icon">
                                                            <svg width="10px" height="10px">
                                                                <use xlink:href="/images/sprite.svg#cross-10"></use>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="dropcart__totals">
                                                    <table>
                                                        <tr>
                                                            <th>Subtotal</th>
                                                            <td>$5,877.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Shipping</th>
                                                            <td>$25.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tax</th>
                                                            <td>$0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total</th>
                                                            <td>$5,902.00</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="dropcart__buttons">
                                                    <a class="btn btn-secondary" href="cart.html">View Cart</a>
                                                    <a class="btn btn-primary" href="checkout.html">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .dropcart / end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>