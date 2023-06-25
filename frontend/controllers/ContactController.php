<?php

namespace frontend\controllers;

use common\models\Contact;
use common\models\Messages;
use Yii;
use yii\web\Controller;
use yii\web\Response;


class ContactController extends Controller
{
    public function actionView(): string
    {
        $contacts = Contact::find()->one();

        return $this->render('view',['contacts' => $contacts]);

    }
    public function actionCreate()
    {
        if ($this->request->isPost) {
            $contacts = Contact::find()->one();
            $post = Yii::$app->request->post();
            $model = new Messages();
            $model->subject = $post['subject'];
            $model->name = $post['name'];
            $model->email = $post['email'];
            $model->message = $post['mess'];
            if ($model->save()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return $this->renderAjax('view', [
                    'contacts' => $contacts,
                ]);
            }else{
                Yii::$app->response->format = Response::FORMAT_JSON;
                return $this->renderAjax('view', [
                    'contacts' => $contacts,
                ]);
            }
        }

    }

}
