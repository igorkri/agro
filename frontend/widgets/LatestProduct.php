<?php

namespace frontend\widgets;

use Yii;
use yii\base\Widget;

class LatestProduct extends Widget
{
    public function init()
    {
        parent::init();
    }
    public $products;

    public function run()
    {
        $language =Yii::$app->session->get('_language');

        $title = 'Може зацікавити';

        $products = $this->products;

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
        return $this->render('latest-product',
            [
                'products' => $products,
                'language' => $language,
                'title' => $title,
            ]);
    }

}