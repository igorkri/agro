<?php

use frontend\widgets\CategoryWidget;
use yii\helpers\Url;

?>
<header class="site__header d-lg-block d-none">
    <div class="site-header">
        <div class="site-header__topbar topbar">
            <div class="topbar__container container">
                <div class="topbar__row">
                    <div class="topbar__item topbar__item--link">
                        <a class="topbar-link" href="<?= Url::to(['/about/view']) ?>">Про Нас</a>
                    </div>
                    <div class="topbar__item topbar__item--link">
                        <a class="topbar-link" href="<?= Url::to(['/contact/view']) ?>">Контакти</a>
                    </div>
                    <div class="topbar__item topbar__item--link">
                        <a class="topbar-link" href="<?= Url::to(['/delivery/view']) ?>">Доставка Оплата</a>
                    </div>
                    <div class="topbar__item topbar__item--link">
                        <a class="topbar-link" href="<?= Url::to(['/blogs/view']) ?>">Статті</a>
                    </div>
                    <div class="topbar__spring"></div>
                    <div class="topbar__item">
                        <div class="topbar-dropdown">
                            <button class="topbar-dropdown__btn" type="button">
                                <i class="fas fa-map-marker-alt"></i>
                                Полтава
                                <svg width="7px" height="5px">
                                    <use xlink:href="/images/sprite.svg#arrow-rounded-down-7x5"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="topbar__item">
                        <div class="topbar-dropdown">
                            <button class="topbar-dropdown__btn" type="button">
                                Валюта: <span class="topbar__item-value">UAH</span>
                                <svg width="7px" height="5px">
                                    <use xlink:href="/images/sprite.svg#arrow-rounded-down-7x5"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="topbar__item">
                        <div class="topbar-dropdown">
                            <button class="topbar-dropdown__btn" type="button">
                                Мова: <span class="topbar__item-value">UK</span>
                                <svg width="7px" height="5px">
                                    <use xlink:href="/images/sprite.svg#arrow-rounded-down-7x5"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="topbar__item">
                        <div class="topbar-dropdown">
                            <button class="topbar-dropdown__btn" type="button">
                                <svg width="20px" height="15px">
                                    <use xlink:href="/images/sprite.svg#flag-icons-ua"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-header__middle container">
            <div class="site-header__logo">
                <a href="/">
                    <img style="display: block;margin: -22px -12px 0px -28px;"
                         src="/images/logos/logoagro.jpg" width="300" height="99" alt="Логотип">
                </a>
            </div>
            <div class="site-header__search">
                <div class="search search--location--header ">
                    <div class="search__body">
                        <form class="search__form" action="/search/suggestions">
                            <input class="search__input" name="q" placeholder="Пошук товарів"
                                   aria-label="Site search" type="text" autocomplete="off">
                            <button class="search__button search__button--type--submit" type="submit"
                                    aria-label="Site search">
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
                <div class="site-header__phone-number"
                     style="margin: 0px 0px 6px 0px;"><i class="fas fa-mobile-alt"></i> <a
                            href="tel:<?= str_replace([' ', '(', ')', '-'], '', $contacts->tel_primary) ?>"><?= $contacts->tel_primary ?></a>
                </div>
                <div class="site-header__phone-number"><i
                            class="fas fa-mobile-alt"></i> <a
                            href="tel:<?= str_replace([' ', '(', ')', '-'], '', $contacts->tel_second) ?>"><?= $contacts->tel_second ?></a>
                </div>
            </div>
        </div>
        <div class="site-header__nav-panel">
            <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
            <div class="nav-panel nav-panel--sticky" data-sticky-mode="pullToShow">
                <div class="nav-panel__container container">
                    <div class="nav-panel__row">
                        <div class="nav-panel__departments">
                            <?= CategoryWidget::widget() ?>
                        </div>
                        <div class="nav-panel__nav-links nav-links">
                            <ul class="nav-links__list">
                                <li class="nav-links__item  nav-links__item--has-submenu ">
                                    <a class="nav-links__item-link" href="<?= Url::to(['/special/view']) ?>">
                                        <div class="nav-links__item-body">
                                            Спеціальні пропозиції
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-links__item  nav-links__item--has-submenu ">
                                    <a class="nav-links__item-link" href="<?= Url::to(['/catalog/dacha']) ?>">
                                        <div class="nav-links__item-body">
                                            Дача
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-links__item  nav-links__item--has-submenu ">
                                    <a class="nav-links__item-link" href="<?= Url::to(['/delivery/view']) ?>">
                                        <div class="nav-links__item-body">
                                            Доставка
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-links__item  nav-links__item--has-submenu ">
                                    <a class="nav-links__item-link" href="<?= Url::to(['/contact/view']) ?>">
                                        <div class="nav-links__item-body">
                                            Зв'язок з нами
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-links__item  nav-links__item--has-submenu ">
                                    <a class="nav-links__item-link" href="<?= Url::to(['/blogs/view']) ?>">
                                        <div class="nav-links__item-body">
                                            Статті
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="nav-panel__indicators">
                            <div class="indicator">
                                <a href="<?= Url::to(['/wish/view']) ?>" data-toggle="tooltip" title="Бажання"
                                   class="indicator__button">
                                            <span class="indicator__area">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="/images/sprite.svg#wishlist-16"></use>
                                                </svg>
                                                    <span class="indicator__value"
                                                          id="wish-indicator"><?= $wishList ?></span>
                                            </span>
                                </a>
                            </div>
                            <div class="indicator">
                                <a href="<?= Url::to(['/compare/view']) ?>" data-toggle="tooltip" title="Порівняння"
                                   class="indicator__button">
                                            <span class="indicator__area">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="/images/sprite.svg#compare-16"></use>
                                                </svg>
                                                    <span class="indicator__value"
                                                          id="compare-indicator"><?= $compareList ?></span>
                                            </span>
                                </a>
                            </div>
                            <div class="indicator indicator--trigger--click cart-header">
                                <a href="#" data-toggle="tooltip" title="Корзина" class="indicator__button">
                                    <span class="indicator__area">
                                        <svg width="20px" height="20px">
                                            <use xlink:href="/images/sprite.svg#cart-20"></use>
                                        </svg>
                                        <span class="indicator__value"
                                              id="desc-qty-cart"><?= \Yii::$app->cart->getCount() ?></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>