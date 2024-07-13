<?php

use yii\helpers\Html;

?>
<?php if (!$model->isNewRecord): ?>
    <div class="card mt-5">
        <div class="card-body p-5">
            <div class="mb-5">
                <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart">
                    <h2 class="mb-0 fs-exact-18"><?= Yii::t('app', 'Properties') ?></h2>
                </span>
            </div>
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button
                                    class="nav-link active"
                                    id="uk-properties-tab-2"
                                    data-bs-toggle="tab"
                                    data-bs-target="#uk-properties-tab-content-2"
                                    type="button"
                                    role="tab"
                                    aria-controls="uk-properties-tab-content-2"
                                    aria-selected="true"
                            >
                                UK<span class="nav-link-sa-indicator"></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button
                                    class="nav-link"
                                    id="ru-properties-tab-2"
                                    data-bs-toggle="tab"
                                    data-bs-target="#ru-properties-tab-content-2"
                                    type="button"
                                    role="tab"
                                    aria-controls="ru-properties-tab-content-2"
                                    aria-selected="true"
                            >
                                RU<span class="nav-link-sa-indicator"></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button
                                    class="nav-link"
                                    id="en-properties-tab-2"
                                    data-bs-toggle="tab"
                                    data-bs-target="#en-properties-tab-content-2"
                                    type="button"
                                    role="tab"
                                    aria-controls="en-properties-tab-content-2"
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
                                id="uk-properties-tab-content-2"
                                role="tabpanel"
                                aria-labelledby="uk-properties-tab-2"
                        >
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
                        <div
                                class="tab-pane fade"
                                id="ru-properties-tab-content-2"
                                role="tabpanel"
                                aria-labelledby="ru-properties-tab-2"
                        >
                            <div id="properties-container">
                                <?php $index = 0;
                                $uniqueArray = array_values($dataRu);
                                ?>
                                <?php foreach ($uniqueArray as $productProperty): ?>
                                    <div class="row g-4">
                                        <div class="col-3">
                                            <?= $form->field($productProperty, "[$index]properties")->textInput(['readonly' => true, 'name' => "PropertiesTranslate[ru][$index][properties]"])->label(false) ?>
                                        </div>
                                        <div class="col-9">
                                            <?= $form->field($productProperty, "[$index]value")->textInput(['name' => "PropertiesTranslate[ru][$index][value]"])->label(false) ?>
                                        </div>
                                    </div>
                                    <?= $form->field($productProperty, "[$index]id")->hiddenInput([
                                        'value' => $data[$index]['id'],
                                        'name' => "PropertiesTranslate[ru][$index][id]"
                                    ])->label(false) ?>
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
                        <div
                                class="tab-pane fade"
                                id="en-properties-tab-content-2"
                                role="tabpanel"
                                aria-labelledby="en-properties-tab-2"
                        >
                            <div id="properties-container">
                                <?php $index = 0;
                                $uniqueArray = array_values($dataEn);
                                ?>
                                <?php foreach ($uniqueArray as $productProperty): ?>
                                    <div class="row g-4">
                                        <div class="col-3">
                                            <?= $form->field($productProperty, "[$index]properties")->textInput(['readonly' => true, 'name' => "PropertiesTranslate[en][$index][properties]"])->label(false) ?>
                                        </div>
                                        <div class="col-9">
                                            <?= $form->field($productProperty, "[$index]value")->textInput(['name' => "PropertiesTranslate[en][$index][value]"])->label(false) ?>
                                        </div>
                                    </div>
                                    <?= $form->field($productProperty, "[$index]id")->hiddenInput([
                                        'value' => $data[$index]['id'],
                                        'name' => "PropertiesTranslate[en][$index][id]"
                                    ])->label(false) ?>
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
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>