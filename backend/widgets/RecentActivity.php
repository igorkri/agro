<?php

namespace backend\widgets;

use common\models\shop\ActivePages;
use yii\helpers\ArrayHelper;

class RecentActivity extends \yii\base\Widget
{
    public function init()
    {

        parent::init();

    }

    public function run()
    {
        $url = [];
        $pages = ActivePages::find()->all();

        foreach ($pages as $page) {
            $url[] = [
                'url' => $page->url_page,
                'date' => $page->date_visit,
            ];
        }

        $uniqueUrls = [];
        $result = [];
        foreach ($url as $item) {
            $url = $item['url'];
            $date = $item['date'];
            if (strpos($url, '/product/') !== false) {
                if (in_array($url, $uniqueUrls)) {
                    $existingIndex = array_search($url, $uniqueUrls);
                    if ($date > $result[$existingIndex]['date']) {
                        $result[$existingIndex] = $item;
                    }
                } else {
                    $uniqueUrls[] = $url;
                    $result[] = $item;
                }
            }
        }
        foreach ($result as $key => $item) {
            $updatedUrl = str_replace('/product/', '', $item['url']);
            $result[$key]['url'] = $updatedUrl;
        }

        ArrayHelper::multisort($result, ['date'], [SORT_DESC]);

        return $this->render('recent-activity', ['result' => $result]);
    }
}