<?php

namespace frontend\controllers;

use common\models\shop\Product;
use Yii;
use yii\base\BaseObject;
use yii\data\Pagination;
use yii\web\Controller;


class SpecialController extends Controller
{

    public function actionView()
    {

        $query = Product::find()->where(['label_id' => 2]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('view', compact(['products', 'pages']));
    }

}

