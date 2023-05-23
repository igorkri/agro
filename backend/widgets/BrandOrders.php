<?php


namespace backend\widgets;


class BrandOrders extends \yii\base\Widget
{
    public function init() {

        parent::init();

    }

    public function run() {

        return $this->render('brand-orders');
    }

}

