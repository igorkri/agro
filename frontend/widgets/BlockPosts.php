<?php


namespace frontend\widgets;


use common\models\shop\Category;
use yii\base\Widget;

class BlockPosts extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {

        return $this->render('block-posts');
    }


}