<?php

namespace frontend\controllers;

use common\models\About;
use common\models\SeoPages;
use Spatie\SchemaOrg\Schema;
use Yii;
use yii\web\Controller;

class AboutController extends Controller
{

    public function actionView(){

        $model = About::find()->one();
        $seo = SeoPages::find()->where(['slug' => 'about'])->one();

        $organization = Schema::organization()
            ->name('AgroPro')
            ->address([
                "@type" => "PostalAddress",
                "streetAddress" => 'Україна Полтава вул.Зіньківська 35',
                "postalCode" => '36000',
                "addressCountry" => 'Україна'
            ])
            ->telephone('+3(066)394-18-28')
            ->image(Yii::$app->request->hostInfo . '/images/logos/meta_logo.jpg')
            ->url('https://agropro.org.ua/')
            ->logo(Yii::$app->request->hostInfo . '/images/logos/logoagro.jpg');
        Yii::$app->params['organization'] = $organization->toScript();

        Yii::$app->metamaster
            ->setTitle($seo->title)
            ->setDescription($seo->description)
            ->setImage('/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());

        return $this->render('view', ['model' => $model]);
    }

}