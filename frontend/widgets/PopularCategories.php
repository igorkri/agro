<?php

namespace frontend\widgets;

use common\models\shop\Category;
use Yii;
use yii\base\Widget;

class PopularCategories extends Widget  // Популярні Категорії
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $language = Yii::$app->session->get('_language');

        $title = 'Популярні Категорії';

        $cat_id = [6, 7, 8, 5, 3, 9];
        $categories = Category::find()
            ->where(['id' => $cat_id])
            ->andWhere(['visibility' => 1])
            ->all();


        return $this->render('popular-categories',
            [
                'categories' => $categories,
                'language' => $language,
                'title' => $title,
            ]);
    }


}