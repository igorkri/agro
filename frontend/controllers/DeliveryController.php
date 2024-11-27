<?php

namespace frontend\controllers;

use common\models\Delivery;

use yii\web\Controller;

class DeliveryController extends Controller
{

    public function actionView()
    {

        $model = Delivery::find()->one();

        $seo = $model->getSeoPage();

        $model->setMetamaster($seo);

        return $this->render('view', ['model' => $model]);

    }

}