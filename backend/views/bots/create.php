<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Bots $model */

$this->title = Yii::t('app', 'Create Bots');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bots'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bots-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
