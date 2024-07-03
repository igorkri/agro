<?php

use common\models\shop\ProductProperties;
use yii\helpers\Html;

?>
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
                <div style="color: #898787 ">
                    <span>' ' - не заповнене поле не показуеться на сайті</span><br>
                    <span>'*' - поле в товарі не використовуеться</span>
                </div>
            </div>
            <div class="mt-3">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
<?php endif; ?>