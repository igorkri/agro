<?php

use kartik\file\FileInput;
use vova07\imperavi\Widget;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Posts $model */
/** @var yii\widgets\ActiveForm $form */
?>

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
                    </div>
                    <div class="col-auto d-flex">
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
                            <div class="row">
                                <div class="col-8 mb-4">
                                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-4 mb-4">
                                    <?= $form->field($model, 'date_public')->textInput() ?>
                                </div>
                            </div>
                                <div class="mb-4">
                                    <?= $form->field($model, 'description')->widget(Widget::class, [
                                        'defaultSettings' => [
                                            'style' => 'position: unset;'
                                        ],
                                        'settings' => [
                                            'lang' => 'uk',
                                            'minHeight' => 100,
                                            'plugins' => [
                                                'fullscreen',
                                                'table',
                                            ],
                                        ],
                                    ]);?>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <h2 class="mb-0 fs-exact-18"><?=Yii::t('app', 'Image 730x490')?></h2>
                                </div>
                                <div class="mb-4">
                                    <?php if($model->isNewRecord): ?>
                                        <?= $form->field($model, 'image')->widget(FileInput::class, [
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

                                        echo $form->field($model, 'image')->widget(FileInput::class, [
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
                                                    Yii::$app->request->hostInfo . '/posts/'. $model->image
                                                ],
                                                'initialPreviewAsData'=>true,
                                            ]
                                        ]); ?>
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

