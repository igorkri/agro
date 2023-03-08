<?php

use common\models\shop\Order;
use common\models\shop\OrderStatus;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;


/** @var yii\web\View $this */
/** @var backend\models\search\shop\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Замовлення';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?php // Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'width' => '80px',
            ],
            [
                'attribute' => 'created_at',
                'value' => function($model){
                    return $model->created_at ? Yii::$app->formatter->asDatetime($model->created_at) : '';
                },
                'width' => '150px',

            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model){
                    return $model->updated_at ? Yii::$app->formatter->asDatetime($model->updated_at) : 'Не оновлювалось';
                },
                'width' => '150px',

            ],
            'fio',
            [
                'attribute' => 'phone',
                'value' => function($model){
                    return $model->phone ? $model->phone : "";
                },
                'width' => '180px',

            ],
            //'city',
//            'note',
            [
                'attribute' => 'order_status_id',
                'value' => function($model){
                    return $model->orderStatus ? $model->orderStatus->name : "Новий";
                },
                'width' => '120px',

            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
