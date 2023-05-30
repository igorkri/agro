<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\shop\OrderProvider $model */

$this->title = Yii::t('app', 'Create Order Provider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Providers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-provider-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
