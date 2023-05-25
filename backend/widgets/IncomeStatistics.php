<?php


namespace backend\widgets;


use common\models\shop\Order;

class IncomeStatistics extends \yii\base\Widget
{
    public function init()
    {

        parent::init();

    }

    public function run()
    {

        $orders = Order::find()->all();

        $carts = [];
        foreach ($orders as $order) {
            $carts[] = [
                "label" => date('M', $order->created_at),
                "value" => $order->getOrderIncomeTotal($order->id),
            ];
        }

        $resultArray = [];
        foreach ($carts as $item) {
            $label = $item['label'];
            $value = $item['value'];

            if (isset($resultArray[$label])) {
                $resultArray[$label]['value'] += $value;
            } else {
                $resultArray[$label] = [
                    'label' => $label,
                    'value' => $value,
                ];
            }
        }
        $resultArray = array_values($resultArray);

        return $this->render('income-statistics', ['resultArray' => json_encode($resultArray)]);
    }

}