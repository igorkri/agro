<?php

namespace backend\controllers;

use common\models\shop\Product;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class SearchController extends Controller
{
    public function actionAjaxSearch($search)
    {
        $results = Product::find()
            ->where(['like', 'name', $search])
            ->all();
        Yii::$app->response->format = Response::FORMAT_JSON;

        return $this->renderAjax('suggestions', [
            'results' => $results
        ]);

    }

}
