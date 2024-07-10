<?php

namespace frontend\controllers;

use common\models\About;
use common\models\SeoPages;
use Yii;
use yii\web\Controller;

class AboutController extends Controller
{

    public function actionView()
    {

        $model = About::find()->one();
        $seo = SeoPages::find()->where(['slug' => 'about'])->one();

        $this->setMetamaster($seo);

        return $this->render('view', ['model' => $model]);
    }

    protected function setMetamaster($seo)
    {
        Yii::$app->metamaster
            ->setSiteName('AgroPro')
            ->setType('website')
            ->setTitle($seo->title)
            ->setDescription($seo->description)
            ->setImage('/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());
    }

}