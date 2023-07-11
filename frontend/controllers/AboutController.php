<?php


namespace frontend\controllers;


use common\models\About;
use Yii;
use yii\web\Controller;

class AboutController extends Controller
{

    public function actionView(){

        $model = About::find()->one();

        Yii::$app->metamaster
            ->setTitle('Про нас - AgroPro: Товари для сільського господарства та якісні рішення для вашого успіху')
            ->setDescription('Магазин AgroPro - експерти з гербіцидів, інсектицидів, фунгіцидів, протруйників, прилипачів, десикантів, добрив та посівного матеріалу. 
            Довіряйте нам для успіху у вирощуванні рослин. 
            Широкий вибір, швидка доставка та персоналізоване обслуговування. Дізнайтеся більше на сторінці "Про нас".')
            ->setImage('/frontend/web/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());

        return $this->render('view', ['model' => $model]);
    }

}