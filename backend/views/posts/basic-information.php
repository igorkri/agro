<?php

use vova07\imperavi\Widget;

/** @var yii\web\View $this */
/** @var common\models\Posts $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card">
    <div class="card-body p-5">
        <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                class="mb-0 fs-exact-18"><?= Yii::t('app', 'Basic information') ?></h2></span>
        </div>
        <ul class="nav nav-tabs card-header-tabs mb-5" role="tablist">
            <li class="nav-item" role="presentation">
                <button
                        class="nav-link active"
                        id="description-tab-uk"
                        data-bs-toggle="tab"
                        data-bs-target="#description-tab-content-uk"
                        type="button"
                        role="tab"
                        aria-controls="description-tab-content-uk"
                        aria-selected="true"
                >
                    UK<span class="nav-link-sa-indicator"></span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                        class="nav-link"
                        id="description-tab-ru"
                        data-bs-toggle="tab"
                        data-bs-target="#description-tab-content-ru"
                        type="button"
                        role="tab"
                        aria-controls="description-tab-content-ru"
                        aria-selected="true"
                >
                    RU<span class="nav-link-sa-indicator"></span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                        class="nav-link"
                        id="description-tab-en"
                        data-bs-toggle="tab"
                        data-bs-target="#description-tab-content-en"
                        type="button"
                        role="tab"
                        aria-controls="description-tab-content-en"
                        aria-selected="true"
                >
                    EN<span class="nav-link-sa-indicator"></span>
                </button>
            </li>
        </ul>

        <div class="tab-content">
            <div
                    class="tab-pane fade show active"
                    id="description-tab-content-uk"
                    role="tabpanel"
                    aria-labelledby="description-tab-uk"
            >
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
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
            <div
                    class="tab-pane fade"
                    id="description-tab-content-ru"
                    role="tabpanel"
                    aria-labelledby="description-tab-ru"
            >
                <?php if (isset($translateRu)): ?>
                    <div class="row">

                        <div class="col-8 mb-4">
                            <?= $form->field($translateRu, 'title')->textInput(['maxlength' => true, 'id' => 'translateRu-title', 'name' => 'PostsTranslate[ru][title]']) ?>
                        </div>
                        <div class="col-4 mb-4">
                            <?php if (!$model->isNewRecord) { ?>
                                <?= $form->field($model, 'date_public')->textInput() ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="mb-4">
                        <?= $form->field($translateRu, 'description')->widget(Widget::class, [
                            'options' => ['id' => 'translateRu-description', 'name' => 'PostsTranslate[ru][description]'],
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
                <?php endif; ?>
            </div>
            <div
                    class="tab-pane fade"
                    id="description-tab-content-en"
                    role="tabpanel"
                    aria-labelledby="description-tab-en"
            >
                <?php if (isset($translateEn)): ?>
                    <div class="row">
                        <div class="col-8 mb-4">
                            <?= $form->field($translateEn, 'title')->textInput(['maxlength' => true, 'id' => 'translateEn-title', 'name' => 'PostsTranslate[en][title]']) ?>
                        </div>
                        <div class="col-4 mb-4">
                            <?php if (!$model->isNewRecord) { ?>
                                <?= $form->field($model, 'date_public')->textInput() ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="mb-4">
                        <?= $form->field($translateEn, 'description')->widget(Widget::class, [
                            'options' => ['id' => 'translateEn-description', 'name' => 'PostsTranslate[en][description]'],
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
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
