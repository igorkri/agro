<?php

namespace frontend\controllers;

use common\models\SeoPages;
use common\models\shop\Product;
use Yii;
use yii\base\BaseObject;
use yii\data\Pagination;
use yii\web\Controller;


class SpecialController extends Controller
{

    public function actionView()
    {
         $seo = SeoPages::find()->where(['slug' => 'special'])->one();

        Yii::$app->metamaster
            ->setTitle($seo->title)
            ->setDescription($seo->description)
            ->setImage('/frontend/web/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());

      //  $query = Product::find()->where(['label_id' => 2]);
        $query = Product::find()->andWhere(['not', ['label_id' => null]]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

        return $this->render('view', compact(['products', 'products_all', 'pages']));
    }

}

