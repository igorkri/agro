<?php


namespace frontend\widgets;


use common\models\shop\Product;
use common\models\shop\ProductGrup;
use Yii;
use yii\base\Widget;

class Bestsellers extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run() {

        $language =Yii::$app->session->get('_language');
        $title = 'Товари для Фермера';

        $products_grup = ProductGrup::find()
            ->select('product_id')
            ->where(['grup_id' => 1])            //  Перша_Группа_Тест
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
                'category_id',
            ])
            ->with('label')
            ->where(['id' => $products_grup])
            ->limit(7)
            ->all();

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

        return $this->render('bestsellers',
            [
                'products' => $products,
                'title' => $title,
                'language' => $language,
            ]);
    }


}