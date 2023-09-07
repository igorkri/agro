<?php

namespace backend\widgets;

use common\models\shop\Order;
use common\models\shop\OrderItem;
use DateInterval;
use DateTime;
use yii\base\Widget;

class TotalSells extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {

        $summ = [];
        $orders = OrderItem::find()->all();
        foreach ($orders as $order) {
            $summ[] = $order->price * $order->quantity;
        }
        $summ = array_sum($summ);

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

        $DaysAgo30 = strtotime('-30 days');
        $orders = Order::find()
            ->select('id')
            ->andWhere(['>=', 'created_at', $DaysAgo30])
            ->asArray()
            ->all();
        $res_30 = [];
        foreach ($orders as $order) {
            $prices = OrderItem::find()->where(['order_id' => $order['id']])->all();
            foreach ($prices as $price) {
                $res_30[] = $price->price * $price->quantity;
            }
        }
        $res_30 = array_sum($res_30);


        $DaysAgo60 = strtotime('-60 days');
        $orders = Order::find()
            ->select('id')
            ->andWhere(['>=', 'created_at', $DaysAgo60])
            ->asArray()
            ->all();
        $res_60 = [];
        foreach ($orders as $order) {
            $prices = OrderItem::find()->where(['order_id' => $order['id']])->all();
            foreach ($prices as $price) {
                $res_60[] = $price->price * $price->quantity;
            }
        }
        $res_60 = array_sum($res_60);
        $res_60 = $res_60 - $res_30;

        $arrow = '';
        if ($res_30 > $res_60){
            $arrow = 'up';
        }else{
            $arrow = 'down';
        }


        $percentage = (($res_60 - $res_30) / $res_30) * 100;
        $percentage = abs(round($percentage));


//        exit('<pre>' . print_r($percentage, true) . '</pre>');


        return $this->render('total-sells', [
            'summ' => $summ,
            'formattedDate' => $formattedDate,
            'arrow' => $arrow,
            'percentage' => $percentage,
        ]);
    }


}