<?php

/** @var yii\web\View $this */
/** @var common\models\Posts $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="card mt-5">
    <div class="card-body p-5">
        <div class="mb-5">
                                        <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                    class="mb-0 fs-exact-18"><?= Yii::t('app', 'Seo') ?></h2></span>
        </div>
        <ul class="nav nav-tabs card-header-tabs mb-5" role="tablist">
            <li class="nav-item" role="presentation">
                <button
                        class="nav-link active"
                        id="seo-tab-uk"
                        data-bs-toggle="tab"
                        data-bs-target="#seo-tab-content-uk"
                        type="button"
                        role="tab"
                        aria-controls="seo-tab-content-uk"
                        aria-selected="true"
                >
                    UK<span class="nav-link-sa-indicator"></span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                        class="nav-link"
                        id="seo-tab-ru"
                        data-bs-toggle="tab"
                        data-bs-target="#seo-tab-content-ru"
                        type="button"
                        role="tab"
                        aria-controls="seo-tab-content-ru"
                        aria-selected="true"
                >
                    RU<span class="nav-link-sa-indicator"></span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                        class="nav-link"
                        id="seo-tab-en"
                        data-bs-toggle="tab"
                        data-bs-target="#seo-tab-content-en"
                        type="button"
                        role="tab"
                        aria-controls="seo-tab-content-en"
                        aria-selected="true"
                >
                    EN<span class="nav-link-sa-indicator"></span>
                </button>
            </li>
        </ul>
        <div class="row g-4">
            <div class="tab-content">
                <div
                        class="tab-pane fade show active"
                        id="seo-tab-content-uk"
                        role="tabpanel"
                        aria-labelledby="seo-tab-uk"
                >
                    <div class="mb-5">
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
                                    $('#charCountTitle').css('background-color', '#e53b3b9c');
                                }
                            });
                        </script>
                    </div>
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
                                $('#charCountDescription').css('background-color', '#e53b3b9c');
                            }
                        });
                    </script>
                </div>
                <div
                        class="tab-pane fade"
                        id="seo-tab-content-ru"
                        role="tabpanel"
                        aria-labelledby="seo-tab-ru"
                >
                    <div class="mb-5">
                        <?php if (isset($translateRu)): ?>
                        <?= $form->field($translateRu, 'seo_title')
                            ->textInput(['maxlength' => true, 'id' => 'seo_title_ru_id', 'name' => 'PostsTranslate[ru][seo_title]'])
                            ->label('SEO Тайтл' . ' ' . '->' . ' ' . '<label 
                               class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" 
                               style="background: #63bdf57d" 
                               id="charCountTitle_ru" 
                               data-bs-toggle="tooltip"
                               data-bs-placement="right"
                               title="50 > 55 < 60"> 0</label>') ?>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var textLength = $('#seo_title_ru_id').val().length;
                                $('#charCountTitle_ru').text(textLength);
                                if (textLength === 55) {
                                    $('#charCountTitle_ru').css('background-color', '#13bf3d87');
                                } else if (textLength >= 50 && textLength <= 54) {
                                    $('#charCountTitle_ru').css('background-color', '#eded248c');
                                } else if (textLength >= 56 && textLength <= 60) {
                                    $('#charCountTitle_ru').css('background-color', '#eded248c');
                                } else {
                                    $('#charCountTitle_ru').css('background-color', '#e53b3b9c');
                                }
                            });
                        </script>
                    </div>
                    <?= $form->field($translateRu, 'seo_description')
                        ->textarea(['rows' => '4', 'class' => "form-control", 'id' => 'seo_description_ru_id', 'name' => 'PostsTranslate[ru][seo_description]'])
                        ->label('SEO Опис' . ' ' . '->' . ' ' . '<label 
                               class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" 
                               style="background: #63bdf57d" 
                               id="charCountDescription_ru" 
                               data-bs-toggle="tooltip"
                               data-bs-placement="right"
                               title="130 > 155 < 180"> 0</label>') ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var textLength = $('#seo_description_ru_id').val().length;
                            $('#charCountDescription_ru').text(textLength);
                            if (textLength === 155) {
                                $('#charCountDescription_ru').css('background-color', '#13bf3d87');
                            } else if (textLength >= 130 && textLength <= 154) {
                                $('#charCountDescription_ru').css('background-color', '#eded248c');
                            } else if (textLength >= 156 && textLength <= 180) {
                                $('#charCountDescription_ru').css('background-color', '#eded248c');
                            } else {
                                $('#charCountDescription_ru').css('background-color', '#e53b3b9c');
                            }
                        });
                    </script>
                    <?php else: ?>
                </div>
                <?php endif; ?>
            </div>
            <div
                    class="tab-pane fade"
                    id="seo-tab-content-en"
                    role="tabpanel"
                    aria-labelledby="seo-tab-en"
            >
                <div class="mb-5">
                    <?php if (isset($translateEn)): ?>
                    <?= $form->field($translateEn, 'seo_title')
                        ->textInput(['maxlength' => true,
                            'id' => 'seo_title_en_id',
                            'name' => 'PostsTranslate[en][seo_title]'])
                        ->label('SEO Тайтл' . ' ' . '->' . ' ' . '<label 
                               class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" 
                               style="background: #63bdf57d" 
                               id="charCountTitle_en" 
                               data-bs-toggle="tooltip"
                               data-bs-placement="right"
                               title="50 > 55 < 60"> 0</label>') ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var textLength = $('#seo_title_en_id').val().length;
                            $('#charCountTitle_en').text(textLength);
                            if (textLength === 55) {
                                $('#charCountTitle_en').css('background-color', '#13bf3d87');
                            } else if (textLength >= 50 && textLength <= 54) {
                                $('#charCountTitle_en').css('background-color', '#eded248c');
                            } else if (textLength >= 56 && textLength <= 60) {
                                $('#charCountTitle_en').css('background-color', '#eded248c');
                            } else {
                                $('#charCountTitle_en').css('background-color', '#e53b3b9c');
                            }
                        });
                    </script>
                </div>
                <?= $form->field($translateEn, 'seo_description')
                    ->textarea(['rows' => '4',
                        'class' => "form-control",
                        'id' => 'seo_description_en_id',
                        'name' => 'PostsTranslate[en][seo_description]'])
                    ->label('SEO Опис' . ' ' . '->' . ' ' . '<label 
                               class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" 
                               style="background: #63bdf57d" 
                               id="charCountDescription_en" 
                               data-bs-toggle="tooltip"
                               data-bs-placement="right"
                               title="130 > 155 < 180"> 0</label>') ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var textLength = $('#seo_description_en_id').val().length;
                        $('#charCountDescription_en').text(textLength);
                        if (textLength === 155) {
                            $('#charCountDescription_en').css('background-color', '#13bf3d87');
                        } else if (textLength >= 130 && textLength <= 154) {
                            $('#charCountDescription_en').css('background-color', '#eded248c');
                        } else if (textLength >= 156 && textLength <= 180) {
                            $('#charCountDescription_en').css('background-color', '#eded248c');
                        } else {
                            $('#charCountDescription_en').css('background-color', '#e53b3b9c');
                        }
                    });
                </script>
                <?php else: ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</div>
