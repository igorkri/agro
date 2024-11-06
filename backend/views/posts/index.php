<?php

use common\models\Posts;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var backend\models\search\PostsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="top" class="sa-app__body">
    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
        <div class="container" style="max-width: 1623px">
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
                    <div class="col-auto d-flex"><a href="<?= Url::to(['create']) ?>"
                                                    class="btn btn-primary"><?= Yii::t('app', 'New post') ?></a></div>
                </div>
            </div>
            <div class="card">
                <div class="sa-divider"></div>
                <?php echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'pager' => [
                        'class' => LinkPager::class,
                        'options' => ['class' => 'pagination'],
//                            'maxButtonCount' => 5,
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'image',
                            'format' => 'html',
                            'value' => function ($model) {
                                return Html::img(Yii::$app->request->hostInfo . '/posts/' . $model->medium);
                            },
                        ],
                        [
                            'attribute' => 'date_public',
                            'filter' => false,
                            'value' => function ($model) {
                                return Yii::$app->formatter->asDate($model->date_public, 'short');
                            },
                        ],
                        [
                            'attribute' => 'date_updated',
                            'filter' => false,
                            'value' => function ($model) {
                                if ($model->date_updated) {
                                    return Yii::$app->formatter->asDate($model->date_updated, 'short');
                                } else {
                                    return Yii::$app->formatter->asDate($model->date_public, 'short');
                                }
                            },
                        ],
                        'title',
                        [
                            'attribute' => 'description',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return mb_substr($model->description, 0, 250);
                            },
                        ],

                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, Posts $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>


