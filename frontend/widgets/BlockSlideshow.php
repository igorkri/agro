<?php


namespace frontend\widgets;

use common\models\Slider;
use yii\base\Widget;

class BlockSlideshow extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $slides = Slider::find()->all();
        return $this->render('block-slideshow', ['slides' => $slides]);
    }


}