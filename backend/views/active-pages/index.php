<?php

use common\models\shop\ActivePages;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\ipinfo\IpInfo;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\bootstrap5\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\search\ActivePagesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Active Pages');
$ipAddress = Yii::$app->request->getUserIP();

?>
<div id="top" class="sa-app__body">
    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
        <div class="container" style="max-width: 1623px">
            <div class="card">
                <?php echo Html::beginForm(['check-delete']); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'responsiveWrap' => false,
                    'summary' => Yii::$app->devicedetect->isMobile() ? false : "Показано <span class='summary-info'>{begin}</span> - <span class='summary-info'>{end}</span> из <span class='summary-info'>{totalCount}</span> Записей",
                    'panel' => [
                        'type' => 'warning',
                        'heading' => '<h3 class="panel-title"><i class="fas fa-globe"></i> ' . $this->title . ' ' . $ipAddress . '</h3>',
                        'headingOptions' => ['style' => 'height: 60px; margin-top: 10px'],
                        'before' => false,
                        'after' =>
                            Html::submitButton('<i class="fas fa-trash-alt"></i> Вибрані', ['class' => 'btn btn-danger', 'style' => 'margin-right: 5px']) .
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
                        [
                            'class' => 'yii\grid\CheckboxColumn',
                            'checkboxOptions' => function ($model) {
                                return ['name' => 'selection', 'value' => $model->id];
                            },
                        ],
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'ip_user',
                            'format' => 'raw',
                            'visible' => true,
                            'value' => function ($model) {

                                return IpInfo::widget([
                                    'ip' => $model->ip_user,
                                    'showPopover' => false,
                                    'template' => ['inlineContent' => '{flag} {city} {ip}'],
                                ]);
                            },
                            'contentOptions' => ['style' => 'width: 150px'],
                        ],
                        [
                            'attribute' => 'date_visit',
                            'filter' => false,
                            'value' => function ($model) {
                                return Yii::$app->formatter->asDatetime($model->date_visit, 'medium');
                            },
                            'contentOptions' => ['style' => 'width: 200px'],
                        ],
                        [
                            'attribute' => 'url_page',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->getClearUrl($model->url_page);
                            },
                        ],
                        [
                            'attribute' => 'client_from',
                            'format' => 'raw',
                            'value' => function ($model) {
                             return urldecode($model->client_from);
                            },
                        ],
                        [
                            'attribute' => 'other',
                            'filter' => false,
                            'format' => 'raw',
                            'value' => function ($model) {
                                if ($model->other == 'mobile') {
                                    return '<i class="fas fa-mobile-alt" style="width: 3.125em; font-size: 23px; color: #a77120"></i>';
                                } elseif ($model->other == 'desktop') {
                                    return '<i class="fas fa-desktop" style="width: 3.125em; font-size: 23px; color: #20a73d"></i>';
                                } else {
                                    return '<i class="fas fa-ban" style="width: 3.125em; font-size: 23px; color: #a72032"></i>';
                                }
                            },
                            'contentOptions' => ['style' => 'width: 62px'],
                        ],
                        [
                            'attribute' => 'status_serv',
                            'format' => 'raw',
                            'value' => function ($model) {
                                if ($model->status_serv == '200') {
                                    return '<i style="color: #398d05">' . $model->status_serv . '</i>';
                                } elseif ($model->status_serv == '500') {
                                    return '<i style="color: #c86408">' . $model->status_serv . '</i>';
                                } elseif ($model->status_serv == '404') {
                                    return '<i style="color: #c10518">' . $model->status_serv . '</i>';
                                } else {
                                    return '<i style="color: #0c33be">' . $model->status_serv . '</i>';
                                }
                            },
                            'contentOptions' => ['style' => 'width: 40px; text-align: center;'],
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, ActivePages $model) {
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
<style>
    .summary-info {
        font-size: 18px;
        font-weight: bold;
        color: #00050b;
    }
</style>
