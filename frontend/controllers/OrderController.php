<?php

namespace frontend\controllers;

use common\models\shop\Order;
use common\models\shop\OrderItem;
use Yii;
use yii\web\Controller;

class OrderController extends Controller
{
    public function actionCheckout()
    {
//        Yii::$app->cache->flush();
        $request = Yii::$app->request;
        $order = new Order();

        if ($order->load($this->request->post()) && $order->save()) {
            foreach (Yii::$app->cart->getPositions() as $order_cart) {

                $order_item = new OrderItem();
                $order_item->order_id = $order->id;
                $order_item->product_id = $order_cart->id;
                $order_item->price = $order_cart->getPrice();
                $order_item->quantity = strval($order_cart->quantity);
                if ($order_item->save()) {

                }
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

    public function actionOrderSuccess($order_id)
    {
        $order = Order::find()->with('orderItems')->where(['id' => $order_id])->one();

        if (!$order->sent_message) {
            $chat_id = 6086317334;
            Yii::$app->telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => "Нове замовлення: *#{$order->id}*\n" .
                    "ПІБ: *{$order->fio}*\n" .
                    "Телефон: *{$order->phone}*\n" .
                    "Місто: *{$order->city}*\n" .
                    "Коментар: *{$order->note}*",
                'parse_mode' => 'Markdown',
            ]);

            Yii::$app->mailer->compose()
                ->setTo(['mikitenko@i.ua', 'mikitenkoivan361@gmail.com'])
                ->setFrom('jean1524@s6.uahosting.com.ua')
                ->setSubject('Нове замовлення на AgroPro.org.ua !!!')
                ->setHtmlBody('<h3>Нове замовлення: #' . $order->id . '</h3>' .
                    '<p>ПІБ: ' . $order->fio . '</p>' .
                    '<p>Телефон: ' . $order->phone . '</p>' .
                    '<p>Місто: ' . $order->city . '</p>' .
                    '<p>Коментар: ' . $order->note . '</p>'
                )
                ->send();

            $order->sent_message = true;
            $order->save();
        }else{

            return $this->redirect(['/site/index']);
        }

        return $this->render('order-success', ['order' => $order]);
    }


}