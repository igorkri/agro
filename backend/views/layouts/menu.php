<?php

use common\models\Messages;
use common\models\PostsReview;
use common\models\shop\Order;
use common\models\shop\Review;
use yii\helpers\Url;

?>
<div class="sa-sidebar__body" data-simplebar="">
    <ul class="sa-nav sa-nav--sidebar" data-sa-collapse="">
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
            </ul>
        </li>
        <!--   ------------------------------------------------------------>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/order']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                                <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#order"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Orders') ?></span>
                        <?php $orderNews = Order::orderNews() ?>
                        <?php if ($orderNews != 0) { ?>
                            <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme"><?= $orderNews ?></span>
                        <?php } ?>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#statistic"/>
                                              </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Analytics') ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">

                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                    data-sa-collapse-item="sa-nav__menu-item--open">
                    <a href="" class="sa-nav__link" data-sa-collapse-trigger="">
                                            <span class="sa-nav__icon">
                                                <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#categories"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Categories') ?></span>
                        <span class="sa-nav__arrow">
                                                <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#arrow"/>
                                                </svg>
                                            </span>
                    </a>
                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                        <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                            <a href="<?= Url::to(['/category']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#star"/>
                                                </svg>
                                            </span>
                                <span class="sa-nav__title"><?= Yii::t('app', 'First') ?></span>
                            </a>
                        </li>
                        <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                            <a href="<?= Url::to(['/auxiliary-categories']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#star"/>
                                                </svg>
                                            </span>
                                <span class="sa-nav__title"><?= Yii::t('app', 'Second') ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/product']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                                <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#products"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Product') ?></span>
                    </a>
                </li>
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/order-provider']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                           <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#providers"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Providers') ?></span>
                    </a>
                </li>
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/label']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                                <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#labels"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Label') ?></span>
                    </a>
                </li>
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/grup']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                               <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#groups"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Group') ?></span>
                    </a>
                </li>
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/status']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#status"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Status') ?></span>
                    </a>
                </li>
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/tag']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                            <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#tags"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Tag') ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/posts']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#posts"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Posts') ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/slider']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#slider"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Slider') ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/messages']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#messages"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Messages') ?></span>
                        <?php $messagesNews = Messages::messagesNews() ?>
                        <?php if ($messagesNews != 0) { ?>
                            <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme"><?= $messagesNews ?></span>
                        <?php } ?>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                    data-sa-collapse-item="sa-nav__menu-item--open">
                    <a href="" class="sa-nav__link" data-sa-collapse-trigger="">
                                            <span class="sa-nav__icon">
                                              <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#star"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Reviews') ?></span>
                        <?php $reviewsNews = Review::reviewsNews() ?>
                        <?php $reviewsPostNews = PostsReview::reviewsNews() ?>

                        <?php if ($reviewsNews != 0 || $reviewsPostNews != 0) { ?>
                            <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme"
                                  style="font-size: 16px">!</span>
                        <?php } else { ?>
                            <span class="sa-nav__arrow">
                                                <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#arrow"/>
                                                </svg>
                                            </span>
                        <?php } ?>
                    </a>
                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                        <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                            <a href="<?= Url::to(['/review']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#star"/>
                                                </svg>
                                            </span>
                                <span class="sa-nav__title"><?= Yii::t('app', 'Product Reviews') ?></span>
                                <?php if ($reviewsNews != 0) { ?>
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme"><?= $reviewsNews ?></span>
                                <?php } ?>
                            </a>
                        </li>
                        <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                            <a href="<?= Url::to(['/posts-review']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#star"/>
                                                </svg>
                                            </span>
                                <span class="sa-nav__title"><?= Yii::t('app', 'Posts Reviews') ?></span>
                                <?php if ($reviewsPostNews != 0) { ?>
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme"><?= $reviewsPostNews ?></span>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                    data-sa-collapse-item="sa-nav__menu-item--open">
                    <a href="" class="sa-nav__link" data-sa-collapse-trigger="">
                                            <span class="sa-nav__icon">
                                                <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#active-pages"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Active users') ?></span>
                        <span class="sa-nav__arrow">
                                                <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#arrow"/>
                                                </svg>
                                            </span>
                    </a>
                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                        <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                            <a href="<?= Url::to(['/active-pages']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                                <svg width="20px" height="20px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#active-pages"/>
                                                </svg>
                                            </span>
                                <span class="sa-nav__title"><?= Yii::t('app', 'Active users') ?></span>
                            </a>
                        </li>
                        <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                            <a href="<?= Url::to(['/ip-bot']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                               <svg width="20px" height="20px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#setting"/>
                                                </svg>
                                            </span>
                                <span class="sa-nav__title"><?= Yii::t('app', 'IP Bot') ?></span>
                            </a>
                        </li>
                        <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                            <a href="<?= Url::to(['/bots']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                                <svg width="20px" height="20px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#setting"/>
                                                </svg>
                                            </span>
                                <span class="sa-nav__title"><?= Yii::t('app', 'Name Bot') ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/report']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                                <svg width="20px" height="20px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#report"/>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Report') ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                    data-sa-collapse-item="sa-nav__menu-item--open">
                    <a href="" class="sa-nav__link" data-sa-collapse-trigger="">
                                            <span class="sa-nav__icon">
                                                <svg width="20px" height="20px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#setting"></use>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Settings') ?></span>
                        <span class="sa-nav__arrow">
                                                <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#arrow"/>
                                                </svg>
                                            </span>
                    </a>
                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                        <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                            <a href="<?= Url::to(['/brand']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#brand"/>
                                              </svg>
                                            </span>
                                <span class="sa-nav__title"><?= Yii::t('app', 'Brand') ?></span>
                            </a>
                        </li>
                        <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                            <a href="<?= Url::to(['/about']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#about"/>
                                              </svg>
                                            </span>
                                <span class="sa-nav__title"><?= Yii::t('app', 'About') ?></span>
                            </a>
                        </li>
                        <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                            <a href="<?= Url::to(['/contact']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                            <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#contact"/>
                                              </svg>
                                            </span>
                                <span class="sa-nav__title"><?= Yii::t('app', 'Contact') ?></span>
                            </a>
                        </li>
                        <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                            <a href="<?= Url::to(['/seo-pages']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                            <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#seo-pages"/>
                                              </svg>
                                            </span>
                                <span class="sa-nav__title"><?= Yii::t('app', 'Seo Pages') ?></span>
                            </a>
                        </li>
                        <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                            <a href="<?= Url::to(['/delivery']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg width="16px" height="16px" style="display: unset;">
                                                 <use xlink:href="/admin/images/sprite.svg#delivery"/>
                                              </svg>
                                            </span>
                                <span class="sa-nav__title"><?= Yii::t('app', 'delivery') ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <!--   ------------------------------------------------------------>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
            </ul>
        </li>
    </ul>
</div>