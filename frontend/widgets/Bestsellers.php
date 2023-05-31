<?php


namespace frontend\widgets;


use common\models\shop\Product;
use yii\base\Widget;

class Bestsellers extends Widget  // Найкращі товари
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
            ->limit(7)
            ->all();

        return $this->render('bestsellers', ['products' => $products]);
    }


}