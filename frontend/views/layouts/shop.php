<?php

/** @var yii\web\View $this */

/** @var string $content */

use frontend\widgets\SiteHeader;
use frontend\widgets\SiteFooter;
use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" dir="ltr">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" href="/images/logo-agro.png">
        <link rel="manifest" href="/manifest.json">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>

        <?= Yii::$app->params['schema'] ?? '' ?>
        <?= Yii::$app->params['product'] ?? '' ?>
        <?= Yii::$app->params['organization'] ?? '' ?>
        <?= Yii::$app->params['webPage'] ?? '' ?>
        <?= Yii::$app->params['blog'] ?? '' ?>
        <?= Yii::$app->params['post'] ?? '' ?>
        <?= Yii::$app->params['breadcrumb'] ?? '' ?>

        <?php $this->head() ?>

        <?php if (isset(Yii::$app->params['alternateUrls'])): ?>
            <link rel="alternate" hreflang="uk" href="<?= Yii::$app->params['alternateUrls']['ukUrl'] ?? '' ?>"/>
            <link rel="alternate" hreflang="en" href="<?= Yii::$app->params['alternateUrls']['enUrl'] ?? '' ?>"/>
            <link rel="alternate" hreflang="ru" href="<?= Yii::$app->params['alternateUrls']['ruUrl'] ?? '' ?>"/>
        <?php endif; ?>

<!--        <script async src="https://www.googletagmanager.com/gtag/js?id=G-RYNR0B69QV"></script>-->
<!--        <script>-->
<!--            window.dataLayer = window.dataLayer || [];-->
<!--            function gtag(){dataLayer.push(arguments);}-->
<!--            gtag('js', new Date());-->
<!---->
<!--            gtag('config', 'G-RYNR0B69QV');-->
<!--        </script>-->

    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="site">
        <?php echo SiteHeader::widget() ?>
        <?= $content ?>
        <?php echo SiteFooter::widget() ?>
    </div>
    <?= $this->render('quickview-modal') ?>
    <?= $this->render('success-compare') ?>
    <?= $this->render('success-wish') ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>