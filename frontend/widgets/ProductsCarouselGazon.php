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
        $language =Yii::$app->session->get('_language');

        $title = 'Газонна Трава';

        $cacheKey = 'productsCarouselGazon_cache_key';
        $dependency = new DbDependency([
            'sql' => 'SELECT MAX(date_updated) FROM product',
        ]);

        $products = Yii::$app->cache->get($cacheKey);

        if ($products === false || !Yii::$app->cache->get($cacheKey . '_db')) {
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

            Yii::$app->cache->set($cacheKey, $products, 3600, $dependency);
            Yii::$app->cache->set($cacheKey . '_db', true, 0, $dependency); // Помечаем кэш базы данных как актуальный
        }

        return $this->render('products-carousel',
            [
                'products' => $products,
                'language' => $language,
                'title' => $title,
            ]);
    }
}
