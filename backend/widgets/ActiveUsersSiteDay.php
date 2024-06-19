<?php

namespace backend\widgets;

use common\models\shop\ActivePages;
use yii\base\Widget;

class ActiveUsersSiteDay extends Widget
{
    public function init()
    {

        parent::init();

    }

    public function run()
    {
        $timestampFrom = time() - (30 * 24 * 60 * 60);

        $users = ActivePages::find()
            ->select('date_visit')
            ->where(['>=', 'date_visit', $timestampFrom])
            ->orderBy(['date_visit' => SORT_ASC])
            ->asArray()
            ->all();

        $carts = [];
        $ukrainian_months = [
            'Jan' => 'Січ', 'Feb' => 'Лют', 'Mar' => 'Бер',
            'Apr' => 'Кві', 'May' => 'Тра', 'Jun' => 'Чер',
            'Jul' => 'Лип', 'Aug' => 'Сер', 'Sep' => 'Вер',
            'Oct' => 'Жов', 'Nov' => 'Лис', 'Dec' => 'Гру'
        ];

        foreach ($users as $user) {
            $month_name = date('M', $user['date_visit']);
            $day = date('j', $user['date_visit']); // 'j' для числового дня месяца без ведущих нулей
            $ukrainian_month_name = $ukrainian_months[$month_name] ?? '';
            $carts[] = [
                'label' => $day . ' ' . $ukrainian_month_name,
                'value' => 1,
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

        return $this->render('active-users-site-day', ['resultArray' => json_encode($resultArray)]);
    }
}
