<?php


namespace frontend\widgets;


use common\models\shop\Product;
use yii\base\Widget;

class ProductsCarousel extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $products = Product::find()
            ->with('label')
            ->limit(20)
            ->where(['status_id'=>1])
            ->orderBy('id DESC')
            ->all();

        return $this->render('products-carousel', ['products' => $products]);
    }


}