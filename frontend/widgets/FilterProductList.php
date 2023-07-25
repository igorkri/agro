<?php


namespace frontend\widgets;


use common\models\shop\Brand;
use common\models\shop\Category;

class FilterProductList extends \yii\base\Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $brands = Brand::find()->all();

        $categories = Category::find()->where(['visibility' => 1])->all();

        return $this->render('filter-product-list', [
            'brands' => $brands,
            'categories' => $categories
            ]);
    }

}