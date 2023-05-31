<?php


namespace frontend\widgets;


use common\models\shop\Product;
use yii\base\Widget;

class ColumnsSpecialOffers extends Widget  // Фунгіциди
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {

        $products = Product::find()
            ->with('label')
            ->where(['category_id' => 6])
            ->andWhere(['IN', 'status_id', [1, 3, 4]])
            ->limit(3)
            ->all();

        return $this->render('columns-special-offers', ['products' => $products]);
    }


}