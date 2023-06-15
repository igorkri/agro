<?php


namespace frontend\widgets;


use common\models\shop\Product;
use common\models\shop\ProductGrup;
use yii\base\Widget;

class ColumnsSpecialOffers extends Widget  // Фунгіциди
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {

        $products_grup = ProductGrup::find()
            ->select('product_id')
            ->where(['grup_id' => 5])            //  Перша_Группа_Тест
            ->column();


        $products = Product::find()
            ->with('label')
            ->where(['id' => $products_grup])
            ->limit(3)
            ->all();

        return $this->render('columns-special-offers', ['products' => $products]);
    }


}