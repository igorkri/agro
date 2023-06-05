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
        $result = [];
        $tags = Tag::find()->all();
        foreach ($tags as $tag) {
            if ($tag->getProductTag($tag->id) != 0) {
                $result[] = $tag;
            }
        }
        $tags = $result;
        return $this->render('tag-cloud', ['tags' => $tags]);

    }


}
