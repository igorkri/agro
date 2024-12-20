<?php

namespace backend\widgets;

use app\widgets\BaseWidgetBackend;
use common\models\shop\OrderItem;
use common\models\shop\Order;

class AverageOrder extends BaseWidgetBackend
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

        $formattedDate = $this->getPreviousMonthFormatted();

        return $this->render('average-order', [
            'average_cost' => $average_cost,
            'formattedDate' => $formattedDate
        ]);
    }


}