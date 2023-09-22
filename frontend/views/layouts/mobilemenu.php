<?php

use yii\helpers\Url;

$tel_1 = '(066) 394-18-28';
$tel_2 = '(068) 489-43-86';

?>
<div class="mobilemenu">
    <div class="mobilemenu__backdrop"></div>
    <div class="mobilemenu__body">
        <div class="mobilemenu__header">
            <div class="mobilemenu__title"> <i class="fas fa-bars"></i> Меню</div>
            <button type="button" class="mobilemenu__close">
                <svg width="20px" height="20px">
                    <use xlink:href="/images/sprite.svg#cross-20"></use>
                </svg>
            </button>
        </div>
        <div class="mobilemenu__content">
            <ul class="mobile-links mobile-links--level--0" data-collapse
                data-collapse-opened-class="mobile-links__item--open">
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="/" class="mobile-links__item-link"> <i class="fas fa-home"></i> Головна</a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="<?= Url::to(['/category/list']) ?>" class="mobile-links__item-link"> <i class="fas fa-th-list"></i> Категорії</a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="<?= Url::to(['/special/view']) ?>" class="mobile-links__item-link"> <i class="fas fa-tags"></i> Спеціальні пропозиції</a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="<?= Url::to(['/delivery/view']) ?>" class="mobile-links__item-link"> <i class="fas fa-truck"></i> Доставка та
                            оплата</a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="<?= Url::to(['/about/view']) ?>" class="mobile-links__item-link"> <i class="fas fa-address-card"></i> Про нас</a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="<?= Url::to(['/contact/view']) ?>" class="mobile-links__item-link"> <i class="fas fa-phone-square-alt"></i></i> Зв'язок з нами</a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="<?= Url::to(['/blogs/view']) ?>" class="mobile-links__item-link"> <i class="fas fa-file-alt"> </i> Статті</a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a data-collapse-trigger href="/" class="mobile-links__item-link"> <i class="fas fa-language"></i> Мова</a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a data-collapse-trigger href="/" class="mobile-links__item-link"></a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a data-collapse-trigger href="tel:<?= str_replace([' ', '(', ')', '-'], '', $tel_1) ?>" class="mobile-links__item-link"> <i class="fas fa-mobile-alt"> </i> <?= $tel_1 ?> </a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a data-collapse-trigger href="tel:<?= str_replace([' ', '(', ')', '-'], '', $tel_2) ?>" class="mobile-links__item-link"> <i class="fas fa-mobile-alt"> </i> <?= $tel_2 ?> </a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a data-collapse-trigger href="/" class="mobile-links__item-link"><i class="far fa-envelope"></i> nisatatyana@gmail.com</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
