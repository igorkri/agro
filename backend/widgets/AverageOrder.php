<?php


namespace backend\widgets;

use common\models\shop\OrderItem;
use common\models\shop\Order;
use yii\base\Widget;

class AverageOrder extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $order_summ = [];
        $orderItems = OrderItem::find()->all();

        foreach ($orderItems as $orderItem) {
            $items = $orderItem->order->orderItems;
            foreach ($items as $item) {
                $order_summ[] = $item->price * $item->quantity;
            }
        }
        $average_cost = array_sum($order_summ) / count($order_summ);

        return $this->render('average-order', ['average_cost' => $average_cost]);
    }


}