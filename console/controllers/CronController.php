<?php

namespace console\controllers;

use common\models\IpBot;
use common\models\NpCity;
use common\models\NpWarehouses;
use common\models\shop\ActivePages;
use LisDev\Delivery\NovaPoshtaApi2;
use yii\console\Controller;

class CronController extends Controller
{
    /**
     * <<<<<<<< Cron задача для удаления Ip роботов
     * @throws \yii\db\Exception
     */
    public function actionDetectIpRobots()
    {
        $ips = ActivePages::find()
            ->select(['ip_user', 'date_visit'])
            ->orderBy('date_visit DESC')
            ->limit(100)
            ->asArray()
            ->all();

        $ips = array_map(function ($item) {
            unset($item['date_visit']);
            return $item;
        }, $ips);

        $ips = array_unique(array_map('serialize', $ips));
        $ips = array_map('unserialize', array_values($ips));

        $countIps = count($ips);

        $robotProviders = IpBot::find()->select('isp')->distinct()->column();
        $robotIp = IpBot::find()->select('ip')->distinct()->column();

        $i = 1;
        $ipDelete = [];

        foreach ($ips as $ip) {
            $ip = $ip['ip_user'];
            $url = "http://ip-api.com/json/{$ip}";
            $response = $this->getIpInfoFromApi($url);

            if ($response && $response['status'] === 'success') {
                $isRobot = false;
                foreach ($robotProviders as $provider) {
                    if (str_contains($response['isp'], $provider)) {
                        $isRobot = true;
                        echo "$countIps\t$ip\t\tRobot\t\t{$response['isp']}\n";

                        if (!in_array($ip, $robotIp)) {
                            $model = new IpBot();
                            $model->ip = $ip;
                            if (isset($response['isp'])) {
                                $model->isp = $response['isp'];
                            } else {
                                $model->isp = 'Not information';
                            }
                            $model->save();
                        }
                        sleep(2);
                        $ipDelete[] = $ip;
                        $i++;
                        break;
                    }
                }

                if (!$isRobot) {
                    if (strlen($ip) == 14) {
                        $ip .= ' ';
                    }elseif (strlen($ip) == 13){
                        $ip .= '  ';
                    }elseif (strlen($ip) == 12){
                        $ip .= '   ';
                    }elseif (strlen($ip) == 11){
                        $ip .= '    ';
                    }elseif (strlen($ip) == 10){
                        $ip .= '     ';
                    }
                    if (strlen($countIps) == 1){
                    echo "$countIps  \t$ip\t\tNot Robot.\t{$response['isp']}\n";
                    }else{
                        echo "$countIps\t$ip\t\tNot Robot.\t{$response['isp']}\n";
                    }
                }
            } else {
                echo "$ip: Error retrieving information.\n";
            }

            sleep(2);
            $countIps--;
        }
        if ($ipDelete) {
            echo "=======================================\n";
            $this->getIpDelete($ipDelete);
            echo "=======================================\n";
        }
    }

    /**
     * Метод для отправки запроса к API и получения данных
     */
    private function getIpInfoFromApi($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $output = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return null;
        }

        curl_close($ch);

        return json_decode($output, true);
    }

    /**
     * Метод для удаления Ip из базы данных
     */
    private function getIpDelete($ipDelete)
    {
        $ips = ActivePages::find()->where(['ip_user' => $ipDelete])->all();
        foreach ($ips as $ip) {
            if ($ip->delete()) {
                echo "\t{$ip->ip_user}\tRemoved from database\n";
            } else {
                echo "\t{$ip->ip_user}\tFailed to delete from database\n";
            }
        }
    }


    /**
     * Обновление отделений Новой Почты
     */
    const KEY = 'f1c1e7b2520a9fa092bb1afa0e7bc514';

    /**
     * Добавленрие отделений НП
     */
    public function actionWarehouses()
    {
        $np = new NovaPoshtaApi2(
            self::KEY,
            'ua', // Язык возвращаемых данных: ru (default) | ua | en
            FALSE, // При ошибке в запросе выбрасывать Exception: FALSE (default) | TRUE
            'file_get_content' // Используемый механизм запроса: curl (default) | file_get_content
        );

        $cities = NpCity::find()->select('ref')->column();

        if ($cities) {
            $i = 1;
            $n = 1;
            $j = 1;

            foreach ($cities as $city) {
                $nameCity = NpCity::find()->where(['ref' => $city])->one();
                echo "\t" . "|#----->> " . '' . " | " . $nameCity->description . "\n";
                if ($j >= 1) {
                    $warehouses = $np->getWarehouses($city);
                    if (!empty($warehouses)) {
                        if ($warehouses['data'] != null) {
                            foreach ($warehouses['data'] as $warehouse) {
                                $model = NpWarehouses::find()->where(['ref' => $warehouse['Ref']])->one();
                                if (!$model) {
                                    $warehouses_db = new NpWarehouses();
                                    $warehouses_db->description = $warehouse['Description'];
                                    $warehouses_db->ref = $warehouse['Ref'];
                                    $warehouses_db->Number = $warehouse['Number'];
                                    $warehouses_db->cityRef = $warehouse['CityRef'];
                                    $warehouses_db->shortAddress = $warehouse['ShortAddress'];
                                    if ($warehouses_db->save(false)) {
                                        echo "\t" . "|# " . $i . " | " . $warehouses_db->description . "\n";
                                        echo "\r+--------------------------------------------------------------------------------------------------------+\n";
                                        $i++;
                                    } else {
                                        print_r($warehouses_db->errors);
                                    }
                                } else {
                                    echo "\t" . "|- " . $n . " | " . $model->description . " Сущесвует\n";
                                    echo "\r+--------------------------------------------------------------------------------------------------------+\n";
                                    $n++;
                                }
                            }
                        }
                    } else {
                        echo PHP_EOL . 'error warehouses' . PHP_EOL;
                        print_r($warehouses);
                        echo PHP_EOL . 'error city' . PHP_EOL;
                        print_r($city);
                    }
                }
                $j++;
            }
        }
    }

}