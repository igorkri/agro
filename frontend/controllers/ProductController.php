<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\shop\Product;

class ProductController extends Controller
{
    public function actionView($slug): string
    {

        $product = Product::find()->where(['slug' => $slug])->one();

        return $this->render('index', ['product' => $product]);
    }

}
