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

        return $this->render('latest-product',
            [
                'products' => $this->products,
                'language' => $language,
                'title' => $title,
            ]);
    }

}