<?php

namespace frontend\widgets;

use app\widgets\BaseWidgetFronted;
use Yii;

class ProductsCarousel extends BaseWidgetFronted
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $language = Yii::$app->session->get('_language', 'uk');

        $title = 'Нові надходження';
        $grup_id = 3;
        $limit = 20;
//        $cacheKey = 'productsCarousel_cache_key';
//        $dependency = new DbDependency([
//            'sql' => 'SELECT MAX(date_updated) FROM product',
//        ]);
//
//        $products = Yii::$app->cache->get($cacheKey);
//        if ($products === false || !Yii::$app->cache->get($cacheKey . '_db')) {

        $products = $this->translateProductsCarousel($language, $grup_id, $limit);

//            Yii::$app->cache->set($cacheKey, $products, 3600, $dependency);
//            Yii::$app->cache->set($cacheKey . '_db', true, 0, $dependency);
//        }

        return $this->render('products-carousel',
            [
                'products' => $products,
                'language' => $language,
                'title' => $title,
            ]);
    }
}