<?php


namespace frontend\controllers;


use common\models\shop\Product;
use yii\web\Controller;

class CartController extends Controller
{
    public function actionQuickview(){

        $product = Product::find()->limit(3)->all();

        return $this->renderPartial('quickview', ['orders' => $product]);

    }

}