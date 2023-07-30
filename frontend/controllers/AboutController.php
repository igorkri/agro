<?php


namespace frontend\controllers;


use backend\controllers\SeoPagesController;
use common\models\About;
use common\models\SeoPages;
use Yii;
use yii\web\Controller;

class AboutController extends Controller
{

    public function actionView(){

        $model = About::find()->one();
        $seo = SeoPages::find()->where(['slug' => 'about'])->one();

        Yii::$app->metamaster
            ->setTitle($seo->title)
            ->setDescription($seo->description)
            ->setImage('/frontend/web/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());

        return $this->render('view', ['model' => $model]);
    }

}