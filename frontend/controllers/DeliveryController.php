<?php

namespace frontend\controllers;

use common\models\Delivery;
use common\models\Settings;
use yii\web\Controller;

class DeliveryController extends Controller
{

    public function actionView()
    {

        $model = Delivery::find()->one();

        $seo = Settings::seoPageTranslate('delivery');
        Settings::setMetamaster($seo);

        return $this->render('view',
            [
                'model' => $model,
                'page_description' => $seo->page_description,
            ]);

    }

}