<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\shop\Product;

class ProductController extends Controller
{
    public function actionView($slug): string
    {

        $product = Product::find()->with('category.parent')->where(['slug' => $slug])->one(); //all products

//debug($product);
//die;
        return $this->render('index', ['product' => $product]);
    }

}
