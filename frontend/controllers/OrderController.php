<?php


namespace frontend\controllers;


use Yii;
use yii\web\Controller;

class OrderController extends Controller
{

    public function actionCheckout(){



        return $this->render('checkout', [
            'orders' => Yii::$app->cart->getPositions(),
            'total_summ' => Yii::$app->cart->getCost(),
            'qty_cart' => \Yii::$app->cart->getCount(),
        ]);
    }

}