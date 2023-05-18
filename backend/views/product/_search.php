<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\ProductSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="sa-layout__sidebar">
        <div class="sa-layout__sidebar-header">
            <div class="sa-layout__sidebar-title">Фільтер</div>
            <button type="button" class="sa-close sa-layout__sidebar-close" aria-label="Close" data-sa-layout-sidebar-close=""></button>
        </div>
        <div class="sa-layout__sidebar-body sa-filters">
            <ul class="sa-filters__list">
                <li class="sa-filters__item">
                    <div class="sa-filters__item-title">Ціна</div>
                    <div class="sa-filters__item-body">
                        <div class="sa-filter-range" data-min="0" data-max="2000" data-from="0" data-to="2000">
                            <div class="sa-filter-range__slider"></div>
                            <input type="hidden" value="0" class="sa-filter-range__input-from" />
                            <input type="hidden" value="2000" class="sa-filter-range__input-to" />
                        </div>
                    </div>
                </li>
                <li class="sa-filters__item">
                    <div class="sa-filters__item-title">Категорії</div>
                    <div class="sa-filters__item-body">
                        <ul class="list-unstyled m-0 mt-n2">
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input type="checkbox" class="form-check-input m-0 me-3 fs-exact-16" checked="" />
                                    Power tools
                                </label>
                            </li>
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input type="checkbox" class="form-check-input m-0 me-3 fs-exact-16" />
                                    Hand tools
                                </label>
                            </li>
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input type="checkbox" class="form-check-input m-0 me-3 fs-exact-16" checked="" />
                                    Machine tools
                                </label>
                            </li>
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input type="checkbox" class="form-check-input m-0 me-3 fs-exact-16" />
                                    Power machinery
                                </label>
                            </li>
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input type="checkbox" class="form-check-input m-0 me-3 fs-exact-16" />
                                    Measurement
                                </label>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sa-filters__item">
                    <div class="sa-filters__item-title">Культура</div>
                    <div class="sa-filters__item-body">
                        <ul class="list-unstyled m-0 mt-n2">
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input
                                            type="radio"
                                            class="form-check-input m-0 me-3 fs-exact-16"
                                            name="filter-product_type"
                                            checked=""
                                    />
                                    Simple
                                </label>
                            </li>
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input type="radio" class="form-check-input m-0 me-3 fs-exact-16" name="filter-product_type" />
                                    Variable
                                </label>
                            </li>
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input type="radio" class="form-check-input m-0 me-3 fs-exact-16" name="filter-product_type" />
                                    Digital
                                </label>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sa-filters__item">
                    <div class="sa-filters__item-title">Бренди</div>
                    <div class="sa-filters__item-body">
                        <ul class="list-unstyled m-0 mt-n2">
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input type="checkbox" class="form-check-input m-0 me-3 fs-exact-16" />
                                    Brandix
                                </label>
                            </li>
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input type="checkbox" class="form-check-input m-0 me-3 fs-exact-16" checked="" />
                                    FastWheels
                                </label>
                            </li>
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input type="checkbox" class="form-check-input m-0 me-3 fs-exact-16" checked="" />
                                    FuelCorp
                                </label>
                            </li>
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input type="checkbox" class="form-check-input m-0 me-3 fs-exact-16" />
                                    RedGate
                                </label>
                            </li>
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input type="checkbox" class="form-check-input m-0 me-3 fs-exact-16" />
                                    Specter
                                </label>
                            </li>
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input type="checkbox" class="form-check-input m-0 me-3 fs-exact-16" />
                                    TurboElectric
                                </label>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
