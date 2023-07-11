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
            ->setDescription('Дізнайтеся про умови доставки гербіцидів, інсектицидів, фунгіцидів,
             протруйників, прилипачів, десикантів, добрив, посівного матеріалу та як їх купити в AgroPro. 
            Замовляйте з комфортом від професіоналів.')
            ->setImage('/frontend/web/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());

      return $this->render('view', ['model' => $model]);

    }

}