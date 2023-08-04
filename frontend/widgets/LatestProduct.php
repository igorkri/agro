<?php


namespace frontend\widgets;


use common\models\shop\Product;
use common\models\shop\ProductProperties;
use yii\db\Expression;

class LatestProduct extends \yii\base\Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $products = Product::find()
            ->select([
                'id',
                'name',
                'slug',
                'price',
                'old_price',
                'status_id',
                'label_id',
                'currency',
            ])
            ->where(['IN', 'status_id', [1, 3, 4]])
            ->orderBy(new Expression('RAND()'))
            ->limit(5)
            ->all();

        return $this->render('latest-product', ['products' => $products]);
    }

}