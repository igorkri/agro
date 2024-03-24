<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\search\LabelSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Activity products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="top" class="sa-app__body">
    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
        <div class="container">
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
                </div>
            </div>
            <div class="card">
                <div class="p-4">
                    <input
                            type="text"
                            placeholder="<?= Yii::t('app', 'Start typing to search for labels') ?>"
                            class="form-control form-control--search mx-auto"
                            id="table-search"
                    />
                </div>
                <div class="sa-divider"></div>
                <table class="sa-datatables-init" data-order='[[ 1, "asc" ]]' data-sa-search-input="#table-search">
                    <thead>
                    <tr>
                        <th><?= Yii::t('app', 'Image') ?></th>
                        <th class="min-w-10x"><?= Yii::t('app', 'Name') ?></th>
                        <th class="min-w-10x"><?= Yii::t('app', 'Data last view') ?></th>
                        <th class="min-w-5x"><?= Yii::t('app', 'Count view') ?></th>
                        <th class="min-w-10x"><?= Yii::t('app', 'Slug') ?></th>
                        <th class="min-w-5x"><?= Yii::t('app', 'Status') ?></th>
                        <th class="w-min" data-orderable="false"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $value): ?>
                        <?php
                        $color = 'secondary';
                        if ($value['status_id'] == 1) {
                            $color = 'success';
                        } elseif ($value['status_id'] == 2) {
                            $color = 'danger';
                        } elseif ($value['status_id'] == 3) {
                            $color = 'warning';
                        } elseif ($value['status_id'] == 4) {
                            $color = 'info';
                        }
                        ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">

                                        <img src="/product/<?= $value['image'] ?>"
                                             width="40"
                                             height="40" alt=""/>
                                    </div>
                                </div>
                            </td>
                            <td><?= $value['name'] ?></td>
                            <td><?= Yii::$app->formatter->asDatetime(($value['date']), 'medium') ?></td>
                            <td>
                                <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-user"
                                      style="font-size: 15px"
                                ><?= $value['count'] ?></span>
                            </td>
                            <td><?= $value['slug'] ?></td>
                            <td><div class="badge badge-sa-<?= $color ?>"><?= $value['status_name'] ?></div></td>
                            <td>
                                <div class="dropdown">
                                    <button
                                            class="btn btn-sa-muted btn-sm"
                                            type="button"
                                            id="category-context-menu-0"
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
                                        aria-labelledby="category-context-menu-0">
                                        <li><a class="dropdown-item" href="/product/<?= $value['slug'] ?>"
                                               target="_blank">Переглянути на сайті</a></li>
                                        <li>
                                            <hr class="dropdown-divider"/>
                                        </li>
                                        <li><a class="dropdown-item"
                                               href="<?= Url::to(['product/update', 'id' => $value['id']]) ?>"
                                               target="_blank">Редагувати</a></li>
                                        <li>
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
