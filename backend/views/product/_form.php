<?php

use common\models\shop\ProductProperties;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use vova07\imperavi\Widget;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\shop\Product $model */
/** @var ActiveForm $form */
?>

<?php
$form = ActiveForm::begin(['options' => ['autocomplete' => "off"]]); ?>
<div id="top" class="sa-app__body">
    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
        <div class="container">
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
                        <div class="card">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2 class="mb-0 fs-exact-18">Основна інформація</h2></span>
                                </div>
                                <div class="mb-4">
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                                </div>
                                <div class="mb-4">
                                    <!-- sa-quill-control  -->
                                    <?= $form->field($model, 'short_description')->widget(Widget::class, [
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
                                <div class="mb-4">
                                    <!-- sa-quill-control  -->
                                    <?= $form->field($model, 'description')->widget(Widget::class, [
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
                        </div>

                        <!--------------  Product_properties  ------------------>
                        <div class="card mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2 class="mb-0 fs-exact-18"><?= Yii::t('app', 'Properties') ?></h2></span>
                                </div>
                                <?php $data = ProductProperties::find()->where(['product_id' => $model->id])->all(); ?>
                                <div id="properties-container">
                                    <?php foreach ($data as $index => $productProperty): ?>
                                        <div class="row g-4">
                                            <div class="col-3">
                                                <?= $form->field($productProperty, "[$index]properties")->textInput() ?>
                                            </div>
                                            <div class="col-8">
                                                <?= $form->field($productProperty, "[$index]value")->textInput() ?>
                                            </div>
                                            <div class="col-1">
                                                <button type="button"
                                                        class="btn btn-outline-danger remove-property-btn" style="
                                                        margin: 25px 0px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="mt-3">
                                    <button type="button" id="add-property-btn" class="btn btn-outline-warning me-3">+Додати</button>
                                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                                </div>
                            </div>
                        </div>
                        <!-------------End Product properties  ----------------->
                        <div class="card mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2 class="mb-0 fs-exact-18"><?= Yii::t('app', 'Seo') ?></h2></span>
                                </div>
                                <div class="row g-4">
                                    <?= $form->field($model, 'seo_title')->textInput() ?>
                                    <?= $form->field($model, 'seo_description')->textarea(['rows' => '4', 'class' => "form-control"]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                    render this side-->
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

    <script>
        var index = <?= count($data) ?>; // Определение индекса для новых свойств

        // Обработчик нажатия кнопки "Добавить свойство"
        document.getElementById("add-property-btn").addEventListener("click", function () {
            var container = document.getElementById("properties-container");

            // Создание нового блока для свойств
            var row = document.createElement("div");
            row.className = "row g-4";

            // Создание поля "properties"
            var propertiesField = document.createElement("div");
            propertiesField.className = "col-3";
            propertiesField.innerHTML = '<input type="text" name="ProductProperties[' + index + '][properties]" class="form-control" />';

            // Создание поля "value"
            var valueField = document.createElement("div");
            valueField.className = "col-7";
            valueField.innerHTML = '<input type="text" name="ProductProperties[' + index + '][value]" class="form-control" />';

            // Создание кнопки "Удалить"
            var removeBtn = document.createElement("div");
            removeBtn.className = "col-2";
            removeBtn.innerHTML = '<button type="button" class="btn btn-outline-danger remove-property-btn">Видалити</button>';

            // Добавление полей и кнопки в новый блок
            row.appendChild(propertiesField);
            row.appendChild(valueField);
            row.appendChild(removeBtn);

            // Добавление нового блока в контейнер
            container.appendChild(row);

            // Увеличение индекса для следующего свойства
            index++;

            // Активация кнопки "Удалить" для уже добавленных свойств
            var removeBtns = container.getElementsByClassName("remove-property-btn");
            for (var i = 0; i < removeBtns.length; i++) {
                removeBtns[i].disabled = false;
            }
        });

        // Обработчик нажатия кнопки "Удалить"
        document.addEventListener("click", function (event) {
            if (event.target.classList.contains("remove-property-btn")) {
                var row = event.target.parentNode.parentNode;
                row.parentNode.removeChild(row);
            }
        });
    </script>


