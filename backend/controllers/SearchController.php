<?php

namespace backend\controllers;

use common\models\Report;
use common\models\shop\Category;
use common\models\shop\Product;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class SearchController extends Controller
{
    public function actionAjaxSearch($search)
    {
        $categories = Category::find()
            ->where(['like', 'name', $search])
            ->all();

        $products = Product::find()
            ->where(['like', 'name', $search])
            ->all();

        $reports = Report::find()
            ->where(['like', 'fio', $search])
            ->orWhere(['like', 'tel_number', $search])
            ->all();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return $this->renderAjax('suggestions', [
            'categories' => $categories,
            'products' => $products,
            'reports' => $reports,
        ]);

    }

}
