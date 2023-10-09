<?php

use common\models\shop\ActivePages;
use kartik\ipinfo\IpInfo;
use kartik\popover\PopoverX;

//use yii\bootstrap5\ActiveForm;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\search\ActivePagesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Active Pages');
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
                <div class="sa-divider"></div>
                <div class="container">
                    <?php echo Html::beginForm(['check-delete'], 'post'); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'pager' => [
                            'class' => LinkPager::class,
                            'options' => ['class' => 'pagination'],
//                            'maxButtonCount' => 5,
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
                                'label' => 'IP',
                                'format' => 'raw',
                                'filter' => false,
                                'visible' => true,
                                'value' => function($model){
                                    return IpInfo::widget([
                                        'ip' => $model->ip_user,
                                        'popoverOptions' => [
                                            'options' => [
                                                'style' => 'display:none'
                                            ],
                                            'toggleButton' => ['class' => 'btn btn-secondary btn-default btn-lg'],
                                            'placement' => PopoverX::ALIGN_AUTO_BOTTOM,
                                        ]
                                    ]);
                                },
                                'contentOptions' => ['style' => 'width: 110px; text-align: center; vertical-align: middle;'],
                            ],

                            [
                                'attribute' => 'ip_user',
                                'label' => 'Місто',
                                'format' => 'raw',
                                'visible' => true,
                                'value' => function ($model) {

                                    return IpInfo::widget([
                                        'ip' => $model->ip_user,
                                        'showPopover' => false,
                                        'template' => ['inlineContent' => '{city}'],
                                    ]);
                                },
                                'contentOptions' => ['style' => 'width: 150px; text-align: center; vertical-align: middle;'],
                            ],
                            [
                                'attribute' => 'date_visit',
                                'filter' => false,
                                'value' => function ($model) {
                                    return Yii::$app->formatter->asDatetime($model->date_visit, 'medium');
                                },
                                'contentOptions' => ['style' => 'width: 200px'],
                            ],
                            'url_page',
                            [
                                'attribute' => 'client_from',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    $decodedUrl = urldecode($model->client_from);
                                    return $decodedUrl;
                                },
                            ],
//                            'user_agent',
                            //'status_serv',
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
//                                'contentOptions' => ['style' => 'width: 62px'],
                                'contentOptions' => ['style' => 'width: 62px; text-align: center; vertical-align: middle;'],
                            ],
                            [
                                'class' => ActionColumn::className(),
                                'urlCreator' => function ($action, ActivePages $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id, 'selection' => $model->id]);
                                }
                            ],
                        ],
                    ]); ?>

                    <?= Html::submitButton('<i class="fas fa-trash-alt"></i> Вибрані', ['class' => 'btn btn-danger mb-4']) ?>

                    <?php echo Html::endForm(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
