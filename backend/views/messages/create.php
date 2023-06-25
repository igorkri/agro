<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Messages $model */

$this->title = Yii::t('app', 'Create Messages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
