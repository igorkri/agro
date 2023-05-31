<?php


namespace frontend\widgets;

use common\models\Slider;
use yii\base\Widget;

class BlockSlideshow extends Widget  // Головний слайдер
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $slides = Slider::find()
            ->where(['visible' => 1])
            ->all();

        return $this->render('block-slideshow', ['slides' => $slides]);
    }


}