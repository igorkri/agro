<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\shop\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>
    <?= $form->field($model, 'note')->textarea(['maxlength' => true]) ?>
<div class="row">
    <?php // $form->field($model, 'created_at')->textInput() ?>

    <?php // $form->field($model, 'updated_at')->textInput() ?>
<div class="col-sm-6">
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'order_status_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(\common\models\shop\OrderStatus::find()->all(), 'id', 'name')
    ) ?>
</div>
</div>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>


    <?php // $form->field($model, 'city')->textInput(['maxlength' => true]) ?>


    <?php ActiveForm::end(); ?>

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