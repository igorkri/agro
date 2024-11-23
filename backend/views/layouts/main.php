<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use backend\widgets\TasksAdmin;
use common\models\Settings;
use yii\bootstrap5\Html;

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
                            <div class="sa-sidebar-logo__caption">Admin</div>
                        </div>
                        <!-- logo / end -->
                    </a>
                </div>
                <?= $this->render('menu') ?>
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
                            <svg width="20px" height="20px" style="display: unset">
                                <use xlink:href="/admin/images/sprite.svg#menu"/>
                            </svg>
                        </button>
                    </div>
                    <div class="sa-toolbar__item sa-toolbar__item--search">
                        <form class="sa-search sa-search--state--pending">
                            <div class="sa-search__body">
                                <label class="visually-hidden" for="input-search">Search for:</label>
                                <div class="sa-search__icon">
                                    <svg width="20px" height="20px" style="display: unset">
                                        <use xlink:href="/admin/images/sprite.svg#search"/>
                                    </svg>
                                </div>
                                <input type="text" id="input-search" class="sa-search__input"
                                       placeholder="Search for the truth" autocomplete="off"/>
                                <button class="sa-search__cancel d-sm-none" type="button" aria-label="Close search">
                                    <svg width="20px" height="20px" style="display: unset">
                                        <use xlink:href="/admin/images/sprite.svg#search-close"/>
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
                            <svg width="20px" height="20px" style="display: unset">
                                <use xlink:href="/admin/images/sprite.svg#search-show"/>
                            </svg>
                        </button>
                    </div>
                    <div class="sa-toolbar__item me-3">
                        <i class="fas fa-euro-sign" style="color: #0c33be"></i>
                        <?= Yii::$app->formatter->asDecimal(Settings::currencyRate($cc = 'EUR'), 2) ?>
                    </div>
                    <div class="sa-toolbar__item me-3">
                        <i class="fas fa-dollar-sign" style="color: #00a629"></i>
                        <?= Yii::$app->formatter->asDecimal(Settings::currencyRate(), 2) ?>
                    </div>
                    <div class="sa-toolbar__item dropdown">
                        <?php echo TasksAdmin::widget() ?>
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
            <?= $this->render('alert-block-widgets') ?>
            <!-- sa-app__toolbar / end -->
            <?= $content ?>
            <!-- sa-app__footer -->
            <div class="sa-app__footer d-block d-md-flex">
                <!-- copyright -->
                agropro.org.ua © 2024
                <div class="m-auto"></div>
                <div>
                    <a href="agropro.org.ua">Agro</a>
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
