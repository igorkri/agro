<?php
/** @var yii\web\View $this */

/** @var string $content */

use frontend\assets\AppAsset;
use frontend\widgets\SiteFooter;
use frontend\widgets\SiteHeader;
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
    <div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content"></div>
        </div>
    </div>
    <?= $this->render('mobilemenu') ?>
    <?= $this->render('photoswipe') ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>