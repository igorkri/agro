<?php

namespace console\controllers;

use common\models\shop\ActivePages;
use Yii;
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
        foreach ($agents as $agent) {
            if ($agent->other === null) {
                if (strpos($agent->user_agent, $device) !== false) {
//                $agent->other = 'mobile';
                    $agent->other = 'desktop';
                    $agent->save();
                }
            }

        }
    }

    public function actionDetectRobotsIp()
    {
        $i = 1;
        $ips = ActivePages::find()->select('ip_user')->distinct()->column();
        $countIps = count($ips);
        $item = $countIps - 0;
        usort($ips, function ($a, $b) {
            return strlen($a) - strlen($b);
        });
        foreach ($ips as $ip) {
            if ($countIps <= $item) {
                $url = "http://ip-api.com/json/{$ip}";
                $response = $this->getIpInfoFromApi($url);
                // Проверяем успешность ответа
                if ($response && $response['status'] === 'success') {
                    $org = $response['isp'];

                    if (isset($response['isp']) && strpos(strtolower($response['isp']), 'google') !== false) {
                        echo "$countIps\t\033[0;31m$ip\tRobot\t$org\033[0m\n"; // Reset color after the message
                        $dir = Yii::getAlias('@frontend/runtime/robots_control.txt');
                        $res = print_r("$i\t$ip\tRobot\t$org\n", true);
                        file_put_contents($dir, $res, FILE_APPEND);
                        $i++;
                    }

                    elseif (isset($response['isp']) && strpos(strtolower($response['isp']), 'Hetzner Online GmbH') !== false) {
                        echo "$countIps\t\033[0;31m$ip\tRobot\t$org\033[0m\n"; // Reset color after the message
                        $dir = Yii::getAlias('@frontend/runtime/robots_control.txt');
                        $res = print_r("$i\t$ip\tRobot\t$org\n", true);
                        file_put_contents($dir, $res, FILE_APPEND);
                        $i++;
                    }

                    elseif (isset($response['isp']) && strpos(strtolower($response['isp']), 'Huawei International Pte. Ltd.') !== false) {
                        echo "$countIps\t\033[0;31m$ip\tRobot\t$org\033[0m\n"; // Reset color after the message
                        $dir = Yii::getAlias('@frontend/runtime/robots_control.txt');
                        $res = print_r("$i\t$ip\tRobot\t$org\n", true);
                        file_put_contents($dir, $res, FILE_APPEND);
                        $i++;
                    }

                    elseif (isset($response['isp']) && strpos(strtolower($response['isp']), 'DigitalOcean, LLC') !== false) {
                        echo "$countIps\t\033[0;31m$ip\tRobot\t$org\033[0m\n"; // Reset color after the message
                        $dir = Yii::getAlias('@frontend/runtime/robots_control.txt');
                        $res = print_r("$i\t$ip\tRobot\t$org\n", true);
                        file_put_contents($dir, $res, FILE_APPEND);
                        $i++;
                    }

                    else {
                        // Output in green for non-robot
                        echo "$countIps\t\033[0;32m$ip\tNot Robot.\t$org\033[0m\n"; // Reset color after the message
                    }
                } else {
                    echo "$ip: Error retrieving information.\n";
                }
                sleep(2);
            }
            $countIps--;
        }
    }

    /**
     * Метод для отправки запроса к API и получения данных
     */
    private function getIpInfoFromApi($url)
    {
        // Инициализация curl
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Возвращаем результат в виде строки
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Таймаут запроса

        // Выполняем запрос
        $output = curl_exec($ch);

        // Проверка на наличие ошибок
        if (curl_errno($ch)) {
            curl_close($ch);
            return null;
        }

        // Закрываем соединение
        curl_close($ch);

        // Возвращаем декодированные данные в формате массива
        return json_decode($output, true);
    }
}