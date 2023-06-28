<?php

use common\models\Posts;
use yii\bootstrap5\Breadcrumbs;
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
<!-- sa-app__body -->
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
                    <div class="col-auto d-flex"><a href="<?=Url::to(['create'])?>" class="btn btn-primary"><?=Yii::t('app', 'New post')?></a></div>
                </div>
            </div>
            <div class="card">
                <div class="sa-divider"></div>
                <div class="container">
                        <?php echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
//                                'id',
                                [
                                    'attribute' => 'date_public',
                                    'filter' => false,
                                    'value' => function($model){
                                        return Yii::$app->formatter->asDate($model->date_public, 'long');
                                    },
                                ],
                                [
                                    'attribute' => 'image',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return Html::img(Yii::$app->request->hostInfo . '/posts/' .$model->image, ['width' => '250px']);
                                    },
                                ],
                                'title',
                                [
                                    'attribute' => 'description',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return mb_substr($model->description, 0, 450);
                                    },
                                ],

//                                'seo_title:raw',
//                                'seo_description:raw',
//                                'description:raw',
//                                'date_public',
//                                'image',
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
</div>
<!-- sa-app__body / end -->

