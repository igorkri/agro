<?php


namespace frontend\widgets;

use common\models\Posts;
use yii\base\Widget;

class BlockPosts extends Widget  // Статті на головній
{
    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $posts = Posts::find()
            ->limit(6)
            ->orderBy('date_public DESC')
            ->all();

        return $this->render('block-posts-4', ['posts' => $posts]);
    }


}