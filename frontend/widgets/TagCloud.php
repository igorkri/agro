<?php

namespace frontend\widgets;

use common\models\shop\ProductTag;
use common\models\shop\Tag;
use yii\base\Widget;
use yii\db\Expression;

class TagCloud extends Widget
{
    public $productsId;

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $result = [];
        $prod_id = $this->productsId;
        if ($prod_id) {
            $tag_id = ProductTag::find()
                ->select('tag_id')
                ->where(['product_id' => $prod_id])
                ->asArray()
                ->all();
            $tag_id = array_column($tag_id, 'tag_id');
            $tag_id = array_unique($tag_id);

            $tags = Tag::find()
                ->where(['id' => $tag_id])
                ->orderBy(new Expression('RAND()'))
                ->all();

            foreach ($tags as $tag) {
                if ($tag->getProductTag($tag->id) != 0) {
                    $result[] = $tag;
                }
            }

        } else {
            $tags = Tag::find()
                ->orderBy(new Expression('RAND()'))
                ->all();

            foreach ($tags as $tag) {
                if ($tag->getProductTag($tag->id) != 0) {
                    $result[] = $tag;
                }
            }

        }


        $tags = $result;
        return $this->render('tag-cloud', ['tags' => $tags]);

    }


}
