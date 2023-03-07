<?php

namespace frontend\controllers;

use yii\web\Controller;
//use common\models\shop\Product;

class AboutController extends Controller
{
    public function actionAbout(): string
    {

        return $this->render('about');

    }

}