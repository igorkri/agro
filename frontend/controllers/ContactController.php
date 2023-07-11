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

        Yii::$app->metamaster
            ->setTitle('Зв\'язок з нами - AgroPro: Задайте питання, отримайте підтримку та зв\'яжіться з нашою командою')
            ->setDescription('Отримайте підтримку та відповіді на запитання про гербіциди, інсектициди, фунгіциди, протруйники, 
            прилипачі, десиканти, добрива та посівний матеріал у AgroPro. Наші експерти з сільського господарства допоможуть вам. 
            Задавайте питання про товари, доставку та оплату. Ми працюємо для вашого успіху. 
            Зв\'яжіться з нами сьогодні.')
            ->setImage('/frontend/web/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());

        return $this->render('view', ['contacts' => $contacts]);

    }

    public function actionCreate() {

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
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return $this->renderAjax('view', [
                    'contacts' => $contacts,
                ]);
            }
        }
    }
}
