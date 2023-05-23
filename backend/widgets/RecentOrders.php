<?php


namespace backend\widgets;


use common\models\shop\Order;

class RecentOrders extends \yii\base\Widget
{
    public function init() {

        parent::init();

    }

    public function run() {

        $orders = Order::find()->orderBy('id DESC')->limit(10)->all();

        return $this->render('recent-orders', ['orders' => $orders]);
    }

}