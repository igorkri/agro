<?php

use yii\helpers\Url;

?>

<div class="sa-sidebar__body" data-simplebar="">
    <ul class="sa-nav sa-nav--sidebar" data-sa-collapse="">
        <li class="sa-nav__section">
            <div class="sa-nav__section-title"><h6><span><i class="fas fa-frog"> </i> Магазин </span></h6></div>
            <ul class="sa-nav__menu sa-nav__menu--root">

            </ul>
        </li>
        <!--   ------------------------------------------------------------>
        <li class="sa-nav__section">
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
                        <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme">0</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/category']) ?>" class="sa-nav__link">
                        <span class="sa-nav__icon"><i class="fas fa-bars"></i></span>
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
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
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
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
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
                                               <i class="fas fa-address-card"></i>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'About') ?></span>
                    </a>
                </li>
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/contact']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                             <i class="fas fa-phone"></i>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Contact') ?></span>
                    </a>
                </li>
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/delivery']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                                <i class="fas fa-truck"></i>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'delivery') ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/review']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                   fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
</svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Reviews') ?></span>
                        <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme">0</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
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
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Analytics') ?></span>
                    </a>
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