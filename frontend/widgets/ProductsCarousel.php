<?php

namespace frontend\widgets;

use common\models\shop\Product;
use common\models\shop\ProductGrup;
use Yii;
use yii\caching\DbDependency;
use yii\base\Widget;

class ProductsCarousel extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $language =Yii::$app->session->get('_language');

        $title = 'Нові надходження';

        $cacheKey = 'productsCarousel_cache_key';
        $dependency = new DbDependency([
            'sql' => 'SELECT MAX(date_updated) FROM product',
        ]);

        $products = Yii::$app->cache->get($cacheKey);

        if ($products === false || !Yii::$app->cache->get($cacheKey . '_db')) {

            $products_grup = ProductGrup::find()
                ->select('product_id')
                ->where(['grup_id' => 3])            //  Перша_Группа_Тест
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
            Yii::$app->cache->set($cacheKey . '_db', true, 0, $dependency);
        }

        if ($language !== 'uk') {
            foreach ($products as $product) {
                if ($product) {
                    $translationProd = $product->getTranslation($language)->one();
                    if ($translationProd) {
                        if ($translationProd->name) {
                            $product->name = $translationProd->name;
                        }
                    }
                }
            }
        }

            return $this->render('products-carousel',
                [
                    'products' => $products,
                    'language' => $language,
                    'title' => $title,
                ]);
    }
}