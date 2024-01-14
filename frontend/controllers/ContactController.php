<?php

namespace frontend\controllers;

use common\models\Contact;
use common\models\Messages;
use common\models\SeoPages;
use Spatie\SchemaOrg\Schema;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class ContactController extends Controller
{
    public function actionView(): string
    {
        $seo = SeoPages::find()->where(['slug' => 'contact'])->one();
        $contacts = Contact::find()->one();

        $organization = Schema::localBusiness()
            ->url('https://agropro.org.ua/')
            ->name('Інтернет-магазин | AgroPro')
            ->description('Купуйте |️ Засоби захисту рослин |️ Посівний матеріал |️ Мікродобрива ⚡ За вигідними цінами в Україні в агромаркеті AgroPro.org.ua.')
            ->email('nisatatyana@gmail.com')
            ->telephone('+3(066)394-18-28')
            ->priceRange('UAH')
            ->contactPoint(Schema::contactPoint()
                ->telephone('+3(066)394-18-28')
                ->areaServed('UA')
                ->contactType('customer service')
                ->url(Yii::$app->request->absoluteUrl)
                ->hoursAvailable(Schema::openingHoursSpecification()
                    ->opens('9:00')
                    ->closes('19:00')
                    ->dayOfWeek([
                        'http://schema.org/Monday',
                        'http://schema.org/Tuesday',
                        'http://schema.org/Wednesday',
                        'http://schema.org/Thursday',
                        'http://schema.org/Friday'
                    ])
                )
            )
            ->address([
                "@type" => "PostalAddress",
                "streetAddress" => 'Україна Полтава вул.Зіньківська 35',
                "postalCode" => '36000',
                "addressLocality" => 'Полтава',
                "addressRegion" => 'Полтавська область',
                "addressCountry" => 'Україна'
            ])
            ->image(Yii::$app->request->hostInfo . '/images/logos/meta_logo.jpg');
        Yii::$app->params['organization'] = $organization->toScript();

        Yii::$app->metamaster
            ->setTitle($seo->title)
            ->setDescription($seo->description)
            ->setImage('/images/logos/meta_logo.jpg')
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
        return null;
    }
}
