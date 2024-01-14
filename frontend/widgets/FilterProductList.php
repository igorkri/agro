<?php

namespace frontend\widgets;

use common\models\shop\Brand;
use common\models\shop\Category;
use common\models\shop\Product;
use yii\base\Widget;

class FilterProductList extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $minPrice = Product::find()->min('price');
        $maxPrice = Product::find()->max('price');
        $brands = Brand::find()->all();
        $categories = Category::find()
            ->where(['visibility' => 1])
            ->all();

        $minPrice = round($minPrice);
        $maxPrice = round($maxPrice);

        return $this->render('filter-product-list', [
            'brands' => $brands,
            'categories' => $categories,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
            ]);
    }

}