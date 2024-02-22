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
        $result = [];
        $uniqueUrls = [];

        $pages = ActivePages::find()->where(['like', 'url_page', '/product/'])->all();

        foreach ($pages as $page) {
            $url = $page->url_page;
            $date = $page->date_visit;

            if (!in_array($url, $uniqueUrls)) {
                $uniqueUrls[] = $url;
                $result[] = [
                    'url' => str_replace('/product/', '', $url),
                    'date' => $date,
                ];
            } else {
                $existingIndex = array_search($url, array_column($result, 'url'));
                if ($date > $result[$existingIndex]['date']) {
                    $result[$existingIndex]['date'] = $date;
                }
            }
        }

        ArrayHelper::multisort($result, ['date'], [SORT_DESC]);

        return $this->render('recent-activity', ['result' => $result]);
    }
}