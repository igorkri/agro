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
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?= Yii::$app->params['schema'] ?? '' ?>
        <?= Yii::$app->params['product'] ?? '' ?>
        <?= Yii::$app->params['organization'] ?? '' ?>
        <?= Yii::$app->params['webPage'] ?? '' ?>
        <?= Yii::$app->params['blog'] ?? '' ?>
        <?= Yii::$app->params['post'] ?? '' ?>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="site">
        <?php if (\Yii::$app->devicedetect->isMobile()): ?>
            <?= $this->render('mobile-site-header') ?>
        <?php endif; ?>
        <?php echo SiteHeader::widget() ?>
        <?= $content ?>
        <?php echo SiteFooter::widget() ?>
    </div>
    <?= $this->render('mobilemenu') ?>
    <?= $this->render('photoswipe') ?>
    <?= $this->render('quickview-modal') ?>
    <?= $this->render('success-compare') ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>