<?php

namespace frontend\controllers;

use yii\web\Controller;
//use common\models\shop\Product;

class ContactController extends Controller
{
    public function actionContact(): string
    {

        return $this->render('contact');

    }

}
