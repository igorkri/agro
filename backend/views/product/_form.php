<?php

use common\models\shop\ProductProperties;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use vova07\imperavi\Widget;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\shop\Product $model */
/** @var ActiveForm $form */
?>

<?php
$form = ActiveForm::begin(['options' => ['autocomplete' => "off"]]); ?>
<div id="top" class="sa-app__body">
    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
        <div class="container">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <nav class="mb-2" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-sa-simple">
                                <?php
                                echo Breadcrumbs::widget([
                                    'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                                    'homeLink' => [
                                        'label' => 'Главная ',
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
                            <?= Html::a(Yii::t('app', 'List'), Url::to(['index']), ['class' => 'btn btn-secondary me-3']) ?>
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
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button
                                        class="nav-link active"
                                        id="description-tab-1"
                                        data-bs-toggle="tab"
                                        data-bs-target="#description-tab-content-1"
                                        type="button"
                                        role="tab"
                                        aria-controls="description-tab-content-1"
                                        aria-selected="true"
                                >
                                    Основна інформація<span class="nav-link-sa-indicator"></span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button
                                        class="nav-link"
                                        id="properties-tab-1"
                                        data-bs-toggle="tab"
                                        data-bs-target="#properties-tab-content-1"
                                        type="button"
                                        role="tab"
                                        aria-controls="properties-tab-content-1"
                                        aria-selected="true"
                                >
                                    Специфікація<span class="nav-link-sa-indicator"></span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button
                                        class="nav-link"
                                        id="seo-tab-1"
                                        data-bs-toggle="tab"
                                        data-bs-target="#seo-tab-content-1"
                                        type="button"
                                        role="tab"
                                        aria-controls="seo-tab-content-1"
                                        aria-selected="true"
                                >
                                    Просунення в пошуку<span class="nav-link-sa-indicator"></span>
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content mt-4">
                            <div
                                    class="tab-pane fade show active"
                                    id="description-tab-content-1"
                                    role="tabpanel"
                                    aria-labelledby="description-tab-1"
                            >
                                <div class="card">
                                    <div class="card-body p-5">
                                        <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                class="mb-0 fs-exact-18">Основна інформація</h2></span>
                                        </div>
                                        <div class="mb-4">
                                            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                                        </div>
                                        <div class="mb-4">
                                            <?= $form->field($model, 'short_description')->widget(Widget::class, [
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
                                        <div class="mb-4">
                                            <?= $form->field($model, 'footer_description')->widget(Widget::class, [
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
                            </div>
                            <div
                                    class="tab-pane fade"
                                    id="properties-tab-content-1"
                                    role="tabpanel"
                                    aria-labelledby="properties-tab-1"
                            >
                                <?php if (!$model->isNewRecord): ?>
                                    <div class="card mt-5">
                                        <div class="card-body p-5">
                                            <div class="mb-5">
                                        <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                    class="mb-0 fs-exact-18"><?= Yii::t('app', 'Properties') ?></h2></span>
                                            </div>
                                            <?php $data_product = ProductProperties::find()->where(['product_id' => $model->id])->orderBy('sort ASC')->all();

                                            $data_category = ProductProperties::find()
                                                ->select('properties')
                                                ->distinct()
                                                ->where(['category_id' => $model->category_id])
                                                ->orderBy('sort ASC')
                                                ->all();

                                            $unique_properties = array_column($data_category, 'properties');
                                            $diff_properties = array_diff($unique_properties, array_column($data_product, 'properties'));
                                            $data = array_merge($data_product, array_filter($data_category, function ($item) use ($diff_properties) {
                                                return in_array($item['properties'], $diff_properties);
                                            }));
                                            ?>
                                            <div id="properties-container">
                                                <?php $index = 0;
                                                $uniqueArray = array_values($data);
                                                ?>
                                                <?php foreach ($uniqueArray as $productProperty): ?>
                                                    <div class="row g-4">
                                                        <div class="col-3">
                                                            <?= $form->field($productProperty, "[$index]properties")->textInput(['readonly' => true])->label(false) ?>
                                                        </div>
                                                        <div class="col-9">
                                                            <?= $form->field($productProperty, "[$index]value")->textInput()->label(false) ?>
                                                        </div>
                                                    </div>
                                                    <?php $index++; ?>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="mt-3">
                                                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div
                                    class="tab-pane fade"
                                    id="seo-tab-content-1"
                                    role="tabpanel"
                                    aria-labelledby="seo-tab-1"
                            >
                                <div class="card mt-5">
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
                                                });
                                            </script>
                                            <?= $form->field($model, 'seo_description')->textarea(['rows' => '4', 'class' => "form-control", 'id' => 'seo_description_id'])->label('SEO Опис' . ' ' . '->' . ' ' . '<label class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" style="background: #63bdf57d" id="charCountDescription" data-bs-toggle="tooltip"
                               data-bs-placement="right"
                               title="130 > 155 < 180"> 0</label>') ?>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function () {
                                                    var textLength = $('#seo_description_id').val().length;
                                                    $('#charCountDescription').text(textLength);
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= $this->render('sidebar', ['form' => $form, 'model' => $model]) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>


    <?php Modal::begin([
        "id" => "ajaxCrudModal",
        "size" => Modal::SIZE_EXTRA_LARGE,
        "footer" => "", // always need it for jquery plugin
    ]) ?>
    <?php
    Modal::end();
    ?>
    <style>
        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 35px;
            user-select: none;
            -webkit-user-select: none;
            /* width: max-content; */
        }
    </style>




