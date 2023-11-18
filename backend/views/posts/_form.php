<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use vova07\imperavi\Widget;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\ArrayHelper;
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
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            <div class="sa-entity-layout"
                 data-sa-container-query='{"920":"sa-entity-layout--size--md","1100":"sa-entity-layout--size--lg"}'>
                <div class="sa-entity-layout__body">
                    <div class="sa-entity-layout__main">
                        <div class="card">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                class="mb-0 fs-exact-18"><?= Yii::t('app', 'Basic information') ?></h2></span>
                                </div>
                                <div class="row">
                                    <div class="col-8 mb-4">
                                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <?php if (!$model->isNewRecord) { ?>
                                            <?= $form->field($model, 'date_public')->textInput() ?>
                                        <?php } ?>
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
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                class="mb-0 fs-exact-18"><?= Yii::t('app', 'Product post') ?></h2></span>
                                </div>
                                <div class="row">
                                    <div class="col-8 mb-4">
                                        <?php
                                        $data = ArrayHelper::map(\common\models\shop\Product::find()->orderBy('id')->asArray()->all(), 'id', 'name');
                                        echo $form->field($model, 'products')->widget(Select2::classname(), [
                                            'data' => $data,
                                            'theme' => \kartik\select2\Select2::THEME_DEFAULT,
                                            'maintainOrder' => true,
                                            'pluginLoading' => false,
                                            'toggleAllSettings' => [
                                                'selectLabel' => '<i class="fas fa-check-circle"></i> Выбрать все',
                                                'unselectLabel' => '<i class="fas fa-times-circle"></i> Удалить все',
                                                'selectOptions' => ['class' => 'text-success'],
                                                'unselectOptions' => ['class' => 'text-danger'],
                                            ],
                                            'options' => [
                                                'placeholder' => 'Виберіть продукт ...',
                                                'class' => 'sa-select2 form-select',
                                                // 'data-tags'=>'true',
                                                'multiple' => true
                                            ],
                                            'pluginOptions' => [
                                                'closeOnSelect' => false,
                                                'tags' => true,
                                                'tokenSeparators' => [', ', ' '],
                                                'maximumInputLength' => 10,
                                                'width' => '100%',
                                            ],
                                        ])->label(false);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="card col-8">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                    class="mb-0 fs-exact-18"><?= Yii::t('app', 'Seo') ?></h2></span>
                                    </div>
                                    <div class="row g-4">
                                        <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true, 'id' => 'seo_title_id'])->label('SEO Тайтл' . ' ' . '->' . ' ' . '<label class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" style="background: #63bdf57d" id="charCountTitle" data-bs-toggle="tooltip"
                               data-bs-placement="right"
                               title="50 > 55 < 60"> 0</label>') ?>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                var textLength = $('#seo_title_id').val().length;
                                                $('#charCountTitle').text(textLength);
                                                if (textLength === 55) {
                                                    $('#charCountTitle').css('background-color', '#13bf3d87');
                                                } else if (textLength >= 50 && textLength <= 54) {
                                                    $('#charCountTitle').css('background-color', '#eded248c');
                                                } else if (textLength >= 56 && textLength <= 60) {
                                                    $('#charCountTitle').css('background-color', '#eded248c');
                                                } else {
                                                    $('#charCountTitle').css('background-color', '#e53b3b9c'); // сброс цвета фона
                                                }
                                            });
                                        </script>
                                        <?= $form->field($model, 'seo_description')->textarea(['rows' => '4', 'class' => "form-control", 'id' => 'seo_description_id'])->label('SEO Опис' . ' ' . '->' . ' ' . '<label class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" style="background: #63bdf57d" id="charCountDescription" data-bs-toggle="tooltip"
                               data-bs-placement="right"
                               title="130 > 155 < 180"> 0</label>') ?>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                var textLength = $('#seo_description_id').val().length;
                                                $('#charCountDescription').text(textLength);
                                                if (textLength === 155) {
                                                    $('#charCountDescription').css('background-color', '#13bf3d87');
                                                } else if (textLength >= 130 && textLength <= 154) {
                                                    $('#charCountDescription').css('background-color', '#eded248c');
                                                } else if (textLength >= 156 && textLength <= 180) {
                                                    $('#charCountDescription').css('background-color', '#eded248c');
                                                } else {
                                                    $('#charCountDescription').css('background-color', '#e53b3b9c'); // сброс цвета фона
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-4">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

