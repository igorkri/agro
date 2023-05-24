<?php


namespace backend\widgets;


use common\models\shop\Review;

class RecentReviews extends \yii\base\Widget
{
    public function init() {

        parent::init();

    }

    public function run() {

        $reviews = Review::find()->orderBy('id DESC')->limit(6)->all();

        return $this->render('recent-reviews', ['reviews' => $reviews]);
    }

}

