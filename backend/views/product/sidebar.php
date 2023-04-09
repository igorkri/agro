<?php


use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\shop\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="sa-entity-layout__sidebar">

    <div class="card">
        <div class="card-body p-5">
            <div class="mb-5">
                <h2 class="mb-0 fs-exact-18"><?=Yii::t('app', 'Status')?></h2>
            </div>
            <div class="mb-4">

                <?= $form->field($model, 'status_id')
                    ->radioList(
                        ArrayHelper::map(\common\models\shop\Status::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
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
                <h2 class="mb-0 fs-exact-18"><?=Yii::t('app', 'Currency')?></h2>
            </div>
            <div class="mb-4">

                <?= $form->field($model, 'currency')
                    ->radioList(
                        [
                                'UAH' => 'Гривня',
                                'USD' => 'Долар',
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
                <h2 class="mb-0 fs-exact-18"><?=Yii::t('app', 'Category')?></h2>
            </div>
            <?php
            Pjax::begin(['id' => "category"]);
            $data = ArrayHelper::map(\common\models\shop\Category::find()
//                ->where(['NOT', ['parentId' => null]])
                ->orderBy('name')->asArray()->all(), 'id', 'name');
            echo $form->field($model, 'category_id')->widget(Select2::classname(), [
                'data' => $data,
                'theme' => Select2::THEME_DEFAULT,
                'maintainOrder' => true,
                'pluginLoading' => false,
                'options' => [
                     'placeholder' => 'Виберіть категорію ...',
                    'class' => 'sa-select2 form-select',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'width' => '273px',
                ],
            ])->label(false);
            Pjax::end();
            ?>

        </div>
    </div>
    <div class="card w-100 mt-5">
        <div class="card-body p-5">
            <div class="mb-5">
                <h2 class="mb-0 fs-exact-18"><?=Yii::t('app', 'Label')?></h2>
            </div>
            <?php
            $data = ArrayHelper::map(\common\models\shop\Label::find()
                ->orderBy('name')->asArray()->all(), 'id', 'name');
            echo $form->field($model, 'label_id')->widget(Select2::classname(), [
                'data' => $data,
                'theme' => Select2::THEME_DEFAULT,
                'pluginLoading' => false,
//                'toggleAllSettings' => [
//                    'selectLabel' => '<i class="fas fa-check-circle"></i> Выбрать все',
//                    'unselectLabel' => '<i class="fas fa-times-circle"></i> Удалить все',
//                    'selectOptions' => ['class' => 'text-success'],
//                    'unselectOptions' => ['class' => 'text-danger'],
//                ],
                'options' => [
                    'placeholder' => 'Виберіть мітку ...',
                    'class' => 'sa-select2 form-select',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'width' => '273px',
                ],
            ])->label(false);?>

        </div>
    </div>
    <div class="card w-100 mt-5">
        <div class="card-body p-5">
            <div class="mb-5">
                <h2 class="mb-0 fs-exact-18"><?=Yii::t('app', 'Tag')?></h2>
            </div>
            <?php
            $data = ArrayHelper::map(\common\models\shop\Tag::find()->orderBy('id')->asArray()->all(), 'id', 'name');
            echo $form->field($model, 'tags')->widget(Select2::classname(), [
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
                     'placeholder' => 'Виберіть тег ...',
                    'class' => 'sa-select2 form-select',
                    // 'data-tags'=>'true',
                    'multiple' => true
                ],
                'pluginOptions' => [
                    'closeOnSelect' => false,
                    'tags' => true,
                    'tokenSeparators' => [', ', ' '],
                    'maximumInputLength' => 10,
                    'width' => '273px',
                ],
            ])->label(false);
            ?>
        </div>
    </div>
    <div class="card w-100 mt-5">
        <div class="card-body p-5">
            <div class="mb-5">
                <h2 class="mb-0 fs-exact-18"><?=Yii::t('app', 'Brand')?></h2>
            </div>
            <?php
            $data = ArrayHelper::map(\common\models\shop\Brand::find()->orderBy('id')->asArray()->all(), 'id', 'name');
            echo $form->field($model, 'brand_id')->widget(Select2::classname(), [
                'data' => $data,
                'theme' => Select2::THEME_DEFAULT,
                'pluginLoading' => false,
                'options' => [
                    'placeholder' => 'Виберіть Бренд ...',
                    'class' => 'sa-select2 form-select',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'width' => '273px',
                ],
            ])->label(false);
            ?>
        </div>
    </div>
</div>
