<?php

namespace backend\widgets;

use common\models\shop\OrderItem;
use common\models\shop\Order;
use DateInterval;
use DateTime;
use yii\base\Widget;

class AverageOrder extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $orders_pay = Order::find()
            ->select('id')
            ->where(['order_pay_ment_id' => 3])
            ->asArray()
            ->all();

        $orders_id = array_map(function ($item) {
            return $item['id'];
        }, $orders_pay);

        $order_summ = [];
        $orderItems = OrderItem::find()
            ->where(['order_id' => $orders_id])
            ->all();

        foreach ($orderItems as $orderItem) {
            $items = $orderItem->order->orderItems;
            foreach ($items as $item) {
                $order_summ[] = $item->price * $item->quantity;
            }
        }
        $average_cost = array_sum($order_summ) / count($order_summ);

        $currentDate = new DateTime();
        $interval = new DateInterval('P1M');
        $oneMonthAgo = $currentDate->sub($interval);
        $months = [
            1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель',
            5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август',
            9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь',
        ];
        $monthNumber = $oneMonthAgo->format('n');
        $year = $oneMonthAgo->format('Y');
        $monthName = $months[$monthNumber];
        $formattedDate = $monthName . ' ' . $year;

        return $this->render('average-order', [
            'average_cost' => $average_cost,
            'formattedDate' => $formattedDate
        ]);
    }


}