<?php


namespace frontend\widgets;


use common\models\shop\Product;
use yii\base\Widget;

class RelatedProducts extends Widget  // Супутні товари
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $products = Product::find()
            ->where(['IN', 'status_id', [1, 3, 4]])
            ->limit(20)
            ->all();

        return $this->render('related-products', [
            'products' => $products,
        ]);
    }


}
