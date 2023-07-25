<?php


namespace frontend\widgets;

use common\models\shop\Tag;
use yii\base\Widget;
use yii\db\Expression;

class TagCloud extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $result = [];
        $tags = Tag::find()
            ->orderBy(new Expression('RAND()'))
            ->all();

        foreach ($tags as $tag) {
            if ($tag->getProductTag($tag->id) != 0) {
                $result[] = $tag;
            }
        }
        $tags = $result;
        return $this->render('tag-cloud', ['tags' => $tags]);

    }


}
