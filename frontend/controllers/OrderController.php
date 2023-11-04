<?php

namespace frontend\controllers;

use common\models\Contact;
use common\models\NpAreas;
use common\models\shop\Order;
use common\models\shop\OrderItem;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class OrderController extends Controller
{
    public function actionCheckout()
    {
//        Yii::$app->cache->flush();
//        $request = Yii::$app->request;
        $item_cart = Yii::$app->cart->getPositions();
        if ($item_cart) {
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

            $areas = ArrayHelper::map(NpAreas::find()
                ->where(['not in', 'description', ['АРК', 'Луганська']])
                ->asArray()
                ->all(), 'ref', 'description');

            $contacts = Contact::find()->one();
            return $this->render('checkout', [
                'contacts' => $contacts,
                'order' => $order,
                'areas' => $areas,
                'orders' => Yii::$app->cart->getPositions(),
                'total_summ' => Yii::$app->cart->getCost(),
                'qty_cart' => \Yii::$app->cart->getCount(),
            ]);
        } else {
            return $this->redirect(['/']);
        }
    }

    public function actionOrderSuccess($order_id)
    {
        $order = Order::find()->with('orderItems')->where(['id' => $order_id])->one();

        if (!$order->sent_message) {
            $chat_id = 6086317334;
            Yii::$app->telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => "Нове замовлення: *#{$order->id}*\n" .
                    "==========================\n" .
                    "піб:      *{$order->fio}*\n" .
                    "телефон:  *{$order->phone}*\n" .
                    "область:  *{$order->getNameArea($order->area)}*\n" .
                    "місто:    *{$order->getNameCity($order->city)}*\n" .
                    "відділ.:  *{$order->getNameWarehouse($order->warehouses)}*\n" .
                    "коментар: *{$order->note}*\n" .
                    "==========================\n",
                'parse_mode' => 'Markdown',
            ]);

            Yii::$app->mailer->compose()
                ->setTo(['mikitenko@i.ua', 'mikitenkoivan361@gmail.com'])
                ->setFrom('jean1524@s6.uahosting.com.ua')
                ->setSubject('Нове замовлення на AgroPro.org.ua !!!')
                ->setHtmlBody('<h3>Нове замовлення: #' . $order->id . '</h3>' .
                    '<p>піб: '      . $order->fio . '</p>' .
                    '<p>телефон: '  . $order->phone . '</p>' .
                    '<p>область: '  . $order->getNameArea($order->area) . '</p>' .
                    '<p>місто: '    . $order->getNameCity($order->city) . '</p>' .
                    '<p>відділ.: '  . $order->getNameWarehouse($order->warehouses) . '</p>' .
                    '<p>коментар: ' . $order->note . '</p>'
                )
                ->send();
            $order->sent_message = true;
            $order->save();
        } else {

            return $this->redirect(['/']);
        }

        return $this->render('order-success', ['order' => $order]);
    }

    public function actionConditions()
    {
        return $this->render('conditions');
    }

}