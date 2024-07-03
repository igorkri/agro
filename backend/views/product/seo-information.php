<?php


?>
<div class="card mt-5">
    <div class="card-body p-5">
        <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                class="mb-0 fs-exact-18"><?= Yii::t('app', 'Seo') ?> UK</h2></span>
        </div>
        <div class="row g-4">
            <?= $form->field($model, 'seo_title')->textInput([
                'maxlength' => true,
                'id' => 'seo_title_id',
            ])->label('SEO Тайтл' . ' ' . '->' . ' ' . '<label 
class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" 
style="background: #63bdf57d" 
id="charCountTitle" 
data-bs-toggle="tooltip"
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
            <?= $form->field($model, 'seo_description')->textarea([
                'rows' => '4',
                'class' => "form-control",
                'id' => 'seo_description_id',
            ])->label('SEO Опис' . ' ' . '->' . ' ' . '<label 
class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" 
style="background: #63bdf57d" 
id="charCountDescription" 
data-bs-toggle="tooltip"
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
<div class="card mt-5">
    <div class="card-body p-5">
        <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                class="mb-0 fs-exact-18"><?= Yii::t('app', 'Seo') ?> RU</h2></span>
        </div>
        <div class="row g-4">
            <?= $form->field($translateRu, 'seo_title')->textInput([
                'maxlength' => true,
                'id' => 'seo_title_id_ru',
                'name' => 'ProductsTranslate[ru][seo_title]',
            ])->label('SEO Тайтл' . ' ' . '->' . ' ' . '<label 
class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" 
style="background: #63bdf57d" 
id="charCountTitleRu" 
data-bs-toggle="tooltip"
                               data-bs-placement="right"
                               title="50 > 55 < 60"> 0</label>') ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var textLength = $('#seo_title_id_ru').val().length;
                    $('#charCountTitleRu').text(textLength);
                    if (textLength === 55) {
                        $('#charCountTitleRu').css('background-color', '#13bf3d87');
                    } else if (textLength >= 50 && textLength <= 54) {
                        $('#charCountTitleRu').css('background-color', '#eded248c');
                    } else if (textLength >= 56 && textLength <= 60) {
                        $('#charCountTitleRu').css('background-color', '#eded248c');
                    } else {
                        $('#charCountTitleRu').css('background-color', '#e53b3b9c');
                    }
                });
            </script>
            <?= $form->field($translateRu, 'seo_description')->textarea([
                'rows' => '4',
                'class' => "form-control",
                'id' => 'seo_description_id_ru',
                'name' => 'ProductsTranslate[ru][seo_description]',
            ])->label('SEO Опис' . ' ' . '->' . ' ' . '<label 
class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" 
style="background: #63bdf57d" 
id="charCountDescriptionRu" 
data-bs-toggle="tooltip"
                               data-bs-placement="right"
                               title="130 > 155 < 180"> 0</label>') ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var textLength = $('#seo_description_id_ru').val().length;
                    $('#charCountDescriptionRu').text(textLength);
                    if (textLength === 155) {
                        $('#charCountDescriptionRu').css('background-color', '#13bf3d87');
                    } else if (textLength >= 130 && textLength <= 154) {
                        $('#charCountDescriptionRu').css('background-color', '#eded248c');
                    } else if (textLength >= 156 && textLength <= 180) {
                        $('#charCountDescriptionRu').css('background-color', '#eded248c');
                    } else {
                        $('#charCountDescriptionRu').css('background-color', '#e53b3b9c');
                    }
                });
            </script>
        </div>
    </div>
</div>
<div class="card mt-5">
    <div class="card-body p-5">
        <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                class="mb-0 fs-exact-18"><?= Yii::t('app', 'Seo') ?> EN</h2></span>
        </div>
        <div class="row g-4">
            <?= $form->field($translateEn, 'seo_title')->textInput([
                'maxlength' => true,
                'id' => 'seo_title_id_en',
                'name' => 'ProductsTranslate[en][seo_title]',
            ])->label('SEO Тайтл' . ' ' . '->' . ' ' . '<label 
class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" 
style="background: #63bdf57d" 
id="charCountTitle_en" 
data-bs-toggle="tooltip"
                               data-bs-placement="right"
                               title="50 > 55 < 60"> 0</label>') ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var textLength = $('#seo_title_id_en').val().length;
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
            <?= $form->field($translateEn, 'seo_description')->textarea([
                'rows' => '4',
                'class' => "form-control",
                'id' => 'seo_description_id_en',
                'name' => 'ProductsTranslate[en][seo_description]',
            ])->label('SEO Опис' . ' ' . '->' . ' ' . '<label 
class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart" 
style="background: #63bdf57d" 
id="charCountDescriptionEn" 
data-bs-toggle="tooltip"
                               data-bs-placement="right"
                               title="130 > 155 < 180"> 0</label>') ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var textLength = $('#seo_description_id_en').val().length;
                    $('#charCountDescriptionEn').text(textLength);
                    if (textLength === 155) {
                        $('#charCountDescriptionEn').css('background-color', '#13bf3d87');
                    } else if (textLength >= 130 && textLength <= 154) {
                        $('#charCountDescriptionEn').css('background-color', '#eded248c');
                    } else if (textLength >= 156 && textLength <= 180) {
                        $('#charCountDescriptionEn').css('background-color', '#eded248c');
                    } else {
                        $('#charCountDescriptionEn').css('background-color', '#e53b3b9c');
                    }
                });
            </script>
        </div>
    </div>
</div>
