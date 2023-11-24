<?php

namespace frontend\widgets;

use common\models\shop\Product;
use Yii;
use yii\base\Widget;

class ViewProduct extends Widget  // Супутні товари
{

    public function init()
    {
        parent::init();

    }
    public $id;

    public function run()
    {
        $id = $this->id;
        $product = Product::findOne($id);

        $viewedProducts = Yii::$app->session->get('viewedProducts', []);
        array_unshift($viewedProducts, $product->id);
        $viewedProducts = array_unique($viewedProducts);
        $viewedProducts = array_slice($viewedProducts, 0, 10); // Ограничение на количество просмотренных товаров
        Yii::$app->session->set('viewedProducts', $viewedProducts);

        $viewedProductsData = Product::find()
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
            ->where(['id' => $viewedProducts])
            ->all();

        return $this->render('view-product', ['viewedProducts' => $viewedProductsData]);
    }
}

