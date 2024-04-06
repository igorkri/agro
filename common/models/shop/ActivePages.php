<?php

namespace common\models\shop;

use Yii;

/**
 * This is the model class for table "active_pages".
 *
 * @property int $id
 * @property string|null $ip_user IP пользователя
 * @property string|null $url_page Страница
 * @property string|null $user_agent User agent
 * @property string|null $client_from Откуда пользователь
 * @property string|null $date_visit Дата визита
 * @property string|null $status_serv Статус сервера
 * @property string|null $other Прочее
 */
class ActivePages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'active_pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip_user', 'url_page', 'user_agent', 'client_from', 'date_visit', 'status_serv', 'other'], 'string', 'max' => 455],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ip_user' => Yii::t('app', 'IP пользователя'),
            'url_page' => Yii::t('app', 'Страница'),
            'user_agent' => Yii::t('app', 'User agent'),
            'client_from' => Yii::t('app', 'Откуда пользователь'),
            'date_visit' => Yii::t('app', 'Дата визита'),
            'status_serv' => Yii::t('app', 'Статус сервера'),
            'other' => Yii::t('app', 'Девайс'),
        ];
    }

    public static function setActiveUser()
    {

        $botAgents = [          // Агенты которые не пишутся в статистику
            '*',
        ];

        $botIps = [          // Ip которые не пишутся в статистику
            '*',
        ];

        $server = $_SERVER;
        $userAgent = $server['HTTP_USER_AGENT'] ?? "Не известно";

        foreach ($botAgents as $botAgent) {
            if (strpos($userAgent, $botAgent) !== false) {

                return;
            }
        }

        $clientFrom = $server['HTTP_REFERER'] ?? "Не известно";
        $parts = explode('&', $clientFrom);
        $clientFrom = $parts[0];

        $userIp = $server['REMOTE_ADDR'] ?? "Не известно";
        foreach ($botIps as $botIp) {
            if ($userIp === $botIp) {

                return;
            }
        }

        if (Yii::$app->devicedetect->isMobile()) {
            $device = 'mobile';
        } else {
            $device = 'desktop';
        }

        $model = new ActivePages();
        $model->ip_user = $server['REMOTE_ADDR'] ?? "Не известно";
        $model->url_page = $server['REQUEST_URI'] ?? "Не известно";
        $model->user_agent = $userAgent;
        $model->client_from = $clientFrom;
        $model->date_visit = strval($server['REQUEST_TIME']) ?? "Не известно";
        $model->status_serv = strval(Yii::$app->response->statusCode) ?? "Не известно";
        $model->other = $device ?? "Не известно";

        if ($model->save()) {
        } else {
            exit('<pre>' . print_r($model->errors, true) . '</pre>');
        }
    }


    public
    static function countViewsPage($url)
    {
        $res = [];
        if ($url == '/') {
            $pages = ActivePages::find()
                ->where(['url_page' => $url])
                ->asArray()
                ->all();
            foreach ($pages as $page) {
                $res[] = $page['url_page'];
            }
        } else {
            $pages = ActivePages::find()
                ->where(['like', 'url_page', '%' . $url . '%', false])
                ->asArray()
                ->all();
            foreach ($pages as $page) {
                $res[] = $page['url_page'];
            }
        }
        return count($res);
    }

    public
    static function productCountViews($url)
    {
        $res = [];
        $pages = ActivePages::find()
            ->where(['like', 'url_page', '%' . $url . '%', false])
            ->asArray()
            ->all();
        foreach ($pages as $page) {
            $res[] = $page['url_page'];
        }
        return count($res);
    }

    public
    static function countIpUsers()
    {
        $res = [];
        $pages = ActivePages::find()
            ->asArray()
            ->all();
        foreach ($pages as $page) {
            $res[] = $page['ip_user'];
        }
        $res = array_unique($res);

        return count($res);
    }
}
