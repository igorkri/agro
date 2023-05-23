<?php


namespace backend\widgets;


class IncomeStatistics extends \yii\base\Widget
{
    public function init() {

        parent::init();

    }

    public function run() {

        return $this->render('income-statistics');
    }

}