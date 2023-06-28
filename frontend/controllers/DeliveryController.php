<?php

namespace frontend\controllers;

use common\models\Delivery;
use Yii;
use yii\web\Controller;

class DeliveryController extends Controller
{

    public function actionView()
    {
      $model = Delivery::find()->one();

        Yii::$app->metamaster
            ->setTitle('Умови доставки в інтернет-магазині AgroPro')
            ->setDescription('Дізнайтеся про умови доставки в інтернет-магазині AgroPro. 
            Отримайте інформацію про доступні способи доставки, географічне охоплення, терміни та вартість доставки. 
            Замовляйте засоби для захисту, росту, живлення сільськогосподарських культур від AgroPro з комфортом та впевненістю.')
            ->setImage('/frontend/web/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());

      return $this->render('view', ['model' => $model]);

    }

}