<?php

namespace console\controllers;

use common\models\shop\ActivePages;
use yii\console\Controller;

class DevicesController extends Controller
{
    /**
     * Добавление девайса в базу в поле other
     */
    public function actionDeviceDetect()
    {
        // mobile
//        $device = 'Android';

//        $device = 'iPhone OS 16_5';
//        $device = 'iPhone OS 14_8_1';


        //desktop
//        $device = 'Windows NT';

//        $device = 'Mac OS X 10_15_6';
        $device = 'Linux x86_64';


        $agents = ActivePages::find()->all();
        foreach ($agents as $agent){
        if ($agent->other === null){
            if (strpos($agent->user_agent, $device) !== false){
//                $agent->other = 'mobile';
                $agent->other = 'desktop';
                $agent->save();
            }
        }

        }
    }
}