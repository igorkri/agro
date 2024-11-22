<?php

use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\shop\Tag $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tag-form">
    <?php $form = ActiveForm::begin(); ?>
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container container--max--xl">
                <div class="d-flex">
                    <?php if (!$model->isNewRecord): ?>
                        <?= Html::a(Yii::t('app', 'List'), Url::to(['index']), ['class' => 'btn btn-secondary me-3']) ?>
                        <?= Html::a(Yii::t('app', 'Create more'), Url::to(['create']), ['class' => 'btn btn-success me-3']) ?>
                    <?php endif; ?>
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                </div>
                <div class="sa-entity-layout"
                     data-sa-container-query='{"920":"sa-entity-layout--size--md","1100":"sa-entity-layout--size--lg"}'>
                    <div class="sa-entity-layout__body">
                        <div class="sa-entity-layout__main">
                            <div class="card">
                                <div class="card-header">
                                    <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"> <h2
                                                class="mb-0 fs-exact-18"><?= Yii::t('app', 'Basic information') ?></h2></span>
                                    </div>
                                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button
                                                    class="nav-link active"
                                                    id="home-tab-2"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#home-tab-content-2"
                                                    type="button"
                                                    role="tab"
                                                    aria-controls="home-tab-content-2"
                                                    aria-selected="true"
                                            >
                                                UK<span class="nav-link-sa-indicator"></span>
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button
                                                    class="nav-link"
                                                    id="profile-tab-2"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#profile-tab-content-2"
                                                    type="button"
                                                    role="tab"
                                                    aria-controls="profile-tab-content-2"
                                                    aria-selected="true"
                                            >
                                                RU<span class="nav-link-sa-indicator"></span>
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button
                                                    class="nav-link"
                                                    id="contact-tab-2"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#contact-tab-content-2"
                                                    type="button"
                                                    role="tab"
                                                    aria-controls="contact-tab-content-2"
                                                    aria-selected="true"
                                            >
                                                EN<span class="nav-link-sa-indicator"></span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div
                                                class="tab-pane fade show active"
                                                id="home-tab-content-2"
                                                role="tabpanel"
                                                aria-labelledby="home-tab-2"
                                        >
                                            <div class="card">
                                                <div class="card-body p-5">
                                                    <div class="col-4 mb-4">
                                                        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(Yii::t('app', 'name')) ?>
                                                    </div>
                                                    <div class="mb-4">
                                                        <?= $form->field($model, 'description')->widget(Widget::class, [
                                                            'options' => ['id' => 'uk-description'],
                                                            'defaultSettings' => [
                                                                'style' => 'position: unset;'
                                                            ],
                                                            'settings' => [
                                                                'lang' => 'uk',
                                                                'minHeight' => 100,
                                                                'plugins' => [
                                                                    'fullscreen',
                                                                    'table',
                                                                    'fontcolor',
                                                                ],
                                                            ],
                                                        ]); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                                class="tab-pane fade"
                                                id="profile-tab-content-2"
                                                role="tabpanel"
                                                aria-labelledby="profile-tab-2"
                                        >
                                            <div class="card">
                                                <?php if (isset($translateRu)): ?>
                                                    <div class="card-body p-5">
                                                        <div class="row">
                                                            <div class="col-4 mb-4">
                                                                <?= $form->field($translateRu, 'name')->textInput(['maxlength' => true, 'id' => 'translateRu-name', 'name' => 'TagTranslate[ru][name]'])->label(Yii::t('app', 'name')) ?>
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <?= $form->field($translateRu, 'description')->widget(Widget::class, [
                                                                'options' => ['id' => 'translateRu-description', 'name' => 'TagTranslate[ru][description]'],
                                                                'defaultSettings' => [
                                                                    'style' => 'position: unset;'
                                                                ],
                                                                'settings' => [
                                                                    'lang' => 'uk',
                                                                    'minHeight' => 100,
                                                                    'plugins' => [
                                                                        'fullscreen',
                                                                        'table',
                                                                        'fontcolor',
                                                                    ],
                                                                ],
                                                            ]); ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div
                                                class="tab-pane fade"
                                                id="contact-tab-content-2"
                                                role="tabpanel"
                                                aria-labelledby="contact-tab-2"
                                        >
                                            <div class="card">
                                                <?php if (isset($translateEn)): ?>
                                                    <div class="card-body p-5">
                                                        <div class="row">
                                                            <div class="col-4 mb-4">
                                                                <?= $form->field($translateEn, 'name')->textInput(['maxlength' => true, 'id' => 'translateEn-name', 'name' => 'TagTranslate[en][name]'])->label(Yii::t('app', 'name')) ?>
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <?= $form->field($translateEn, 'description')->widget(Widget::class, [
                                                                'options' => ['id' => 'translateEn-description', 'name' => 'TagTranslate[en][description]'],
                                                                'defaultSettings' => [
                                                                    'style' => 'position: unset;'
                                                                ],
                                                                'settings' => [
                                                                    'lang' => 'uk',
                                                                    'minHeight' => 100,
                                                                    'plugins' => [
                                                                        'fullscreen',
                                                                        'table',
                                                                        'fontcolor',
                                                                    ],
                                                                ],
                                                            ]); ?>
                                                        </div>
                                                    </div>
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
    </div>
    <?php ActiveForm::end(); ?>
</div>


