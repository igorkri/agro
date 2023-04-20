<?php

namespace frontend\controllers;

use common\models\Contact;
use yii\web\Controller;


class ContactController extends Controller
{
    public function actionView(): string
    {
        $contacts = Contact::find()->one();

        return $this->render('view',['contacts' => $contacts]);

    }

}
