<?php

namespace backend\widgets;

use common\models\shop\Review;
use Yii;
use yii\base\Widget;
use yii\caching\DbDependency;

class RecentReviews extends Widget
{
    public function init() {

        parent::init();

    }

    public function run() {

        $cacheKey = 'recent_activity_widget_cache_key';
        $reviews = Yii::$app->cache->get($cacheKey);

        if ($reviews === false) {
            $reviews = Review::find()->orderBy('id DESC')->limit(10)->all();

            Yii::$app->cache->set($cacheKey, $reviews, 2592000, new DbDependency([
                'sql' => 'SELECT COUNT(*) FROM review',
            ]));
        }

        return $this->render('recent-reviews', ['reviews' => $reviews]);
    }
}

