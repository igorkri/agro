<?php

namespace frontend\controllers;

use common\models\shop\Category;
use yii\web\Controller;


class CategoryController extends Controller
{
    public function actionList()
    {

        $categories = Category::find()->where(['is', 'parentId', new \yii\db\Expression('null')])->all();

        return $this->render('list', ['categories' => $categories]);
    }

}
