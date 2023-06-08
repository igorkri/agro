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
                                    <h2 class="mb-0 fs-exact-18">Основна інформація</h2>
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
                                    <h2 class="mb-0 fs-exact-18"><?= Yii::t('app', 'Properties') ?></h2>
                                </div>
                                <?php $data = ProductProperties::find()->where(['product_id' => $model->id])->all(); ?>
                                <div id="properties-container">
                                    <?php foreach ($data as $index => $productProperty): ?>
                                        <div class="row g-4">
                                            <div class="col-5">
                                                <?= $form->field($productProperty, "[$index]properties")->textInput() ?>
                                            </div>
                                            <div class="col-5">
                                                <?= $form->field($productProperty, "[$index]value")->textInput() ?>
                                            </div>
                                            <div class="col-2">
                                                <button type="button"
                                                        class="btn btn-outline-danger remove-property-btn" style="
                                                        margin: 25px 0px;">Видалити
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="mt-3">
                                    <button type="button" id="add-property-btn" class="btn btn-outline-warning">+Додати</button>
                                </div>
                            </div>
                        </div>
                        <!-------------End Product properties  ----------------->

                        <div class="card mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <h2 class="mb-0 fs-exact-18"><?= Yii::t('app', 'Prices') ?></h2>
                                </div>
                                <div class="row g-4">
                                    <div class="col">
                                        <?= $form->field($model, 'price')->textInput([
                                            'class' => "form-control"
                                        ]) ?>
                                    </div>
                                    <div class="col">
                                        <?= $form->field($model, 'old_price')->textInput([
                                            'class' => "form-control"
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <h2 class="mb-0 fs-exact-18"><?= Yii::t('app', 'Image 700x700') ?></h2>
                                </div>
                            </div>
                            <div class="mt-n5">
                                <div class="sa-divider"></div>
                                <div class="table-responsive">
                                    <table class="sa-table">
                                        <thead>
                                        <tr>
                                            <th class="w-min"><?= Yii::t('app', 'Image') ?></th>
                                            <th class="min-w-10x"><?= Yii::t('app', 'Alt image') ?></th>
                                            <th class="w-min"><?= Yii::t('app', 'Priority') ?></th>
                                            <th class="w-min"></th>
                                        </tr>
                                        </thead>
                                        <?php Pjax::begin(['id' => 'images']); ?>
                                        <tbody id="images-table">
                                        <?php if (!empty($model->images)) : ?>
                                            <?php foreach ($model->images as $image) : ?>
                                                <tr>
                                                    <td>
                                                        <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--xxl">
                                                            <a href="image-view?id=<?= $image->id ?>"
                                                               role='modal-remote' , data-toggle='tooltip'>
                                                                <img src="<?= Yii::$app->request->hostInfo . '/product/' . $image->name ?>"
                                                                     width="40" height="40" alt=""/>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="alt[<?= $image->id ?>]"
                                                               class="form-control form-control-sm"
                                                               value="<?= $image->alt ? $image->alt : $model->name ?>"/>
                                                    </td>
                                                    <td><input type="number" name="priority[<?= $image->id ?>]"
                                                               class="form-control form-control-sm w-4x"
                                                               value="<?= $image->priority ? $image->priority : 0 ?>"/>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sa-muted btn-sm mx-n3"
                                                                onclick="removeImageStock(<?= $image->id ?>, '<?= $_SESSION['_language'] ?>')"
                                                                type="button" aria-label="Видалити зображення"
                                                                data-bs-toggle="tooltip" data-bs-placement="right"
                                                                title="Видалити зображення">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                                 height="12" viewBox="0 0 12 12" fill="currentColor">
                                                                <path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6 c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4 C11.2,9.8,11.2,10.4,10.8,10.8z"></path>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tbody>
                                        <?php Pjax::end() ?>
                                    </table>
                                </div>
                                <div class="sa-divider"></div>
                                <div class="px-5 py-4 my-2">
                                    <?php if (!$model->isNewRecord): ?>
                                        <?= Html::a(
                                            Yii::t('app', 'Download images'),
                                            Url::to(['create-image', 'id' => $model->id, 'language' => 'uk']),
                                            ['role' => 'modal-remote', 'data-toggle' => 'tooltip']
                                        ); ?>
                                    <?php else: ?>
                                        <?= Html::tag('span', 'Завантаження зображення буде доступно після створення товару!',
                                            ['class' => 'text-danger']
                                        ); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-body p-5">
                                <div class="mb-5">
                                    <h2 class="mb-0 fs-exact-18"><?= Yii::t('app', 'Seo') ?></h2>
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
            propertiesField.className = "col-5";
            propertiesField.innerHTML = '<input type="text" name="ProductProperties[' + index + '][properties]" class="form-control" />';

            // Создание поля "value"
            var valueField = document.createElement("div");
            valueField.className = "col-5";
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


