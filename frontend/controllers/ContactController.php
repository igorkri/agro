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
            ->setDescription('Зв\'яжіться з нами в AgroPro та отримайте необхідну підтримку та відповіді на ваші запитання. 
        Наша команда експертів з сільського господарства готова надати вам допомогу та консультації. 
        Задавайте питання щодо наших товарів, умов доставки, оплати та багато іншого. 
        Ми працюємо для вашого задоволення та успіху в сільському господарстві. 
        Зв\'яжіться з нами сьогодні і отримайте персоналізовану підтримку для вашого сільськогосподарського бізнесу.')
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
