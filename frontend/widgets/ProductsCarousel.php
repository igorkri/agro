<?php


namespace frontend\widgets;


use common\models\shop\Product;
use yii\base\Widget;

class ProductsCarousel extends Widget   // Нові надходження
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $products = Product::find()
            ->with('label')
            ->where(['status_id' => 1])
            ->orderBy('id DESC')
            ->limit(10)
            ->all();

        return $this->render('products-carousel', ['products' => $products]);
    }


}