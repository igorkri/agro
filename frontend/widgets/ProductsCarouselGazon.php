<?php

namespace frontend\widgets;

use common\models\shop\Product;
use common\models\shop\ProductGrup;
use Yii;
use yii\base\Widget;
use yii\caching\DbDependency;

class ProductsCarouselGazon extends Widget   // Газонна Трава
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $cacheKey = 'productsCarouselGazon_cache_key';
        $products = Yii::$app->cache->get($cacheKey);

        if ($products === false) {
            $products_grup = ProductGrup::find()
                ->select('product_id')
                ->where(['grup_id' => 8])            //  Газонна Трава
                ->column();

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
                ->with('label')
                ->where(['id' => $products_grup])
                ->limit(20)
                ->all();

            Yii::$app->cache->set($cacheKey, $products, 3600, new DbDependency([
                'sql' => 'SELECT COUNT(*) FROM product',
            ]));
        }

            return $this->render('products-carousel-gazon', ['products' => $products]);
    }
}
