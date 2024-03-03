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
            ->orderBy(['date_visit' => SORT_ASC])
            ->all();

        $carts = [];
        foreach ($users as $user) {
            $carts[] = [
                "label" => date('M', $user->date_visit),
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
