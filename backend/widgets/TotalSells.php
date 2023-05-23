<?php


namespace backend\widgets;

use common\models\shop\OrderItem;
use yii\base\Widget;

class TotalSells extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run() {

        $summ = [];
        $orders = OrderItem::find()->all();
        foreach ($orders as $order) {
            $summ[] = $order->price * $order->quantity;
        }
        $summ = array_sum($summ);

        return $this->render('total-sells', ['summ' => $summ]);
    }


}