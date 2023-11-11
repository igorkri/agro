<?php


namespace frontend\widgets;

use common\models\shop\Product;
use yii\base\Widget;
use yii\db\Expression;

class RelatedProducts extends Widget  // Супутні товари
{

    public function init()
    {
        parent::init();

    }
    public $package;

    public function run()
    {
        $package = $this->package;
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
                'package',
                'category_id',
            ])
            ->where(['IN', 'status_id', [1, 3, 4]])
            ->andWhere(['package' => $package])
            ->orderBy(new Expression('RAND()'))
            ->limit(15)
            ->all();

        return $this->render('related-products', [
            'products' => $products,
        ]);
    }


}
