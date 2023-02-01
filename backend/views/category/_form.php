<?php

use common\models\shop\Category;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var common\models\shop\Category $model */
/** @var ActiveForm $form */
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
                                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                    ]);
                                    ?>
                                </ol>
                            </nav>
                            <h1 class="h3 m-0"><?=$this->title?></h1>
                        </div>
                        <div class="col-auto d-flex">
                            <?php if(!$model->isNewRecord): ?>
<!--                            <a href="#" class="btn btn-secondary me-3">--><?php ////Yii::t('app', 'Duplicate')?><!--</a>-->
                                <?= Html::a(Yii::t('app', 'List category'), Url::to(['index']), ['class' => 'btn btn-secondary me-3']) ?>
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
<!--                                        <label for="form-category/name" class="form-label">Name</label>-->
<!--                                        <input type="text" class="form-control" id="form-category/name" value="Hand Tools" />-->
                                        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(Yii::t('app', 'name')) ?>
                                        <?php // echo $form->field($model, 'slug')->hiddenInput(['maxlength' => true])->label(false) ?>
                                    </div>
                                    <div class="mb-4">

                                        <?= $form->field($model, 'description')->widget(\bizley\quill\Quill::class, [
                                            // 'class'=>"sa-quill-control form-control",
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
                                        <h2 class="mb-0 fs-exact-18"><?=Yii::t('app', 'Search engine optimization')?></h2>
                                        <div class="mt-3 text-muted">
                                            <?=Yii::t('app', 'Provide information that will help improve the snippet and bring your category to the top of search engines.')?>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <?= $form->field($model, 'pageTitle')->textInput(['maxlength' => true])->label(Yii::t('app', 'pageTitle')) ?>
                                    </div>
                                    <div>
                                        <?= $form->field($model, 'metaDescription')->textarea(['maxlength' => true, 'rows' => 6])->label(Yii::t('app', 'Meta Description')) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sa-entity-layout__sidebar">
                            <div class="card w-100">
                                <div class="card-body p-5">
                                    <div class="mb-5"><h2 class="mb-0 fs-exact-18"><?=Yii::t('app', 'visibility')?></h2></div>
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
                                    <div class="mb-5"><h2 class="mb-0 fs-exact-18"><?=Yii::t('app', 'Parent category')?></h2></div>
                                    <?php
                                    $data = ArrayHelper::map(Category::find()
                                        ->where(['parentId' => null])->orderBy('id')
                                        ->asArray()->all(), 'id', 'name');
                                    echo $form->field($model, 'parentId')->widget(Select2::classname(), [
                                        'data' => $data,
                                        'theme' => Select2::THEME_DEFAULT,
                                        'maintainOrder' => true,
                                        'pluginLoading' => false,
                                        'options' => [
                                            'placeholder' => Yii::t('app', 'Select category...'),
                                            'class' => 'sa-select2 form-select',
                                            // 'data-tags'=>'true',
//                                            'multiple' => true
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'width' => '272px',
                                        ],
                                    ])->label(false);
                                    ?>
                                    <div class="form-text"><?=Yii::t('app', 'Select a category that will be the parent of the current one.')?></div>
                                </div>
                            </div>
                            <div class="card w-100 mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5"><h2 class="mb-0 fs-exact-18"><?=Yii::t('app', 'Image')?></h2></div>
                                    <div class="border p-4 d-flex justify-content-center">
                                        <div class="max-w-20x">
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
                                                            Yii::$app->request->hostInfo . '/category/'. $model->file
                                                        ],
                                                        'initialPreviewAsData'=>true,
                                                    ]
                                                ]);

                                                ?>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <div class="mt-4 mb-n2">
<!--                                        $model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary'])-->
<!--                                        <a href="#" class="me-3 pe-2">--><?php ////$model->isNewRecord ? Yii::t('app', 'Download saving') : Yii::t('app', 'Replace image')?><!--</a>-->
<!--                                        <a href="#" class="text-danger me-3 pe-2">--><?php //// $model->isNewRecord ? Yii::t('app', '') : Yii::t('app', 'Remove image')?><!--</a>-->
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

