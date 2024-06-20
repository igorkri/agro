<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/** @var yii\web\View $this */
/** @var backend\models\search\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;

$seoErrors = Yii::$app->session->get('errorsSeo');
?>
    <div id="top" class="sa-app__body">
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <nav class="mb-2" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-sa-simple">
                                <?php echo Breadcrumbs::widget([
                                    'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                                    'homeLink' => [
                                        'label' => Yii::t('app', 'Home'),
                                        'url' => Yii::$app->homeUrl,
                                    ],
                                    'links' => $this->params['breadcrumbs'] ?? [],
                                ]);
                                ?>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-auto d-flex">
                        <label class="d-flex align-items-center pt-2">
                            <input
                                    type="checkbox"
                                    class="form-check-input m-0 me-3 fs-exact-16"
                                    name="errorsSeo"
                                    value="yes"
                                <?= Yii::$app->session->get('errorsSeo') === 'yes' ? 'checked' : '' ?>
                                    onchange="updateErrorCheckbox(this)"
                            />
                            Показувати помилки
                        </label>
                    </div>
                    <div class="col-auto d-flex"><a href="<?= Url::to(['product/export-to-excel']) ?>"
                                                    class="btn btn-outline-success"><i
                                    class="fas fa-file-export"> </i><?= Yii::t('app', ' Excel') ?></a>
                    </div>
                    <div class="col-auto d-flex"><a href="<?= Url::to(['product/upload']) ?>"
                                                    id="excelFileInput"
                                                    class="btn btn-outline-success"><i class="fas fa-file-import"
                                                                                       style="color: red"> </i><?= Yii::t('app', ' Excel') ?>
                        </a>
                    </div>
                    <div class="col-auto d-flex"><a href="<?= Url::to(['create']) ?>"
                                                    class="btn btn-primary"><?= Yii::t('app', 'New +') ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
            <div class="sa-layout">
                <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div>
                <?php echo $this->render('_search', ['model' => $dataProvider->models]); ?>
                <div class="sa-layout__content">
                    <div class="card">
                        <div class="p-4">
                            <div class="row g-4">
                                <div class="col-auto sa-layout__filters-button">
                                    <button class="btn btn-sa-muted btn-sa-icon fs-exact-16"
                                            data-sa-layout-sidebar-open="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                             viewBox="0 0 16 16"
                                             fill="currentColor">
                                            <path
                                                    d="M7,14v-2h9v2H7z M14,7h2v2h-2V7z M12.5,6C12.8,6,13,6.2,13,6.5v3c0,0.3-0.2,0.5-0.5,0.5h-2 C10.2,10,10,9.8,10,9.5v-3C10,6.2,10.2,6,10.5,6H12.5z M7,2h9v2H7V2z M5.5,5h-2C3.2,5,3,4.8,3,4.5v-3C3,1.2,3.2,1,3.5,1h2 C5.8,1,6,1.2,6,1.5v3C6,4.8,5.8,5,5.5,5z M0,2h2v2H0V2z M9,9H0V7h9V9z M2,14H0v-2h2V14z M3.5,11h2C5.8,11,6,11.2,6,11.5v3 C6,14.8,5.8,15,5.5,15h-2C3.2,15,3,14.8,3,14.5v-3C3,11.2,3.2,11,3.5,11z"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                                <div>
                                    <label for="table-search"></label>
                                    <input
                                            type="text"
                                            placeholder="<?= Yii::t('app', 'Start typing to search for products') ?>"
                                            class="form-control form-control--search mx-auto"
                                            id="table-search"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="sa-divider"></div>
                        <table class="sa-datatables-init" data-order='[[ 1, "asc" ]]'
                               data-sa-search-input="#table-search">
                            <thead>
                            <tr>
                                <th class="min-w-20x"><?= Yii::t('app', 'Product') ?></th>
                                <th><?= Yii::t('app', 'Category') ?></th>
                                <th><?= Yii::t('app', 'Status') ?></th>
                                <th><?= Yii::t('app', 'Price') ?></th>
                                <th class="w-min" data-orderable="false"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($dataProvider->models as $model): ?>
                                <?php
                                $color = 'secondary';
                                if ($model->status_id == 1) {
                                    $color = 'success';
                                } elseif ($model->status_id == 2) {
                                    $color = 'danger';
                                } elseif ($model->status_id == 3) {
                                    $color = 'warning';
                                } elseif ($model->status_id == 4) {
                                    $color = 'info';
                                }
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="<?= Url::to(['product/update', 'id' => $model->id]) ?>"
                                               class="me-4">
                                                <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">

                                                    <?php $images = $model->images;
                                                    $priorities = array_column($images, 'priority');
                                                    array_multisort($priorities, SORT_ASC, $images);
                                                    ?>

                                                    <?php if (isset($images[0])): ?>
                                                        <img src="<?= Yii::$app->request->hostInfo . '/product/' . $images[0]->extra_small ?>"
                                                             width="40" height="40" alt=""/>
                                                    <?php else: ?>
                                                        <img src="<?= Yii::$app->request->hostInfo . '/images/no-image.png' ?>"
                                                             width="40" height="40" alt=""/>
                                                    <?php endif; ?>
                                                </div>
                                            </a>
                                            <div>
                                                <a href="<?= Url::to(['product/update', 'id' => $model->id]) ?>"
                                                   class="text-reset"><?= $model->name ?>
                                                    <?php if ($seoErrors === 'yes'): ?>
                                                        <?= $model->getNonParametr($model->id) ?>
                                                        <?= $model->getNonDescription($model->id) ?>
                                                        <?= $model->getNonShortDescr($model->id) ?>
                                                        <?= $model->getNonBrand($model->id) ?>
                                                        <?= $model->getNonSeoTitle($model->id) ?>
                                                        <?= $model->getNonSeoDescr($model->id) ?>
                                                        <?= $model->getNonH3Descr($model->id) ?>
                                                    <?php endif; ?>
                                                </a>
                                                <div class="sa-meta mt-0">
                                                    <ul class="sa-meta__list">

                                                        <li class="sa-meta__item">
                                                            ID:
                                                            <span class="st-copy"><?= $model->id ?></span>
                                                        </li>
                                                        <?php $analogProducts = $model->getProductsAnalog($model->id);
                                                        if (!empty($analogProducts)) { ?>
                                                            <li class="sa-meta__item">
                                                                АНАЛОГ:
                                                                <span class="st-copy">
                                                        <?php
                                                        echo ' <span class="badge badge-sa-theme-analog">' . $analogProducts . '</span>';
                                                        ?>
                                                    </span>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if ($model->grups) { ?>
                                                            <li class="sa-meta__item">
                                                                ГРУП:
                                                                <span class="st-copy">
                                                        <?php
                                                        foreach ($model->grups as $grup) {
                                                            echo ' <span class="badge badge-sa-secondary-grup">' . $grup->name . '</span>';
                                                        }
                                                        ?>
                                                    </span>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if (isset($model->label)) { ?>
                                                            <li class="sa-meta__item">
                                                                МІТКА:
                                                                <span class="st-copy"><span
                                                                            class="badge badge-sa-primary-label"><?= $model->label->name ?></span></span>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if ($model->tags) { ?>
                                                            <li class="sa-meta__item">
                                                                ТЕГИ:
                                                                <span class="st-copy">
                                                        <?php
                                                        foreach ($model->tags as $tag) {
                                                            echo ' <span class="badge badge-sa-secondary">' . $tag->name . '</span>';
                                                        }
                                                        ?>
                                                    </span>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="<?= Url::to(['product/update', 'id' => $model->category->id]) ?>"
                                           class="text-reset"><?= $model->category->name ?></a></td>
                                    <td>
                                        <div class="badge badge-sa-<?= $color ?>"><?= $model->status->name ?></div>
                                    </td>
                                    <td style="width: 10%">
                                        <div class="sa-price">
                                            <span class="sa-price__symbol">&#8372;</span>
                                            <span class="sa-price__integer"><?= $model->getPrice() ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button
                                                    class="btn btn-sa-muted btn-sm"
                                                    type="button"
                                                    id="product-context-menu-0"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false"
                                                    aria-label="More"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="3" height="13"
                                                     fill="currentColor">
                                                    <path
                                                            d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z"
                                                    ></path>
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="product-context-menu-0">
                                                <!--                                        <li><a class="dropdown-item" href="#">Edit</a></li>-->
                                                <!--                                        <li><a class="dropdown-item" href="#">Duplicate</a></li>-->
                                                <!--                                        <li><a class="dropdown-item" href="#">Add tag</a></li>-->
                                                <!--                                        <li><hr class="dropdown-divider" /></li>-->
                                                <li>
                                                    <?= Html::a(Yii::t('app', 'Delete'), ['product/delete', 'id' => $model->id], [
                                                        'class' => 'dropdown-item text-danger',
                                                        'data' => [
                                                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                                            'method' => 'post',
                                                        ],
                                                    ]) ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$script = <<< JS

 document.getElementById('excelFileInput').addEventListener('change', function () {
// Получите выбранный файл
        const selectedFile = this.files[0];

// Создайте объект FormData для отправки файла
        const formData = new FormData();
        formData.append('excelFile', selectedFile); // 'excelFile' - это имя поля на сервере

// Отправьте файл на сервер с использованием Fetch API
        fetch('/upload-url', {
            method: 'POST',
            body: formData,
        })
            .then(response => {
                if (response.ok) {
                    return response.text(); // Если загрузка прошла успешно, вы можете обработать ответ сервера
                }
                throw new Error('Ошибка при загрузке файла на сервер');
            })
            .then(responseText => {
// Обработайте успешный ответ от сервера здесь
                console.log('Серверный ответ:', responseText);
            })
            .catch(error => {
// Обработайте ошибку загрузки
                console.error('Ошибка загрузки:', error);
            });
    });

    document.querySelector('.btn.btn-primary').addEventListener('click', function () {
// Симулируйте щелчок по скрытому полю для выбора файла
        document.getElementById('excelFileInput').click();
    });
    
    function updateErrorCheckbox(checkbox) {
    var isChecked = checkbox.checked ? 'yes' : 'no';
    
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'product/update-error-checkbox', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-CSRF-Token', csrfToken);
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    window.location.reload();
                } else {
                    console.error('Failed to update checkbox state');
                }
            } else {
                console.error('Failed to send request');
            }
        }
    };
    
    xhr.send('errorsSeo=' + isChecked);
}

JS;

$this->registerJs($script, View::POS_END);
?>