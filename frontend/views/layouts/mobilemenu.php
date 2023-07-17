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
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-steps" viewBox="0 0 16 16">
                            <path d="M.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 .5 0zM2 1.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z"/>
                        </svg>
                        <a href="<?= Url::to(['/category/list']) ?>" class="mobile-links__item-link"> <i class="bi bi-bar-chart-steps"></i> Категорії</a>
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
