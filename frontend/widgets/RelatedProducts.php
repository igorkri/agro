<?php


namespace frontend\widgets;

use common\models\shop\Product;
use Yii;
use yii\base\Widget;
use yii\db\Expression;

class RelatedProducts extends Widget
{

    public function init()
    {
        parent::init();

    }
    public $package;

    public function run()
    {
        $language =Yii::$app->session->get('_language');

        $title = 'Супутні товари';

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
