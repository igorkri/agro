<?php

namespace frontend\controllers;

use common\models\About;
use yii\web\Controller;

class AboutController extends Controller
{

    public function actionView()
    {

        $model = About::find()->one();

        $seo = $model->getSeoPage();

        $model->setMetamaster($seo);

        return $this->render('view',
            [
                'model' => $model,
                'seo' => $seo,
            ]);
    }

}