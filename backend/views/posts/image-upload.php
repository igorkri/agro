<?php

use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var common\models\Posts $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card mt-5">
    <div class="card-body p-5">
        <div class="mb-5">
                                        <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                    class="mb-0 fs-exact-18"><?= Yii::t('app', 'Image 730x490') ?></h2></span>
        </div>
        <div class="mb-4">
            <?php if ($model->isNewRecord): ?>
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
                ]); ?>
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
                        'initialPreview' => [
                            Yii::$app->request->hostInfo . '/posts/' . $model->image
                        ],
                        'initialPreviewAsData' => true,
                    ]
                ]); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
