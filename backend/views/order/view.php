<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\shop\Order $model */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Замовлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">


    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at:datetime',
            'updated_at:datetime',
            'note',
            [
                'attribute'  => 'order_status_id',
                'value' => function($model){
                    return $model->orderStatus ? $model->orderStatus->name : 'Новий';
                },
            ],
            'fio',
            'phone',
//            'city',
        ],
    ]) ?>

</div>
<?php if($model->orderItems): ?>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID товару</th>
                <th scope="col">Товар</th>
                <th scope="col">К-ть</th>
                <th scope="col">Ціна</th>
            </tr>
            </thead>
            <?php $i = 1; foreach ($model->orderItems as $item): ?>
                <tbody>
                <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$item->id?></td>
                    <td><?=$item->product->name?></td>
                    <td><?=$item->quantity?></td>
                    <td><?=$item->price?></td>
                </tr>
                </tbody>
                <?php $i++; endforeach; ?>
        </table>
    </div>
<?php endif; ?>
