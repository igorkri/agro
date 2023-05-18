<?php

/** @var \yii\web\View $this */

/** @var string $content */

use backend\assets\AppAsset;
use common\models\Settings;
use common\widgets\Alert;
use kartik\alert\AlertBlock;
use kartik\growl\Growl;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" dir="ltr" data-scompiler-id="0">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="format-detection" content="telephone=no"/>
        <!-- icon -->
        <link rel="icon" type="image/png" href="/images/favicon.png"/>
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <!-- sa-app -->
    <div class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
        <!-- sa-app__sidebar -->
        <div class="sa-app__sidebar">
            <div class="sa-sidebar">
                <div class="sa-sidebar__header">
                    <a class="sa-sidebar__logo" href="/admin/">
                        <!-- logo -->
                        <div class="sa-sidebar-logo">
                            <img style="display: block;margin: -1px -7px 1px -14px; width: 153px; "
                                 src="/backend/web/images/logoagro-admin.png" alt="">
                            <div class="sa-sidebar-logo__caption">=Admin=</div>
                        </div>
                        <!-- logo / end -->
                    </a>
                </div>
                <div class="sa-sidebar__body" data-simplebar="">
                    <ul class="sa-nav sa-nav--sidebar" data-sa-collapse="">
                        <li class="sa-nav__section">
                            <div class="sa-nav__section-title"><h5>-= МАГАЗИН =-</h5></div>
                            <hr>
                            <!-------- Menu --------->
                            <ul class="sa-nav__menu sa-nav__menu--root">
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= Url::to(['/order']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                     viewBox="0 0 16 16" fill="currentColor">
                                                    <path
                                                            d="M14.2,10.3c-0.1,0.4-0.5,0.7-0.9,0.7H4.8c-0.5,0-0.9-0.3-1-0.8L2.2,4C2.1,3.4,1.6,3,1,3H0.4C0.2,3,0,2.8,0,2.6V1.4C0,1.2,0.2,1,0.4,1h1.4c1,0,1.9,0.7,2.1,1.7l1.5,6.1C5.5,8.9,5.7,9,5.8,9h6.5c0.1,0,0.2-0.1,0.3-0.2l1.1-3.4C13.8,5.2,13.7,5,13.5,5H7.4C7.2,5,7,4.8,7,4.6V3.4C7,3.2,7.2,3,7.4,3H15c0.6,0,1,0.4,1,1v1L14.2,10.3z M4.5,13C5.3,13,6,13.7,6,14.5C6,15.3,5.3,16,4.5,16S3,15.3,3,14.5C3,13.7,3.7,13,4.5,13z M11.5,13c0.8,0,1.5,0.7,1.5,1.5c0,0.8-0.7,1.5-1.5,1.5S10,15.3,10,14.5C10,13.7,10.7,13,11.5,13z"
                                                    ></path>
                                                </svg>
                                            </span>
                                        <span class="sa-nav__title"><?= Yii::t('app', 'Orders') ?></span>
                                    </a>
                                </li>
                                <hr>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= Url::to(['/category']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                  fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
  <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
</svg>
                                            </span>
                                        <span class="sa-nav__title"><?= Yii::t('app', 'Categories') ?></span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= Url::to(['/product']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-database-fill-add"
                                                    viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0ZM8 1c-1.573 0-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4s.875 1.755 1.904 2.223C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777C13.125 5.755 14 5.007 14 4s-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1Z"/>
  <path d="M2 7v-.839c.457.432 1.004.751 1.49.972C4.722 7.693 6.318 8 8 8s3.278-.307 4.51-.867c.486-.22 1.033-.54 1.49-.972V7c0 .424-.155.802-.411 1.133a4.51 4.51 0 0 0-4.815 1.843A12.31 12.31 0 0 1 8 10c-1.573 0-3.022-.289-4.096-.777C2.875 8.755 2 8.007 2 7Zm6.257 3.998L8 11c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13h.027a4.552 4.552 0 0 1 .23-2.002Zm-.002 3L8 14c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.507 4.507 0 0 1-1.3-1.905Z"/>
</svg>
                                            </span>
                                        <span class="sa-nav__title"><?= Yii::t('app', 'Product') ?></span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= Url::to(['/label']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-chat-square-text-fill"
                                                    viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
</svg>
                                            </span>
                                        <span class="sa-nav__title"><?= Yii::t('app', 'Label') ?></span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= Url::to(['/status']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                   fill="currentColor" class="bi bi-stoplights-fill"
                                                   viewBox="0 0 16 16">
  <path fill-rule="evenodd"
        d="M6 0a2 2 0 0 0-2 2H2c.167.5.8 1.6 2 2v2H2c.167.5.8 1.6 2 2v2H2c.167.5.8 1.6 2 2v1a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-1c1.2-.4 1.833-1.5 2-2h-2V8c1.2-.4 1.833-1.5 2-2h-2V4c1.2-.4 1.833-1.5 2-2h-2a2 2 0 0 0-2-2H6zm3.5 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zM8 13a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
</svg>
                                            </span>
                                        <span class="sa-nav__title"><?= Yii::t('app', 'Status') ?></span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= Url::to(['/tag']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
</svg>
                                            </span>
                                        <span class="sa-nav__title"><?= Yii::t('app', 'Tag') ?></span>
                                    </a>
                                </li>
                                <hr>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= Url::to(['/posts']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                   fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd"
        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
                                            </span>
                                        <span class="sa-nav__title"><?= Yii::t('app', 'Posts') ?></span>
                                    </a>
                                </li>
                                <hr>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= Url::to(['/slider']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                   fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
  <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/>
</svg>
                                            </span>
                                        <span class="sa-nav__title"><?= Yii::t('app', 'Slider') ?></span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= Url::to(['/brand']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                   fill="currentColor" class="bi bi-c-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM8.146 4.992c.961 0 1.641.633 1.729 1.512h1.295v-.088c-.094-1.518-1.348-2.572-3.03-2.572-2.068 0-3.269 1.377-3.269 3.638v1.073c0 2.267 1.178 3.603 3.27 3.603 1.675 0 2.93-1.02 3.029-2.467v-.093H9.875c-.088.832-.75 1.418-1.729 1.418-1.224 0-1.927-.891-1.927-2.461v-1.06c0-1.583.715-2.503 1.927-2.503Z"/>
</svg>
                                            </span>
                                        <span class="sa-nav__title"><?= Yii::t('app', 'Brand') ?></span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= Url::to(['/about']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                   fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
</svg>
                                            </span>
                                        <span class="sa-nav__title"><?= Yii::t('app', 'About') ?></span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= Url::to(['/contact']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                   fill="currentColor" class="bi bi-pip-fill" viewBox="0 0 16 16">
  <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm7 6h5a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5z"/>
</svg>
                                            </span>
                                        <span class="sa-nav__title"><?= Yii::t('app', 'Contact') ?></span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= Url::to(['/delivery']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                  fill="currentColor" class="bi bi-truck-front-fill"
                                                  viewBox="0 0 16 16">
  <path d="M3.5 0A2.5 2.5 0 0 0 1 2.5v9c0 .818.393 1.544 1 2v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5V14h6v1.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2c.607-.456 1-1.182 1-2v-9A2.5 2.5 0 0 0 12.5 0h-9ZM3 3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3.9c0 .625-.562 1.092-1.17.994C10.925 7.747 9.208 7.5 8 7.5c-1.208 0-2.925.247-3.83.394A1.008 1.008 0 0 1 3 6.9V3Zm1 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm8 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm-5-2h2a1 1 0 1 1 0 2H7a1 1 0 1 1 0-2Z"/>
</svg>
                                            </span>
                                        <span class="sa-nav__title"><?= Yii::t('app', 'delivery') ?></span>
                                    </a>
                                </li>
                                <hr>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= Url::to(['/review']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                   fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
</svg>
                                            </span>
                                        <span class="sa-nav__title"><?= Yii::t('app', 'Reviews') ?></span>
                                    </a>
                                </li>
                                <hr>
                            </ul>
                            <!--------End Menu --------->
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sa-app__sidebar-shadow"></div>
            <div class="sa-app__sidebar-backdrop" data-sa-close-sidebar=""></div>
        </div>
        <!-- sa-app__sidebar / end -->
        <div class="sa-app__content">
            <!---- sa-app__toolbar ---->
            <div class="sa-toolbar sa-toolbar--search-hidden sa-app__toolbar">
                <div class="sa-toolbar__body">
                    <div class="sa-toolbar__item">
                        <button class="sa-toolbar__button" type="button" aria-label="Menu" data-sa-toggle-sidebar="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path d="M1,11V9h18v2H1z M1,3h18v2H1V3z M15,17H1v-2h14V17z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="sa-toolbar__item sa-toolbar__item--search">
                        <form class="sa-search sa-search--state--pending">
                            <div class="sa-search__body">
                                <label class="visually-hidden" for="input-search">Search for:</label>
                                <div class="sa-search__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"
                                         fill="currentColor">
                                        <path
                                                d="M16.243 14.828C16.243 14.828 16.047 15.308 15.701 15.654C15.34 16.015 14.828 16.242 14.828 16.242L10.321 11.736C9.247 12.522 7.933 13 6.5 13C2.91 13 0 10.09 0 6.5C0 2.91 2.91 0 6.5 0C10.09 0 13 2.91 13 6.5C13 7.933 12.522 9.247 11.736 10.321L16.243 14.828ZM6.5 2C4.015 2 2 4.015 2 6.5C2 8.985 4.015 11 6.5 11C8.985 11 11 8.985 11 6.5C11 4.015 8.985 2 6.5 2Z"
                                        ></path>
                                    </svg>
                                </div>
                                <input type="text" id="input-search" class="sa-search__input"
                                       placeholder="Search for the truth" autocomplete="off"/>
                                <button class="sa-search__cancel d-sm-none" type="button" aria-label="Close search">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                                         fill="currentColor">
                                        <path
                                                d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6 c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4 C11.2,9.8,11.2,10.4,10.8,10.8z"
                                        ></path>
                                    </svg>
                                </button>
                                <div class="sa-search__field"></div>
                            </div>
                            <div class="sa-search__dropdown">
                                <div class="sa-search__dropdown-loader"></div>
                                <div class="sa-search__dropdown-wrapper">
                                    <div class="sa-search__suggestions sa-suggestions"></div>
                                    <div class="sa-search__help sa-search__help--type--no-results">
                                        <div class="sa-search__help-title">
                                            No results for &quot;
                                            <span class="sa-search__query"></span>
                                            &quot;
                                        </div>
                                        <div class="sa-search__help-subtitle">Make sure that all words are spelled
                                            correctly.
                                        </div>
                                    </div>
                                    <div class="sa-search__help sa-search__help--type--greeting">
                                        <div class="sa-search__help-title">Start typing to search for</div>
                                        <div class="sa-search__help-subtitle">Products, orders, customers, actions,
                                            etc.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sa-search__backdrop"></div>
                        </form>
                    </div>
                    <div class="mx-auto"></div>
                    <div class="sa-toolbar__item d-sm-none">
                        <button class="sa-toolbar__button" type="button" aria-label="Show search"
                                data-sa-action="show-search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"
                                 fill="currentColor">
                                <path
                                        d="M16.243 14.828C16.243 14.828 16.047 15.308 15.701 15.654C15.34 16.015 14.828 16.242 14.828 16.242L10.321 11.736C9.247 12.522 7.933 13 6.5 13C2.91 13 0 10.09 0 6.5C0 2.91 2.91 0 6.5 0C10.09 0 13 2.91 13 6.5C13 7.933 12.522 9.247 11.736 10.321L16.243 14.828ZM6.5 2C4.015 2 2 4.015 2 6.5C2 8.985 4.015 11 6.5 11C8.985 11 11 8.985 11 6.5C11 4.015 8.985 2 6.5 2Z"
                                ></path>
                            </svg>
                        </button>
                    </div>
                    <div class="sa-toolbar__item dropdown">
                        <i class="fas fa-dollar-sign"></i><?= Yii::$app->formatter->asDecimal(Settings::currencyRate(), 2) ?>
                    </div>
                    <div class="sa-toolbar__item dropdown">
                        <button
                                class="sa-toolbar__button"
                                type="button"
                                id="dropdownMenuButton2"
                                data-bs-toggle="dropdown"
                                data-bs-reference="parent"
                                data-bs-offset="0,1"
                                aria-expanded="false"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"
                                 fill="currentColor">
                                <path
                                        d="M8,13c0,0-5.2,0-7,0c0-1-0.1-1.9,1-1.9C2,5,4,2,6,2c0-1.1,0-2,2-2c1.9,0,2,0.9,2,2c2,0,4,3,4,9c1,0,1,1,1,2C12.7,13,8,13,8,13z M6,14h4c0,1.1,0,2-2,2C6,16,6,15.1,6,14L6,14L6,14z"
                                ></path>
                            </svg>
                            <span class="sa-toolbar__button-indicator">3</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="dropdownMenuButton2">
                            <div class="sa-notifications">
                                <div class="sa-notifications__header">
                                    <div class="sa-notifications__header-title">Notifications</div>
                                    <a class="sa-notifications__header-action" href="/">Mark All as Read</a>
                                </div>
                                <ul class="sa-notifications__list">
                                    <li class="sa-notifications__item">
                                        <a href="/#" class="sa-notifications__item-button">
                                            <div class="sa-notifications__item-icon">
                                                <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--style--primary">
                                                    <div class="sa-symbol__icon">
                                                        <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="1em"
                                                                height="1em"
                                                                viewBox="0 0 16 16"
                                                                fill="currentColor"
                                                        >
                                                            <path
                                                                    d="M14.5,15h-1c-0.8,0-1.5-0.7-1.5-1.5v-8C12,4.7,12.7,4,13.5,4h1C15.3,4,16,4.7,16,5.5v8C16,14.3,15.3,15,14.5,15z M8.5,15h-1C6.7,15,6,14.3,6,13.5v-11C6,1.7,6.7,1,7.5,1h1C9.3,1,10,1.7,10,2.5v11C10,14.3,9.3,15,8.5,15z M2.5,15h-1C0.7,15,0,14.3,0,13.5v-5C0,7.7,0.7,7,1.5,7h1C3.3,7,4,7.7,4,8.5v5C4,14.3,3.3,15,2.5,15z"
                                                            ></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sa-notifications__item-body">
                                                <div class="sa-notifications__item-title sa-notifications__item-title--nowrap">
                                                    New report has been received
                                                </div>
                                                <div class="sa-notifications__item-subtitle sa-notifications__item-subtitle--nowrap">
                                                    24 hours ago
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="sa-notifications__item">
                                        <a href="/#" class="sa-notifications__item-button">
                                            <div class="sa-notifications__item-icon">
                                                <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--style--warning">
                                                    <div class="sa-symbol__icon">
                                                        <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="1em"
                                                                height="1em"
                                                                viewBox="0 0 16 16"
                                                                fill="currentColor"
                                                        >
                                                            <path
                                                                    d="M8,6C4.7,6,2,4.7,2,3s2.7-3,6-3s6,1.3,6,3S11.3,6,8,6z M2,5L2,5L2,5C2,5,2,5,2,5z M8,8c3.3,0,6-1.3,6-3v3c0,1.7-2.7,3-6,3S2,9.7,2,8V5C2,6.7,4.7,8,8,8z M14,5L14,5C14,5,14,5,14,5L14,5z M2,10L2,10L2,10C2,10,2,10,2,10z M8,13c3.3,0,6-1.3,6-3v3c0,1.7-2.7,3-6,3s-6-1.3-6-3v-3C2,11.7,4.7,13,8,13z M14,10L14,10C14,10,14,10,14,10L14,10z"
                                                            ></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sa-notifications__item-body">
                                                <div class="sa-notifications__item-title sa-notifications__item-title--nowrap">
                                                    Creating a backup in the process
                                                </div>
                                                <div class="sa-notifications__item-subtitle sa-notifications__item-subtitle--nowrap">
                                                    Completed: 37% (23.05 MB)
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="sa-notifications__item">
                                        <a href="/#" class="sa-notifications__item-button">
                                            <div class="sa-notifications__item-icon">
                                                <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--style--primary">
                                                    <div class="sa-symbol__icon">
                                                        <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="1em"
                                                                height="1em"
                                                                viewBox="0 0 16 16"
                                                                fill="currentColor"
                                                        >
                                                            <path
                                                                    d="M14.2,10.3c-0.1,0.4-0.5,0.7-0.9,0.7H4.8c-0.5,0-0.9-0.3-1-0.8L2.2,4C2.1,3.4,1.6,3,1,3H0.4C0.2,3,0,2.8,0,2.6V1.4C0,1.2,0.2,1,0.4,1h1.4c1,0,1.9,0.7,2.1,1.7l1.5,6.1C5.5,8.9,5.7,9,5.8,9h6.5c0.1,0,0.2-0.1,0.3-0.2l1.1-3.4C13.8,5.2,13.7,5,13.5,5H7.4C7.2,5,7,4.8,7,4.6V3.4C7,3.2,7.2,3,7.4,3H15c0.6,0,1,0.4,1,1v1L14.2,10.3z M4.5,13C5.3,13,6,13.7,6,14.5C6,15.3,5.3,16,4.5,16S3,15.3,3,14.5C3,13.7,3.7,13,4.5,13z M11.5,13c0.8,0,1.5,0.7,1.5,1.5c0,0.8-0.7,1.5-1.5,1.5S10,15.3,10,14.5C10,13.7,10.7,13,11.5,13z"
                                                            ></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sa-notifications__item-body">
                                                <div class="sa-notifications__item-title sa-notifications__item-title--nowrap">
                                                    Product added to cart
                                                </div>
                                                <div class="sa-notifications__item-subtitle sa-notifications__item-subtitle--nowrap">
                                                    Drill Screwdriver Brandix ALX7054 200 Watts
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="sa-notifications__item">
                                        <a href="/#" class="sa-notifications__item-button">
                                            <div class="sa-notifications__item-icon">
                                                <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--style--info">
                                                    <div class="sa-symbol__icon">
                                                        <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="1em"
                                                                height="1em"
                                                                viewBox="0 0 16 16"
                                                                fill="currentColor"
                                                        >
                                                            <path
                                                                    d="M8,10c-3.3,0-6,2.7-6,6H0c0-3.2,1.9-6,4.7-7.3C3.7,7.8,3,6.5,3,5c0-2.8,2.2-5,5-5s5,2.2,5,5c0,1.5-0.7,2.8-1.7,3.7c2.8,1.3,4.7,4,4.7,7.3h-2C14,12.7,11.3,10,8,10z M8,2C6.3,2,5,3.3,5,5s1.3,3,3,3s3-1.3,3-3S9.7,2,8,2z"
                                                            ></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sa-notifications__item-body">
                                                <div class="sa-notifications__item-title sa-notifications__item-title--nowrap">
                                                    Customer Ryan Ford says
                                                </div>
                                                <div class="sa-notifications__item-subtitle sa-notifications__item-subtitle--nowrap">
                                                    What is a screen dimension of Brandix Series B monitor?
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <div class="sa-notifications__footer"><a class="sa-notifications__footer-action"
                                                                         href="/">See all 15 notifications</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown sa-toolbar__item">
                        <button
                                class="sa-toolbar-user"
                                type="button"
                                id="dropdownMenuButton"
                                data-bs-toggle="dropdown"
                                data-bs-offset="0,1"
                                aria-expanded="false"
                        >
                                <span class="sa-toolbar-user__avatar sa-symbol sa-symbol--shape--rounded">
                                    <img src="/admin/images/customers/customer-4-64x64.jpg" width="64" height="64"
                                         alt=""/>
                                </span>
                            <span class="sa-toolbar-user__info">
                                <?php if (isset(Yii::$app->user->identity->username)): ?>
                                    <span class="sa-toolbar-user__title"><?= Yii::$app->user->identity->username ?></span>
                                    <span class="sa-toolbar-user__subtitle"><?= Yii::$app->user->identity->email ?></span>
                                <?php endif; ?>
                                </span>
                        </button>
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                            <li>
                                <?= Html::a('Вихід', ['/site/logout'], [
                                    'class' => 'dropdown-item',
                                    'data' => [
                                        'method' => 'post',
                                    ],
                                ]) ?>
                        </ul>
                    </div>
                </div>
                <div class="sa-toolbar__shadow"></div>
            </div>
            <?php
            echo AlertBlock::widget([
                'type' => AlertBlock::TYPE_GROWL,
                'useSessionFlash' => true,
                'delay' => 500,
                'alertSettings' => [
                    'success' => [
                        'type' => Growl::TYPE_SUCCESS,
                        'pluginOptions' => [
//                        'showProgressbar' => true,
                            'z_index' => 3031,
                            'timer' => 3000,
                            'placement' => [
                                'from' => 'top',
                                'align' => 'right'
                            ]
                        ]
                    ],
                    'danger' => [
                        'type' => Growl::TYPE_DANGER,
                        'pluginOptions' => [
                            'z_index' => 3031,
                            'timer' => 4000,
                            'placement' => [
                                'from' => 'top',
                                'align' => 'right']
                        ]
                    ],
                    'warning' => [
                        'type' => Growl::TYPE_WARNING,
                        'pluginOptions' => [
                            'z_index' => 3031,
                            'timer' => 4000,
                            'placement' => [
                                'from' => 'top',
                                'align' => 'right']
                        ]
                    ],
                    'info' => [
                        'type' => Growl::TYPE_INFO,
                        'pluginOptions' => [
                            'z_index' => 3031,
                            'timer' => 3000,
                            'placement' => [
                                'from' => 'top',
                                'align' => 'right'
                            ]
                        ]
                    ]
                ]
            ]);

            ?>
            <!-- sa-app__toolbar / end -->
            <?= $content ?>
            <!-- sa-app__footer -->
            <div class="sa-app__footer d-block d-md-flex">
                <!-- copyright -->
                agropro.org.ua © 2023
                <div class="m-auto"></div>
                <div>
                    <a href="/https://agropro.org.ua/">Agro</a>
                </div>
                <!-- copyright / end -->
            </div>
            <!-- sa-app__footer / end -->
        </div>
        <!-- sa-app__content / end -->

        <!-- sa-app__toasts -->
        <div class="sa-app__toasts toast-container bottom-0 end-0"></div>
        <!-- sa-app__toasts / end -->
    </div>
    <!-- sa-app / end -->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
