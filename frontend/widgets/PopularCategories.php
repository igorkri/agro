<?php

namespace frontend\widgets;

use common\models\shop\Category;
use yii\base\Widget;

class PopularCategories extends Widget  // Популярні Категорії
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $cat_id = [6, 7, 8, 5, 3, 24];
        $categories = Category::find()
            ->where(['id' => $cat_id])
//            ->limit(6)
            ->all();

        return $this->render('popular-categories', ['categories' => $categories]);
    }


}