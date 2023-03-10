<?php

namespace frontend\controllers;

use common\models\shop\Category;
use common\models\shop\Product;
use yii\data\Pagination;
use yii\web\Controller;


class CategoryController extends Controller
{
    public function actionList()
    {

        $categories = Category::find()->with(['products'])->where(['is', 'parentId', new \yii\db\Expression('null')])->all();

        return $this->render('list', ['categories' => $categories]);
    }

    public function actionChildren($slug)
    {

        $category = Category::find()
            ->with(['parents', 'parent', 'products'])
            ->where(['slug' => $slug])->one();

//        debug($category->products);
//        die;

        return $this->render('children', ['category' => $category]);

    }

    public function actionCatalog($slug)
    {
        $category = Category::find()->where(['slug' => $slug])->one();
        $query = Product::find()->where(['category_id' => $category->id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
//        debug($products);
//        die;

        return $this->render('catalog', compact(['products', 'category', 'pages']));
    }

}
