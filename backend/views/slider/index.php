<?php

use common\models\Slider;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\SliderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Sliders');
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
                        <!--                        <h1 class="h3 m-0">--><?php //=$this->title?><!--</h1>-->
                    </div>
                    <div class="col-auto d-flex"><a href="<?=Url::to(['create'])?>" class="btn btn-primary"><?=Yii::t('app', 'Create Slider')?></a></div>
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
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

//                        'id',
                        'title',
                        'description:ntext',
//                        'image',
//                        'image_mob',
                        'visible',
                        //'sort',
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, Slider $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>