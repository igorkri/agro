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
        $type = 'website';
        $title = $seo->title;
        $description = $seo->description;
        $image = '';
        $keywords = '';
        Settings::setMetamaster($type, $title, $description, $image, $keywords);

        return $this->render('view',
            [
                'model' => $model,
                'page_description' => $seo->page_description,
            ]);

    }

}