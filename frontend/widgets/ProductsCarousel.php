<?php


namespace frontend\widgets;

use common\models\shop\Product;
use common\models\shop\ProductGrup;
use yii\base\Widget;

class ProductsCarousel extends Widget   // Нові надходження
{
    public $slug;

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        if ($this->slug === 'rekomendacii-sodo-borotbi-zi-slimakami-v-pogrebi-ta-pidvali') {
            $ids = [122, 136, 137, 219, 248, 249];
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
                ->where(['id' => $ids])
                ->all();
            return $this->render('products-carousel', ['products' => $products]);

        } else {

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

            return $this->render('products-carousel', ['products' => $products]);
        }
    }


}