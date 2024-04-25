<?php

namespace frontend\widgets;

use common\models\Posts;
use Yii;
use yii\base\Widget;
use yii\caching\DbDependency;

class BlockPosts extends Widget  // Статті на головній
{
    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $cacheKey = 'posts_cache_key';
        $dependency = new DbDependency([
            'sql' => 'SELECT MAX(date_updated) FROM posts',
        ]);

        $posts = Yii::$app->cache->get($cacheKey);

        if ($posts === false || !Yii::$app->cache->get($cacheKey . '_db')) {
            $posts = Posts::find()
                ->limit(6)
                ->orderBy('date_public DESC')
                ->all();

            Yii::$app->cache->set($cacheKey, $posts, 3600, $dependency);
            Yii::$app->cache->set($cacheKey . '_db', true, 0, $dependency);
        }

        return $this->render('block-posts-4', ['posts' => $posts]);
    }
}