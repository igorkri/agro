<?php

namespace backend\widgets;

use common\models\shop\ActivePages;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class RecentActivity extends Widget
{
    public function init()
    {

        parent::init();

    }

    public function run()
    {
        $pages = ActivePages::find()->all();
        $uniqueUrls = [];
        $result = [];

        foreach ($pages as $page) {
            $url = $page->url_page;
            $date = $page->date_visit;

            if (strpos($url, '/product/') !== false) {
                $url = str_replace(['/en/', '/ru/'], '/', $url);

                if (isset($uniqueUrls[$url])) {
                    if ($date > $uniqueUrls[$url]['date']) {
                        $uniqueUrls[$url]['date'] = $date;
                    }
                } else {
                    $uniqueUrls[$url] = [
                        'url' => $url,
                        'date' => $date,
                    ];
                }
            }
        }

        foreach ($uniqueUrls as $url => $data) {
            $updatedUrl = str_replace('/product/', '', $data['url']);
            $data['url'] = $updatedUrl;
            $result[] = $data;
        }

        ArrayHelper::multisort($result, ['date'], [SORT_DESC]);

        return $this->render('recent-activity', ['result' => $result]);
    }

}