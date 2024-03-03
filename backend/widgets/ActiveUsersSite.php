<?php

namespace backend\widgets;

use common\models\shop\ActivePages;
use yii\base\Widget;

class ActiveUsersSite extends Widget
{
    public function init()
    {

        parent::init();

    }

    public function run()
    {
        $users = ActivePages::find()
            ->select('date_visit')
            ->orderBy(['date_visit' => SORT_ASC])
            ->all();

        $carts = [];
        $ukrainian_months = [
            'Jan' => 'Січ', 'Feb' => 'Лют', 'Mar' => 'Бер',
            'Apr' => 'Кві', 'May' => 'Тра', 'Jun' => 'Чер',
            'Jul' => 'Лип', 'Aug' => 'Сер', 'Sep' => 'Вер',
            'Oct' => 'Жов', 'Nov' => 'Лис', 'Dec' => 'Гру'
        ];

        foreach ($users as $user) {
            $month_name = date('M', $user->date_visit);
            $ukrainian_month_name = $ukrainian_months[$month_name] ?? '';
            $carts[] = [
                "label" => $ukrainian_month_name,
                "value" => 1,
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

        return $this->render('active-users-site', ['resultArray' => json_encode($resultArray)]);
    }
}
