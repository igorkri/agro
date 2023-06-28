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
            ->setDescription('Відкрийте для себе найкращі спеціальні пропозиції в AgroPro. 
            Знайдіть акції, розпродажі, оптові ціни та новинки на сільськогосподарські товари. 
            Отримайте вигідні пропозиції для вирощування рослин, захисту від шкідників та підвищення врожайності. 
            Вибирайте з нашого широкого асортименту продуктів за привабливими цінами. 
            Не пропустіть можливості скористатися найкращими пропозиціями для вашого сільськогосподарського бізнесу. 
            Замовляйте сьогодні та скористайтеся перевагами наших спеціальних пропозицій!')
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

