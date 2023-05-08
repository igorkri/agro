<?php


namespace frontend\widgets;


use common\models\Posts;
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

        $posts = Posts::find()->all();
        return $this->render('block-posts-4', ['posts' => $posts]);
    }


}