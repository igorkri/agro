<?php


namespace backend\widgets;


class RecentActivity extends \yii\base\Widget
{
    public function init() {

        parent::init();

    }

    public function run() {

        return $this->render('recent-activity');
    }

}