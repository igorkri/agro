<?php

use common\models\shop\Review;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\ReviewSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Reviews');
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
                                ]); ?>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-auto d-flex"><a href="<?=Url::to(['create'])?>" class="btn btn-primary"><?=Yii::t('app', 'Create Review')?></a></div>
                </div>
            </div>
            <div class="card">
                <div class="sa-divider"></div>
                <div class="container">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            [
                                'attribute' => 'product_id',
//                                'filter' => false,
                                'value' => function($model){
                                    return $model->getProductName($model->product_id);
                                },
                            ],
                            [
                                'attribute' => 'created_at',
                                'filter' => false,
                                'value' => function($model){
                                    return Yii::$app->formatter->asDate($model->created_at, 'short');
                                },
//                                    'width' => '5%',
//                                    'vAlign' => GridView::ALIGN_MIDDLE,
//                                    'hAlign' => GridView::ALIGN_CENTER,

                            ],
                            'rating',
                            'name',
                            'email:email',
                            'message:raw',
                            [
                                'class' => ActionColumn::className(),
                                'urlCreator' => function ($action, Review $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>