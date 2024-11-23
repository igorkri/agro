<?php

namespace backend\widgets;

use common\models\shop\Product;
use common\models\shop\Tag;
use kartik\base\Widget;

class TasksAdmin extends Widget
{
    public function init()
    {

        parent::init();

    }

    public function run()
    {

        $countsProduct = Product::find()->count();
        $addProducts = [
            'title' => 'Добавить товар 1000шт.',
            'descr' => 'Осталось ' . 1000 - $countsProduct,
        ];

        $countsTag = Tag::find()->count();
        $countsNotDescr = Tag::find()->where(['description' => null])->count();
        $addTagDescr = [
            'title' => 'Добавить описания тегам',
            'descr' => 'Осталось ' . $countsNotDescr . ' из ' . $countsTag,
        ];

        $tasks[] = $addProducts;
        $tasks[] = $addTagDescr;

        return $this->render('tasks-admin', [
            'tasks' => $tasks,
        ]);
    }
}
