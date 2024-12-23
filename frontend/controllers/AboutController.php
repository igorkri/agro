<?php

namespace frontend\controllers;

use common\models\About;
use common\models\Settings;
use yii\web\Controller;

class AboutController extends Controller
{

    public function actionView()
    {

        $model = About::find()->one();

        $seo = Settings::seoPageTranslate('about');
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