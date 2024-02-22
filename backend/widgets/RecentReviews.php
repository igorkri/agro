<?php

namespace backend\widgets;

use common\models\shop\Review;
use yii\base\Widget;

class RecentReviews extends Widget
{
    public function init() {

        parent::init();

    }

    public function run() {

        $reviews = Review::find()->select(['product_id', 'name', 'message', 'rating'])->orderBy('id DESC')->limit(6)->all();

        return $this->render('recent-reviews', ['reviews' => $reviews]);
    }

}

