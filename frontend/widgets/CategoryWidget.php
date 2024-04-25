<?php

namespace frontend\widgets;

use common\models\shop\Category;
use Yii;
use yii\base\Widget;
use yii\caching\DbDependency;
use yii\db\Expression;

class CategoryWidget extends Widget
{
    public function run()
    {
        $cacheKey = 'category_cache_key';
        $dependency = new DbDependency([
            'sql' => 'SELECT MAX(date_updated) FROM category',
        ]);

        $categories = Yii::$app->cache->get($cacheKey);

        if ($categories === false || !Yii::$app->cache->get($cacheKey . '_db')) {
            $categories = Category::find()->select('id, parentId, slug, file, name, visibility, svg')
                ->with(['parents', 'parent', 'products'])
                ->where(['is', 'parentId', new Expression('null')])
                ->andWhere(['visibility' => 1])
                ->all();

            Yii::$app->cache->set($cacheKey, $categories, 3600, $dependency);
            Yii::$app->cache->set($cacheKey . '_db', true, 0, $dependency);
        }

        return $this->render('category-widget', ['categories' => $categories]);

    }
}