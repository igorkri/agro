<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Posts $model */
/** @var yii\widgets\ActiveForm $form */
?>

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
