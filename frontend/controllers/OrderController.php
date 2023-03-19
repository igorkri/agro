<?php


namespace frontend\controllers;


use common\models\shop\Order;
use common\models\shop\OrderItem;
use Yii;
use yii\web\Controller;

class OrderController extends Controller
{

    public function actionCheckout(){
//        Yii::$app->cache->flush();
        $request = Yii::$app->request;
        $order = new Order();

        if($order->load($this->request->post()) && $order->save()){
            foreach (Yii::$app->cart->getPositions() as $order_cart){
                $order_item = new OrderItem();
                $order_item->order_id = $order->id;
                $order_item->product_id = $order_cart->id;
                $order_item->price = $order_cart->price;
                $order_item->quantity = $order_cart->quantity;
                $order_item->save();
            }
            \Yii::$app->cart->removeAll();
            return $this->redirect(['order-success', 'order_id' => $order->id]);
        }

        return $this->render('checkout', [
            'order' => $order,
            'orders' => Yii::$app->cart->getPositions(),
            'total_summ' => Yii::$app->cart->getCost(),
            'qty_cart' => \Yii::$app->cart->getCount(),
        ]);
    }

    public function actionOrderSuccess($order_id){
        $order = Order::find()->with('orderItems')->where(['id' => $order_id])->one();

        return $this->render('order-success', ['order' => $order]);
    }

}