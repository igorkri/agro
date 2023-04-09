<?php

use kartik\file\FileInput;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\shop\Brand $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="brand-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- sa-app__body -->
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
                            <h1 class="h3 m-0"><?=$this->title?></h1>
                        </div>
                        <div class="col-auto d-flex">
                            <?php if(!$model->isNewRecord): ?>
                                <!--                            <a href="#" class="btn btn-secondary me-3">--><?php ////Yii::t('app', 'Duplicate')?><!--</a>-->
                                <?= Html::a(Yii::t('app', 'List brand'), Url::to(['index']), ['class' => 'btn btn-secondary me-3']) ?>
                                <?= Html::a(Yii::t('app', 'Create more'), Url::to(['create']), ['class' => 'btn btn-success me-3']) ?>
                            <?php endif; ?>
                            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
                <div class="sa-entity-layout" data-sa-container-query='{"920":"sa-entity-layout--size--md","1100":"sa-entity-layout--size--lg"}'>
                    <div class="sa-entity-layout__body">
                        <div class="sa-entity-layout__main">
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="mb-5"><h2 class="mb-0 fs-exact-18"><?=Yii::t('app', 'Basic information')?></h2></div>
                                    <div class="mb-4">
                                        <!--                                        <label for="form-brand/name" class="form-label">Name</label>-->
                                        <!--                                        <input type="text" class="form-control" id="form-brand/name" value="Hand Tools" />-->
                                        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(Yii::t('app', 'name')) ?>
                                        <?php // echo $form->field($model, 'slug')->hiddenInput(['maxlength' => true])->label(false) ?>
                                    </div>

                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18"><?=Yii::t('app', 'Logo')?></h2>
                                    </div>
                                    <div class="mb-4">
                                        <?php if($model->isNewRecord): ?>
                                            <?= $form->field($model, 'file')->widget(FileInput::class, [
                                                'options' => ['accept' => 'image/*'],
                                                'language' => 'uk',
                                                'pluginOptions' => [
                                                    'showCaption' => true,
                                                    'showRemove' => true,
                                                    'showUpload' => false,

                                                    'uploadLabel' => '',
                                                    'browseLabel' => '',
                                                    'removeLabel' => '',

                                                    'browseClass' => 'btn btn-success',
                                                    'uploadClass' => 'btn btn-info',
                                                    'removeClass' => 'btn btn-danger',
                                                    'removeIcon' => '<i class="fas fa-trash"></i> '
                                                ]
                                            ]);?>
                                        <?php else: ?>
                                            <?php

                                            echo $form->field($model, 'file')->widget(FileInput::classname(), [
                                                'options' => ['accept' => 'image/*'],
                                                'language' => 'uk',
                                                'pluginOptions' => [
                                                    'showCaption' => true,
                                                    'showRemove' => true,
                                                    'showUpload' => false,

                                                    'uploadLabel' => '',
                                                    'browseLabel' => '',
                                                    'removeLabel' => '',

                                                    'browseClass' => 'btn btn-success',
                                                    'uploadClass' => 'btn btn-info',
                                                    'removeClass' => 'btn btn-danger',
                                                    'removeIcon' => '<i class="fas fa-trash"></i> ',
                                                    'initialPreview'=>[
                                                        Yii::$app->request->hostInfo . '/brand/'. $model->file
                                                    ],
                                                    'initialPreviewAsData'=>true,
                                                ]
                                            ]);

                                            ?>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sa-app__body / end -->

    <?php ActiveForm::end(); ?>

</div>
