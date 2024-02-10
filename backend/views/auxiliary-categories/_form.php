<?php

use bizley\quill\Quill;
use common\models\shop\AuxiliaryCategories;
use common\models\shop\Category;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\shop\AuxiliaryCategories $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php $form = ActiveForm::begin([
//     'enableClientValidation' => true,
//     'enableAjaxValidation'   => true,
    // 'id' => 'form-view-modal',
//    'fieldConfig' => [
//        'options' => [
//            'tag' => false,
//        ]
//    ]
]); ?>
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
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]);
                                ?>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-auto d-flex">
                        <?php if (!$model->isNewRecord): ?>
                            <?= Html::a(Yii::t('app', 'List category'), Url::to(['index']), ['class' => 'btn btn-secondary me-3']) ?>
                            <?= Html::a(Yii::t('app', 'Create more'), Url::to(['create']), ['class' => 'btn btn-success me-3']) ?>
                        <?php endif; ?>
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
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"> <h2 class="mb-0 fs-exact-18"><?= Yii::t('app', 'Basic information') ?></h2></span>
                                </div>
                                <div class="row">
                                    <div class="col-4 mb-4">
                                        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(Yii::t('app', 'name')) ?>
                                    </div>
<!--                                    <div class="col-6 mb-4">-->
<!--                                        --><?php //= $form->field($model, 'prefix')->textInput(['maxlength' => true])->label(Yii::t('app', 'prefix')) ?>
<!--                                    </div>-->
                                    <div class="col-4 mb-4">
                                        <?= $form->field($model, 'object')->textInput(['maxlength' => true])->label(Yii::t('app', 'object')) ?>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <?= $form->field($model, 'date_updated')->textInput([
                                            'maxlength' => true,
                                            'class' => 'form-control',
                                            'value' => Yii::$app->formatter->asDatetime($model->date_updated),
                                            'readonly' => true,
                                        ])->label(Yii::t('app', 'Date Updated')) ?>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <?= $form->field($model, 'description')->widget(Quill::class, [
                                        'toolbarOptions' => [
                                            [
                                                ['font' => []],
                                                [
                                                    'size' => [
                                                        'small',
                                                        false,
                                                        'large',
                                                        'huge',
                                                    ],
                                                ],
                                            ],
                                            [
                                                'bold',
                                                'italic',
                                                'underline',
                                                'strike',
                                            ],
                                            [
                                                ['color' => []],
                                                ['background' => []],
                                            ],
                                            [
                                                ['script' => 'sub'],
                                                ['script' => 'super'],
                                            ],
                                            [
                                                ['header' => 1],
                                                ['header' => 2],
                                                'blockquote',
                                                'code-block',
                                            ],
                                            [
                                                ['list' => 'ordered'],
                                                ['list' => 'bullet'],
                                                ['indent' => '-1'],
                                                ['indent' => '+1'],
                                            ],
                                            [
                                                ['direction' => 'rtl'],
                                                ['align' => []],
                                            ],
                                            [
                                                'link',
                                                'image',
                                                'video',
                                            ],
                                            [
                                                'clean',
                                            ],
                                        ],
                                    ])->label(Yii::t('app', 'Description')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"> <h2 class="mb-0 fs-exact-18"><?= Yii::t('app', 'SVG for menu') ?></h2></span>
                                </div>
                                <div class="mb-4">
                                    <?= $form->field($model, 'svg')->textInput(['maxlength' => true])->label(Yii::t('app', 'SVG')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"> <h2 class="mb-0 fs-exact-18"><?= Yii::t('app', 'Search engine optimization') ?></h2></span>
                                    <div class="mt-3 text-muted">
                                        <?= Yii::t('app', 'Provide information that will help improve the snippet and bring your category to the top of search engines.') ?>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <?= $form->field($model, 'pageTitle')->textInput(['maxlength' => true, 'id' => 'seo_title_id'])->label('SEO Тайтл' . ' ' . '->' . ' ' . '<label class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" style="background: #63bdf57d" id="charCountTitle" data-bs-toggle="tooltip"
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
                                                $('#charCountTitle').css('background-color', '#e53b3b9c');
                                            }
                                        });
                                    </script>
                                    <?= $form->field($model, 'metaDescription')->textarea(['rows' => '4', 'class' => "form-control", 'id' => 'seo_description_id'])->label('SEO Опис' . ' ' . '->' . ' ' . '<label class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" style="background: #63bdf57d" id="charCountDescription" data-bs-toggle="tooltip"
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
                                                $('#charCountDescription').css('background-color', '#e53b3b9c');
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sa-entity-layout__sidebar">
                        <div class="card w-100">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2 class="mb-0 fs-exact-18"><?= Yii::t('app', 'visibility') ?></h2></span>
                                </div>
                                <div class="mb-4">
                                    <?= $form->field($model, 'visibility')
                                        ->radioList(
                                            [
                                                1 => Yii::t('app', 'Published'),
                                                0 => Yii::t('app', 'Hidden'),
                                            ],
                                            [
                                                'item' => function ($index, $label, $name, $checked, $value) {
                                                    $return = '<label class="form-check">';
                                                    $return .= '<input class="form-check-input" type="radio" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '>';
                                                    $return .= ucwords($label);
                                                    $return .= '</label>';
                                                    return $return;
                                                },

                                            ],
                                        )->label(false); ?>
                                </div>
                            </div>
                        </div>
                        <div class="card w-100 mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"> <h2 class="mb-0 fs-exact-18"><?= Yii::t('app', 'Parent category') ?></h2></span>
                                </div>
                                <?php
                                $data = ArrayHelper::map(Category::find()
                                    ->where('parentId IS NOT NULL')->orderBy('id')
                                    ->asArray()->all(), 'id', 'name');
                                echo $form->field($model, 'parentId')->widget(Select2::classname(), [
                                    'data' => $data,
                                    'theme' => Select2::THEME_DEFAULT,
                                    'maintainOrder' => true,
                                    'pluginLoading' => false,
                                    'options' => [
                                        'placeholder' => Yii::t('app', 'Select category...'),
                                        'class' => 'sa-select2 form-select',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'width' => '272px',
                                    ],
                                ])->label(false);
                                ?>
<!--                                <div class="form-text">--><?php //= Yii::t('app', 'Select a category that will be the parent of the current one.') ?><!--</div>-->
                            </div>
                        </div>
                        <div class="card w-100 mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2 class="mb-0 fs-exact-18"><?= Yii::t('app', 'Image 231 x 231') ?></h2></span>
                                </div>
                                <div class="p-4 d-flex justify-content-center">
                                    <div class="max-w-20x">
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

                                            echo $form->field($model, 'image')->widget(FileInput::classname(), [
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
                                                        Yii::$app->request->hostInfo . '/auxiliary-categories/' . $model->image
                                                    ],
                                                    'initialPreviewAsData' => true,
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
</div>
<?php ActiveForm::end(); ?>