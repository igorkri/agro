<?php


namespace frontend\widgets;

use common\models\shop\Tag;
use yii\base\Widget;

class TagCloud extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $tags = Tag::find()->all();
        return $this->render('tag-cloud', ['tags' => $tags]);

    }


}
