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
        Yii::$app->metamaster
            ->setTitle('Спеціальні пропозиції - Акції, Розпродажі, Оптові Ціни та Новинки - AgroPro')
            ->setDescription('Купуйте гербіциди, інсектициди, фунгіциди, протруйники, прилипачі, десиканти, добрива та посівний матеріал за найкращими пропозиціями в AgroPro.
             Вигідні акції на товари для росту, захисту та врожайності.
             Вибирайте з широкого асортименту продуктів за привабливими цінами. 
             Замовляйте сьогодні та скористайтеся вигодами!')
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

