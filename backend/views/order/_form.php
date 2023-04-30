<?php

use common\models\OrderPayMent;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\shop\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'note')->textarea(['rows' => 4]) ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'order_pay_ment_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(OrderPayMent::find()->all(), 'id', 'name')
            ) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'order_status_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(\common\models\shop\OrderStatus::find()->all(), 'id', 'name')
            ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-8">
            <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <?php echo $form->field($model, 'city')->textInput(['maxlength' => true]) ?>


    <?php ActiveForm::end(); ?>

</div>
