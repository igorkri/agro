<?php

use common\models\shop\Brand;
use common\models\shop\Category;
use common\models\shop\Product;
use common\models\shop\Status;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\search\ProductSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
    ]); ?>

    <div class="sa-layout__sidebar">
        <div class="sa-layout__sidebar-header">
            <div class="sa-layout__sidebar-title">Фільтр</div>
            <button type="button" class="sa-close sa-layout__sidebar-close" aria-label="Close"
                    data-sa-layout-sidebar-close=""></button>
        </div>
        <div class="sa-layout__sidebar-body sa-filters">
            <ul class="sa-filters__list">
                <li class="sa-filters__item">
                    <div class="sa-filters__item-title">Ціна</div>
                    <div class="sa-filters__item-body">
                        <?php
                        $minPrice = round(Product::find()->min('price'), 2);
                        $maxPrice = round(Product::find()->max('price'), 2);

                        $request = Yii::$app->request;
                        $submittedMinPrice = $request->post('minPrice', $minPrice);
                        $submittedMaxPrice = $request->post('maxPrice', $maxPrice);
                        ?>
                        <div class="sa-filter-range" data-min="<?= $minPrice ?>" data-max="<?= $maxPrice ?>"
                             data-from="<?= $submittedMinPrice ?>"
                             data-to="<?= $submittedMaxPrice ?>">
                            <div class="sa-filter-range__slider"></div>
                            <input type="hidden" name="minPrice" id="minPrice" value="<?= $submittedMinPrice ?>"
                                   class="sa-filter-range__input-from"/>
                            <input type="hidden" name="maxPrice" id="maxPrice" value="<?= $submittedMaxPrice ?>"
                                   class="sa-filter-range__input-to"/>
                        </div>
                    </div>
                </li>
                <li class="sa-filters__item">
                    <div class="sa-filters__item-body">
                        <ul class="list-unstyled m-0 mt-n2">
                            <button type="submit" class="btn btn-primary">Фільтрувати</button>
                            <?= Html::a('Скинути', ['index'], ['class' => 'btn btn-default']) ?>
                        </ul>
                    </div>
                </li>
                <li class="sa-filters__item">
                    <div class="sa-filters__item-title">Категорії</div>
                    <div class="sa-filters__item-body scrollable-container">
                        <ul class="list-unstyled m-0 mt-n2">
                            <?php
                            $productCatIds = Product::find()
                                ->select('category_id')
                                ->distinct()
                                ->andWhere(['IS NOT', 'category_id', null])
                                ->column();

                            $categories = Category::find()
                                ->select(['name', 'id'])
                                ->andWhere(['id' => $productCatIds])
                                ->andWhere(['visibility' => 1])
                                ->all();
                            ?>

                            <?php foreach ($categories as $category) { ?>
                                <li>
                                    <label class="d-flex align-items-center pt-2">
                                        <input
                                                type="checkbox"
                                                class="form-check-input m-0 me-3 fs-exact-16"
                                                name="category[]"
                                                value="<?= Html::encode($category->id) ?>"
                                            <?= in_array($category->id, Yii::$app->request->post('category', [])) ? 'checked' : '' ?>
                                        />
                                        <?= $category->name ?>
                                    </label>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
                <li class="sa-filters__item">
                    <div class="sa-filters__item-title">Статус</div>
                    <div class="sa-filters__item-body">
                        <ul class="list-unstyled m-0 mt-n2">
                            <?php $status = Status::find()->all() ?>
                            <?php foreach ($status as $stat) { ?>
                                <li>
                                    <label class="d-flex align-items-center pt-2">
                                        <input
                                                type="radio"
                                                class="form-check-input m-0 me-3 fs-exact-16"
                                                name="status"
                                                value="<?= Html::encode($stat->id) ?>"
                                            <?= Yii::$app->request->post('status') == $stat->id ? 'checked' : '' ?>
                                        />
                                        <?= $stat->name ?>
                                    </label>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
                <li class="sa-filters__item">
                    <div class="sa-filters__item-title">Дата оновлення</div>
                    <div class="sa-filters__item-body">
                        <ul class="list-unstyled m-0 mt-n2">
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input
                                            type="radio"
                                            class="form-check-input m-0 me-3 fs-exact-16"
                                            name="date-update"
                                            value="11"
                                        <?= Yii::$app->request->post('date-update') == 11 ? 'checked' : '' ?>
                                    />
                                    Від давніх
                                </label>
                            </li>
                            <li>
                                <label class="d-flex align-items-center pt-2">
                                    <input
                                            type="radio"
                                            class="form-check-input m-0 me-3 fs-exact-16"
                                            name="date-update"
                                            value="22"
                                        <?= Yii::$app->request->post('date-update') == 22 ? 'checked' : '' ?>
                                    />
                                    Від останніх
                                </label>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sa-filters__item">
                    <div class="sa-filters__item-title">Бренди</div>
                    <div class="sa-filters__item-body scrollable-container">
                        <ul class="list-unstyled m-0 mt-n2">
                            <?php $brands = Brand::find()->all() ?>
                            <?php foreach ($brands as $brand) { ?>
                                <li>
                                    <label class="d-flex align-items-center pt-2">
                                        <input
                                                type="radio"
                                                class="form-check-input m-0 me-3 fs-exact-16"
                                                name="brand"
                                                value="<?= Html::encode($brand->id) ?>"
                                            <?= Yii::$app->request->post('brand') == $brand->id ? 'checked' : '' ?>
                                        />
                                        <?= $brand->name ?>
                                    </label>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
                <li class="sa-filters__item">
                    <div class="sa-filters__item-body">
                        <ul class="list-unstyled m-0 mt-n2">
                            <button type="submit" class="btn btn-primary">Фільтрувати</button>
                            <?= Html::a('Скинути', ['index'], ['class' => 'btn btn-default']) ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<style>
    .scrollable-container {
        max-height: 200px;
        overflow-y: auto;
    }
</style>