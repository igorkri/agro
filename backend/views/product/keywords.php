<?php


?>
    <div class="card mt-5">
        <div class="card-body p-5">
            <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                class="mb-0 fs-exact-18"><?= Yii::t('app', 'Keywords') ?> UK</h2></span>
            </div>
            <div class="row g-4">
                <?= $form->field($model, 'keywords')->textInput([
                    'maxlength' => true,
                    'id' => 'keywords_id',
                ])->label('Keywords') ?>
            </div>
        </div>
    </div>
<?php if (isset($translateRu)): ?>
    <div class="card mt-5">
        <div class="card-body p-5">
            <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                class="mb-0 fs-exact-18"><?= Yii::t('app', 'Keywords') ?> RU</h2></span>
            </div>
            <div class="row g-4">
                <?= $form->field($translateRu, 'keywords')->textInput([
                    'maxlength' => true,
                    'id' => 'keywords_id_ru',
                    'name' => 'ProductsTranslate[ru][keywords]',
                ])->label('Keywords') ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($translateEn)): ?>
    <div class="card mt-5">
        <div class="card-body p-5">
            <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                                class="mb-0 fs-exact-18"><?= Yii::t('app', 'Keywords') ?> EN</h2></span>
            </div>
            <div class="row g-4">
                <?= $form->field($translateEn, 'keywords')->textInput([
                    'maxlength' => true,
                    'id' => 'keywords_id_en',
                    'name' => 'ProductsTranslate[en][keywords]',
                ])->label('Keywords') ?>
            </div>
        </div>
    </div>
<?php endif; ?>