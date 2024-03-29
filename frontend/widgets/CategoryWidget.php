<?php


namespace frontend\widgets;

use common\models\shop\Category;
use yii\base\Widget;
use yii\db\Expression;

class CategoryWidget extends Widget
{


    public function run(){

        $categories = Category::find()->select('id, parentId, slug, file, name, visibility, svg')
            ->with(['parents', 'parent', 'products'])
            ->where(['is', 'parentId', new Expression('null')])
            ->andWhere(['visibility' => 1])
//            ->orderBy('name ASC')
//            ->asArray()
            ->all();

        return $this->render('category-widget', ['categories' => $categories]);

    }

}