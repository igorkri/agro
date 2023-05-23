<?php


namespace backend\widgets;

use common\models\shop\Order;
use yii\base\Widget;

class TotalOrders extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run() {

        $orders = Order::find()->all();
        $total_orders = count($orders);

        return $this->render('total-orders', ['total_orders' => $total_orders]);
    }


}
