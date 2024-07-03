<?php

namespace frontend\widgets;

use common\models\shop\Product;
use common\models\shop\ProductGrup;
use Yii;
use yii\base\Widget;
use yii\caching\DbDependency;

class FeaturedProduct extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $language =Yii::$app->session->get('_language');

        $title = 'Популярні товари';

        $cacheKey = 'featuredProduct_cache_key';
        $dependency = new DbDependency([
            'sql' => 'SELECT MAX(date_updated) FROM product',
        ]);

        $products = Yii::$app->cache->get($cacheKey);

        if ($products === false || !Yii::$app->cache->get($cacheKey . '_db')) {
            $products_grup = ProductGrup::find()
                ->select('product_id')
                ->where(['grup_id' => 2])            //  Друга_Группа_Тест
                ->column();

            $products = Product::find()
                ->with(['category.parent'])
                ->select([
                    'id',
                    'name',
                    'slug',
                    'price',
                    'old_price',
                    'status_id',
                    'label_id',
                    'currency',
                    'category_id',
                ])
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
                    $translationCat = $product->category->getTranslation($language)->one();
                    if ($translationCat) {
                        if ($translationCat->name) {
                            $product->category->name = $translationCat->name;
                        }
                        if ($translationCat->prefix) {
                            $product->category->prefix = $translationCat->prefix;
                        }
                    }
                }
            }
        }

        return $this->render('products-carousel-slide',
            [
                'products' => $products,
                'language' => $language,
                'title' => $title,
            ]);
    }
}