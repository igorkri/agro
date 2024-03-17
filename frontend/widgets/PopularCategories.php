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
        $cat_id = [6, 7, 8, 5, 3, 9];
        $categories = Category::find()
            ->where(['id' => $cat_id])
            ->andWhere(['visibility' => 1])
//            ->limit(6)
            ->all();

        return $this->render('popular-categories', ['categories' => $categories]);
    }


}