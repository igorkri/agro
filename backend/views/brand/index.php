<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\search\BrandSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Brands';
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
                        <!--                        <h1 class="h3 m-0">--><?php //=$this->title?><!--</h1>-->
                    </div>
                    <div class="col-auto d-flex"><a href="<?=Url::to(['create'])?>" class="btn btn-primary"><?=Yii::t('app', 'New brand')?></a></div>
                </div>
            </div>
            <div class="card">
                <div class="p-4">
                    <input
                            type="text"
                            placeholder="<?=Yii::t('app', 'Start typing to search for categories')?>"
                            class="form-control form-control--search mx-auto"
                            id="table-search"
                    />
                </div>
                <div class="sa-divider"></div>
                <table class="sa-datatables-init" data-order='[[ 1, "asc" ]]' data-sa-search-input="#table-search">
                    <thead>
                    <tr>
                        <!--                        <th class="w-min" data-orderable="false">-->
                        <!--                            <input type="checkbox" class="form-check-input m-0 fs-exact-16 d-block" aria-label="..." />-->
                        <!--                        </th>-->
                        <th><?=Yii::t('app', 'Image')?></th>
                        <th class="min-w-15x"><?=Yii::t('app', 'name')?></th>
                        <th class="min-w-15x"><?=Yii::t('app', 'Count')?></th>
                        <th class="w-min" data-orderable="false"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; foreach ($dataProvider->models as $model): ?>
                        <tr>
                            <!--                        <td><input type="checkbox" class="form-check-input m-0 fs-exact-16 d-block" aria-label="..." /></td>-->
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="me-4">
                                        <div class="sa-brand sa-symbol--shape--rounded sa-symbol--size--lg">
                                            <img src="<?=Yii::$app->request->hostInfo . '/brand/' . $model->file?>" alt=""/>
                                        </div>
                                    </a>
                                </div>
                            </td>

                            <td>
                                <a href="<?=Url::to(['brand/update', 'id' => $model->id])?>" class="text-reset"><?=$model->name?></a>
                            </td>
                            <td>
                                <?= $model->getProductBrand($model->id) ?>
                            </td>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="3" height="13" fill="currentColor">
                                            <path
                                                    d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z"
                                            ></path>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="category-context-menu-0">
                                        <li><a class="dropdown-item" href="<?=Url::to(['brand/update', 'id' => $model->id])?>"><?=Yii::t('app', 'Edit')?></a></li>
                                        <li><hr class="dropdown-divider" /></li>
                                        <li>
                                            <?= Html::a(Yii::t('app', 'Delete'), ['brand/delete', 'id' => $model->id], ['class'=>"dropdown-item text-danger",
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                    'method' => 'post'
                                                ]
                                            ]) ?>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>