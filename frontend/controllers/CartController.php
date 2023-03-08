<?php


namespace frontend\controllers;


use common\models\shop\Product;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CartController extends Controller
{
    public function actionQuickview($id){

        $cart = Yii::$app->cart;

        $model = Product::findOne($id);
        if ($model) {
            $cart->put($model);
        return $this->renderPartial('quickview', [
            'orders' => Yii::$app->cart->getPositions()
        ]);
        }
        throw new NotFoundHttpException();

    }

}