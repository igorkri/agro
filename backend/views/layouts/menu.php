<?php

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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                     viewBox="0 0 16 16" fill="currentColor">
                                                    <path
                                                            d="M14.2,10.3c-0.1,0.4-0.5,0.7-0.9,0.7H4.8c-0.5,0-0.9-0.3-1-0.8L2.2,4C2.1,3.4,1.6,3,1,3H0.4C0.2,3,0,2.8,0,2.6V1.4C0,1.2,0.2,1,0.4,1h1.4c1,0,1.9,0.7,2.1,1.7l1.5,6.1C5.5,8.9,5.7,9,5.8,9h6.5c0.1,0,0.2-0.1,0.3-0.2l1.1-3.4C13.8,5.2,13.7,5,13.5,5H7.4C7.2,5,7,4.8,7,4.6V3.4C7,3.2,7.2,3,7.4,3H15c0.6,0,1,0.4,1,1v1L14.2,10.3z M4.5,13C5.3,13,6,13.7,6,14.5C6,15.3,5.3,16,4.5,16S3,15.3,3,14.5C3,13.7,3.7,13,4.5,13z M11.5,13c0.8,0,1.5,0.7,1.5,1.5c0,0.8-0.7,1.5-1.5,1.5S10,15.3,10,14.5C10,13.7,10.7,13,11.5,13z"
                                                    ></path>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Orders') ?></span>
                        <?php if (Order::orderNews() != 0) { ?>
                            <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme"><?= Order::orderNews() ?></span>
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
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/category']) ?>" class="sa-nav__link">
                        <span class="sa-nav__icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-bar-chart-steps"
                                                        viewBox="0 0 16 16">
  <path d="M.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 .5 0zM2 1.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z"/>
</svg></span>
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
                    <a href="<?= Url::to(['/order-provider']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                           <svg class='fontawesomesvg' xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 640 512">
                                               <path d="M323.4 85.2l-96.8 78.4c-16.1 13-19.2 36.4-7 53.1c12.9 17.8 38 21.3 55.3 7.8l99.3-77.2c7-5.4 17-4.2 22.5 2.8s4.2 17-2.8 22.5l-20.9 16.2L512 316.8V128h-.7l-3.9-2.5L434.8 79c-15.3-9.8-33.2-15-51.4-15c-21.8 0-43 7.5-60 21.2zm22.8 124.4l-51.7 40.2C263 274.4 217.3 268 193.7 235.6c-22.2-30.5-16.6-73.1 12.7-96.8l83.2-67.3c-11.6-4.9-24.1-7.4-36.8-7.4C234 64 215.7 69.6 200 80l-72 48V352h28.2l91.4 83.4c19.6 17.9 49.9 16.5 67.8-3.1c5.5-6.1 9.2-13.2 11.1-20.6l17 15.6c19.5 17.9 49.9 16.6 67.8-2.9c4.5-4.9 7.8-10.6 9.9-16.5c19.4 13 45.8 10.3 62.1-7.5c17.9-19.5 16.6-49.9-2.9-67.8l-134.2-123zM96 128H0V352c0 17.7 14.3 32 32 32H64c17.7 0 32-14.3 32-32V128zM48 352c-8.8 0-16-7.2-16-16s7.2-16 16-16s16 7.2 16 16s-7.2 16-16 16zM544 128V352c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V128H544zm64 208c0 8.8-7.2 16-16 16s-16-7.2-16-16s7.2-16 16-16s16 7.2 16 16z"/></svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Providers') ?></span>
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
                    <a href="<?= Url::to(['/grup']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-stack" viewBox="0 0 16 16">
  <path d="m14.12 10.163 1.715.858c.22.11.22.424 0 .534L8.267 15.34a.598.598 0 0 1-.534 0L.165 11.555a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0l5.317-2.66zM7.733.063a.598.598 0 0 1 .534 0l7.568 3.784a.3.3 0 0 1 0 .535L8.267 8.165a.598.598 0 0 1-.534 0L.165 4.382a.299.299 0 0 1 0-.535L7.733.063z"/>
  <path d="m14.12 6.576 1.715.858c.22.11.22.424 0 .534l-7.568 3.784a.598.598 0 0 1-.534 0L.165 7.968a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0l5.317-2.659z"/>
</svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Group') ?></span>
                    </a>
                </li>
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/status']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                   fill="currentColor" class="bi bi-bookmark-star" viewBox="0 0 16 16">
  <path d="M7.84 4.1a.178.178 0 0 1 .32 0l.634 1.285a.178.178 0 0 0 .134.098l1.42.206c.145.021.204.2.098.303L9.42 6.993a.178.178 0 0 0-.051.158l.242 1.414a.178.178 0 0 1-.258.187l-1.27-.668a.178.178 0 0 0-.165 0l-1.27.668a.178.178 0 0 1-.257-.187l.242-1.414a.178.178 0 0 0-.05-.158l-1.03-1.001a.178.178 0 0 1 .098-.303l1.42-.206a.178.178 0 0 0 .134-.098L7.84 4.1z"/>
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
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
                                                   fill="currentColor" class="bi bi-c-circle" viewBox="0 0 16 16">
  <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM8.146 4.992c-1.212 0-1.927.92-1.927 2.502v1.06c0 1.571.703 2.462 1.927 2.462.979 0 1.641-.586 1.729-1.418h1.295v.093c-.1 1.448-1.354 2.467-3.03 2.467-2.091 0-3.269-1.336-3.269-3.603V7.482c0-2.261 1.201-3.638 3.27-3.638 1.681 0 2.935 1.054 3.029 2.572v.088H9.875c-.088-.879-.768-1.512-1.729-1.512Z"/>
</svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Brand') ?></span>
                    </a>
                </li>
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/about']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
  <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z"/>
  <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z"/>
</svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'About') ?></span>
                    </a>
                </li>
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/contact']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
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
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/messages']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
</svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Messages') ?></span>
                        <?php if (Review::reviewsNews() != 0) { ?>
                            <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme"><?= Review::reviewsNews() ?></span>
                        <?php } ?>
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
                        <?php if (Review::reviewsNews() != 0) { ?>
                            <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme"><?= Review::reviewsNews() ?></span>
                        <?php } ?>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sa-nav__section">
            <ul class="sa-nav__menu sa-nav__menu--root">
                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                    <a href="<?= Url::to(['/active-pages']) ?>" class="sa-nav__link">
                                            <span class="sa-nav__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                     viewBox="0 0 16 16" fill="currentColor">
                                                    <path
                                                            d="M8,10c-3.3,0-6,2.7-6,6H0c0-3.2,1.9-6,4.7-7.3C3.7,7.8,3,6.5,3,5c0-2.8,2.2-5,5-5s5,2.2,5,5c0,1.5-0.7,2.8-1.7,3.7c2.8,1.3,4.7,4,4.7,7.3h-2C14,12.7,11.3,10,8,10z M8,2C6.3,2,5,3.3,5,5s1.3,3,3,3s3-1.3,3-3S9.7,2,8,2z"
                                                    ></path>
                                                </svg>
                                            </span>
                        <span class="sa-nav__title"><?= Yii::t('app', 'Active users') ?></span>
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