<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\About $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Abouts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<!-- sa-app__body -->
<div id="top" class="sa-app__body">
    <div class="py-5 py-md-6 my-2 px-5">
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
                    <?php if(!$model->isNewRecord): ?>
                        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'style' => 'margin-left: 15px',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                        <!--                            <a href="#" class="btn btn-secondary me-3">--><?php ////Yii::t('app', 'Duplicate')?><!--</a>-->
                        <?php // Html::a(Yii::t('app', 'List'), Url::to(['index']), ['class' => 'btn btn-secondary me-3']) ?>
                        <?php // Html::a(Yii::t('app', 'Create more'), Url::to(['create']), ['class' => 'btn btn-success me-3']) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="sa-hero-header">
            <div class="sa-hero-header__title"><h1><?= Html::encode($this->title) ?></h1></div>
<!--            <div class="sa-hero-header__subtitle">This Agreement was last modified on 26 June 2021</div>-->
        </div>
    </div>
    <div class="container container--max--lg pb-6">
        <div class="card">
            <div class="card-body m-0 m-md-4 p-5">
                <?= $model->description ?>
            </div>
        </div>
    </div>
</div>
<!-- sa-app__body / end -->
