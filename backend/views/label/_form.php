<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;

/** @var yii\web\View $this */
/** @var common\models\shop\Label $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="label-form">
    <?php $form = ActiveForm::begin(); ?>
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container container--max--xl">
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
                        <div class="col-auto d-flex">
                            <?php if (!$model->isNewRecord): ?>
                                <?= Html::a(Yii::t('app', 'List'), Url::to(['index']), ['class' => 'btn btn-secondary me-3']) ?>
                                <?= Html::a(Yii::t('app', 'Create more'), Url::to(['create']), ['class' => 'btn btn-success me-3']) ?>
                            <?php endif; ?>
                            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
                <div class="sa-entity-layout"
                     data-sa-container-query='{"920":"sa-entity-layout--size--md","1100":"sa-entity-layout--size--lg"}'>
                    <div class="sa-entity-layout__body">
                        <div class="sa-entity-layout__main">
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="mb-5"><h2
                                                class="mb-0 fs-exact-18"><?= Yii::t('app', 'Basic information') ?></h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 mb-4">
                                            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(Yii::t('app', 'name')) ?>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <div class="product-card__badges-list">
                                                <div class="product-card__badge product-card__badge--new"
                                                     style="background: <?= Html::encode($model->color) ?>;">
                                                    <?= $model->name ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <?= $form->field($model, 'color')->widget(ColorInput::class, [
                                                'options' => ['placeholder' => Yii::t('app', 'Select color')],
                                                'pluginOptions' => ['preferredFormat' => 'rgb'],
                                            ])->label(Yii::t('app', 'Color')) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<style>
    .product-card__badges-list {
        position: absolute;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
        z-index: 1;
    }

    .product-card__badge--new {
        background: #3377ff;
        color: #fff;
    }

    .product-card__badge {
        font-size: 11px;
        border-radius: 2px;
        letter-spacing: 0.02em;
        line-height: 1;
        padding: 5px 8px 4px;
        font-weight: 500;
        text-transform: uppercase;
        margin-top: 30px;
    }
</style>
