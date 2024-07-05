<?php

use yii\helpers\Url;

?>
<div class="mobilemenu">
    <div class="mobilemenu__backdrop"></div>
    <div class="mobilemenu__body">
        <div class="mobilemenu__header">
            <div class="mobilemenu__title"><i class="fas fa-bars"></i> <?= Yii::t('app', 'Меню') ?></div>
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
                        <a href="/" class="mobile-links__item-link"> <i
                                    class="fas fa-home"></i> <?= Yii::t('app', 'Головна') ?></a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="<?= Url::to(['category/list']) ?>" class="mobile-links__item-link"><i
                                    class="fas fa-th-list"></i> <?= Yii::t('app', 'Категорії') ?></a>
                        <button class="mobile-links__item-toggle menu-color" type="button" data-collapse-trigger>
                            <svg class="mobile-links__item-arrow" width="24px" height="14px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-down-12x7"></use>
                            </svg>
                        </button>
                    </div>
                    <div class="mobile-links__item-sub-links" data-collapse-content>
                        <ul class="mobile-links mobile-links--level--1">
                            <?php foreach ($categories as $category): ?>
                                <?php if (!$category->parent): ?>
                                    <li class="mobile-links__item" data-collapse-item>
                                        <div class="mobile-links__item-title" style="font-weight: bold">
                                            <?php if ($category->parents): ?>
                                                <a href="<?= Url::to(['category/children', 'slug' => $category->slug]) ?>"
                                                   class="mobile-links__item-link"><?= $category->svg .' '. $category->name; ?></a>
                                            <?php else: ?>
                                                <a href="<?= Url::to(['category/catalog', 'slug' => $category->slug]) ?>"
                                                   class="mobile-links__item-link"><?= $category->svg .' '. $category->name; ?></a>
                                            <?php endif; ?>
                                            <?php if ($category->parents): ?>
                                                <button class="mobile-links__item-toggle menu-color" type="button"
                                                        data-collapse-trigger>
                                                    <svg class="mobile-links__item-arrow" width="12px" height="7px">
                                                        <use xlink:href="/images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                    </svg>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($category->parents): ?>
                                            <?php foreach ($category->parents as $parent): ?>
                                                <?php if ($parent->visibility == 1): ?>
                                                    <div class="mobile-links__item-sub-links" data-collapse-content>
                                                        <ul class="mobile-links mobile-links--level--2">
                                                            <li class="mobile-links__item" data-collapse-item>
                                                                <div class="mobile-links__item-title">
                                                                    <a href="<?= Url::to(['category/catalog', 'slug' => $category->slug]) ?>"
                                                                       class="mobile-links__item-link"><?= $parent->svg .' '. $parent->name; ?></a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="<?= Url::to(['special/view']) ?>" class="mobile-links__item-link"> <i
                                    class="fas fa-tags"></i> <?= Yii::t('app', 'Спеціальні пропозиції') ?></a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="<?= Url::to(['delivery/view']) ?>" class="mobile-links__item-link"> <i
                                    class="fas fa-truck"></i> <?= Yii::t('app', 'Доставка та
                            оплата') ?></a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="<?= Url::to(['about/view']) ?>" class="mobile-links__item-link"> <i
                                    class="fas fa-address-card"></i> <?= Yii::t('app', 'Про нас') ?></a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="<?= Url::to(['contact/view']) ?>" class="mobile-links__item-link"> <i
                                    class="fas fa-phone-square-alt"></i> <?= Yii::t('app', 'Зв\'язок з нами') ?></a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="<?= Url::to(['blogs/view']) ?>" class="mobile-links__item-link"> <i
                                    class="fas fa-file-alt"> </i> <?= Yii::t('app', 'Статті') ?></a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a data-collapse-trigger class="mobile-links__item-link"><i
                                    class="fas fa-language"></i> <?= Yii::t('app', 'Мова') ?> <?= $lang ?></a>
                        <button class="mobile-links__item-toggle menu-color" type="button" data-collapse-trigger>
                            <svg class="mobile-links__item-arrow" width="24px" height="14px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-down-12x7"></use>
                            </svg>
                        </button>
                    </div>
                    <div class="mobile-links__item-sub-links" data-collapse-content>
                        <ul class="mobile-links mobile-links--level--1">
                            <li class="mobile-links__item" data-collapse-item>
                                <div class="mobile-links__item-title">
                                    <a class="mobile-links__item-link"
                                       href="<?php echo Url::to(['/' . $path, 'language' => 'uk']) ?>">
                                        <div class="row">
                                            <div class="col-1">
                                                <img src="/images/languages/language-UK.png" alt="UK">
                                            </div>
                                            <div class="col-4">
                                                Українська
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="mobile-links__item" data-collapse-item>
                                <div class="mobile-links__item-title">
                                    <a class="mobile-links__item-link"
                                       href="<?php echo Url::to(['/' . $path, 'language' => 'en']) ?>">
                                        <div class="row">
                                            <div class="col-1">
                                                <img src="/images/languages/language-EN.png" alt="EN">
                                            </div>
                                            <div class="col-4">
                                                English
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="mobile-links__item" data-collapse-item>
                                <div class="mobile-links__item-title">
                                    <a class="mobile-links__item-link"
                                       href="<?php echo Url::to(['/' . $path, 'language' => 'ru']) ?>">
                                        <div class="row">
                                            <div class="col-1">
                                                <img src="/images/languages/language-RU.png" alt="RU">
                                            </div>
                                            <div class="col-4">
                                                Русский
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a data-collapse-trigger class="mobile-links__item-link"></a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a data-collapse-trigger href="tel:<?= str_replace([' ', '(', ')', '-'], '', $contacts->tel_primary) ?>"
                           class="mobile-links__item-link phone-menu"> <i class="fas fa-mobile-alt"> </i> <span><?= $contacts->tel_primary ?></span></a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a data-collapse-trigger href="tel:<?= str_replace([' ', '(', ')', '-'], '', $contacts->tel_second) ?>"
                           class="mobile-links__item-link phone-menu"> <i class="fas fa-mobile-alt"> </i> <span><?= $contacts->tel_second ?></span></a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a data-collapse-trigger href="/" class="mobile-links__item-link"><i
                                    class="far fa-envelope"></i> <span style="font-weight: bold">nisatatyana@gmail.com</span></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<style>
    .menu-color {
        background-color: #62c53280;
    }
    .phone-menu {
        font-weight: bold;
        font-size: 24px;
    }
</style>
