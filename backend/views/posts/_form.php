<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Posts $model */
/** @var yii\widgets\ActiveForm $form */

?>

<?php $form = ActiveForm::begin(); ?>
<div id="top" class="sa-app__body">
    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
        <div class="container container--max--xl">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <nav class="mb-2" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-sa-simple">
                                <?php echo Breadcrumbs::widget([
                                    'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                                    'homeLink' => [
                                        'label' => Yii::t('app', 'Home'),
                                        'url' => Yii::$app->homeUrl,
                                    ],
                                    'links' => $this->params['breadcrumbs'] ?? [],
                                ]);
                                ?>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-auto d-flex">
                        <?= Html::submitButton(
                            $model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Save'),
                            ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            <div class="sa-entity-layout"
                 data-sa-container-query='{"920":"sa-entity-layout--size--md","1100":"sa-entity-layout--size--lg"}'>
                <div class="sa-entity-layout__body">
                    <div class="sa-entity-layout__main">
                        <?php
                        $commonParams = ['model' => $model, 'form' => $form];
                        if (isset($translateRu)) {
                            $commonParams['translateRu'] = $translateRu;
                            $commonParams['translateEn'] = $translateEn;
                        }
                        ?>

                        <?php echo $this->render('basic-information', $commonParams); ?>
                        <?php echo $this->render('post-products', $commonParams); ?>

                        <div class="row">
                            <div class="col-8">
                                <?php echo $this->render('seo-information', $commonParams); ?>
                            </div>
                            <div class="col-4">
                                <?php echo $this->render('image-upload', $commonParams); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

