<?php


namespace backend\widgets;

use common\models\shop\Order;
use DateInterval;
use DateTime;
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

        return $this->render('total-orders', [
            'total_orders' => $total_orders,
            'formattedDate' => $formattedDate
        ]);
    }


}
