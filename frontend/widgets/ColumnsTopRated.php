<?php


namespace frontend\widgets;


use common\models\shop\Product;
use common\models\shop\ProductGrup;
use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class ColumnsTopRated extends Widget   //  Гербіциди
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $language =Yii::$app->session->get('_language');
        $title = 'Гербіциди';
        $url = Url::to(['product-list/gerbitsidi']);

        $products_grup = ProductGrup::find()
            ->select('product_id')
            ->where(['grup_id' => 4])            //  Перша_Группа_Тест
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
            ->limit(3)
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
                }
            }
        }

        return $this->render('product-columns',
            [
                'products' => $products,
                'title' => $title,
                'url' => $url,
                'language' => $language,
            ]);
    }


}