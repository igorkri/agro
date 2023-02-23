<?php


namespace frontend\widgets;


use common\models\shop\Product;
use yii\base\Widget;

class ColumnsTopRated extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $products = Product::find()->with('label')->orderBy('id DESC')->limit(3)->all();
       
        return $this->render('columns-top-rated', ['products' => $products]);
    }


}