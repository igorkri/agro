<?php

namespace frontend\controllers;

use common\models\Delivery;
use common\models\SeoPages;
use Yii;
use yii\web\Controller;

class DeliveryController extends Controller
{

    public function actionView()
    {
      $seo = SeoPages::find()->where(['slug' => 'delivery'])->one();
      $model = Delivery::find()->one();

        Yii::$app->metamaster
            ->setTitle($seo->title)
            ->setDescription($seo->description)
            ->setImage('/frontend/web/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());

      return $this->render('view', ['model' => $model]);

    }

}