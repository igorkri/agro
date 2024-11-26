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

      $this->setMetamaster($seo);

      return $this->render('view', ['model' => $model]);

    }

    protected function setMetamaster($seo)
    {
        Yii::$app->metamaster
            ->setSiteName('AgroPro')
            ->setType('website')
            ->setTitle($seo->title)
            ->setDescription(strip_tags($seo->description))
            ->setImage('/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());
    }

}