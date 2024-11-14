<?php

use common\models\IpBot;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var backend\models\search\IpBot $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Ip Bots');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="top" class="sa-app__body">
    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
        <div class="container" style="max-width: 1623px">
            <div class="card">
                <?php echo Html::beginForm(['check-delete'], 'post'); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'responsiveWrap' => false,
                    'summary' => Yii::$app->devicedetect->isMobile() ? false : "Показано <span class='summary-info'>{begin}</span> - <span class='summary-info'>{end}</span> из <span class='summary-info'>{totalCount}</span> Записей",
                    'panel' => [
                        'type' => 'warning',
                        'heading' => '<h3 class="panel-title"><i class="fas fa-globe"></i> ' . $this->title . '</h3>',
                        'headingOptions' => ['style' => 'height: 60px; margin-top: 10px'],
                        'before' => false,
                        'after' =>
                            Html::a('<i class="fas fa-redo"></i> Обновити', ['index'], ['class' => 'btn btn-info']),
                    ],
                    'pager' => [
                        'class' => LinkPager::class,
                        'options' => ['class' => 'pagination justify-content-center'],
                        'maxButtonCount' => Yii::$app->devicedetect->isMobile() ? 3 : 10,
                        'firstPageLabel' => '<<',
                        'lastPageLabel' => '>>',
                        'prevPageLabel' => '<',
                        'nextPageLabel' => '>',
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'ip',
                            'label' => 'IP Адрес',
                            'format' => 'raw',
                            'contentOptions' => ['style' => 'width: 150px; text-align: center;']
                        ],
                        [
                            'attribute' => 'isp',
                            'label' => 'Провайдер',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'comment',
                            'label' => 'Коментарий',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'blocking',
                            'label' => 'Заблокирован',
                            'format' => 'boolean',
                            'filter' => true,
                            'contentOptions' => ['style' => 'width: 100px; text-align: center;']
                        ],

                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, IpBot $model) {
                                return Url::toRoute([$action, 'id' => $model->id, 'selection' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
                <?php echo Html::endForm(); ?>
            </div>
        </div>
    </div>
</div>
