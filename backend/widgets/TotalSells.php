<?php


namespace backend\widgets;

use common\models\shop\Order;
use common\models\shop\OrderItem;
use DateInterval;
use DateTime;
use yii\base\Widget;
use yii\db\Expression;

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


        $startOfMonth = strtotime('first day of this month');
        $endOfMonth = strtotime('last day of this month 23:59:59');

        // Выполняем запрос к базе данных для извлечения данных за текущий месяц
        $data = Order::find()
            ->where(['between', 'created_at', $startOfMonth, $endOfMonth])
            ->all();

//        exit('<pre>'.print_r($data,true).'</pre>');

        return $this->render('total-sells', [
            'summ' => $summ,
            'formattedDate' => $formattedDate
        ]);
    }


}