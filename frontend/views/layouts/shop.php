<?php
/** @var yii\web\View $this */
/** @var string $content */

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
    <link type="image/png" href="/images/favicon.png" rel="icon">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?= Yii::$app->params['schema'] ?? '' ?>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<!-- site -->
<div class="site">

    <!-- mobile site__header -->
          <?= $this->render('mobile-site-header')?>
    <!-- mobile site__header / end -->

    <!-- desktop site__header -->
          <?= $this->render('site-header')?>
    <!--  desktop site__header / end -->

    <?= $content ?>

    <!-- site__footer -->
          <?=$this->render('site-footer')?> 
    <!-- site__footer / end -->
    
</div>
<!-- site / end -->

<!-- quickview-modal -->
<div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content"></div>
    </div>
</div>
<!-- quickview-modal / end -->

<!-- mobilemenu -->
       <?=$this->render('mobilemenu')?>
<!-- mobilemenu / end -->

<!-- photoswipe -->
       <?=$this->render('photoswipe')?>
<!-- photoswipe / end -->

<?php $this->endBody() ?>

<script src="/vendor/svg4everybody/svg4everybody.min.js"></script>
<script> svg4everybody(); </script>

</body>
</html>
<?php $this->endPage() ?>