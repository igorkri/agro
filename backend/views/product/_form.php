<?php

use kartik\form\ActiveForm;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\shop\Product $model */
/** @var ActiveForm $form */
?>

<?php
$form = ActiveForm::begin(['options' => ['autocomplete' => "off"]]); ?>
<div id="top" class="sa-app__body">
    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
        <div class="container" style="max-width: 1623px">
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
                                    Характеристики<span class="nav-link-sa-indicator"></span>
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
                            <li class="nav-item" role="presentation">
                                <button
                                        class="nav-link"
                                        id="keyword-tab-1"
                                        data-bs-toggle="tab"
                                        data-bs-target="#keyword-tab-content-1"
                                        type="button"
                                        role="tab"
                                        aria-controls="keyword-tab-content-1"
                                        aria-selected="true"
                                >
                                    Ключові слова<span class="nav-link-sa-indicator"></span>
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
                                <?= $this->render('basic-information', [
                                    'form' => $form,
                                    'model' => $model,
                                    'translateRu' => $translateRu,
                                    'translateEn' => $translateEn,
                                ]) ?>
                            </div>
                            <div
                                    class="tab-pane fade"
                                    id="properties-tab-content-1"
                                    role="tabpanel"
                                    aria-labelledby="properties-tab-1"
                            >
                                <?= $this->render('properties-information', [
                                    'form' => $form,
                                    'model' => $model,
                                    'data' => $data,
                                    'dataRu' => $dataRu,
                                    'dataEn' => $dataEn,
                                    'translateRu' => $translateRu,
                                    'translateEn' => $translateEn,
                                ]) ?>
                            </div>
                            <div
                                    class="tab-pane fade"
                                    id="seo-tab-content-1"
                                    role="tabpanel"
                                    aria-labelledby="seo-tab-1"
                            >
                                <?= $this->render('seo-information', [
                                    'form' => $form,
                                    'model' => $model,
                                    'translateRu' => $translateRu,
                                    'translateEn' => $translateEn,
                                ]) ?>
                            </div>
                            <div
                                    class="tab-pane fade"
                                    id="keyword-tab-content-1"
                                    role="tabpanel"
                                    aria-labelledby="keyword-tab-1"
                            >
                                <?= 'В розробці' ?>
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




