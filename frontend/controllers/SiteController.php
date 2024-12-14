<?php

namespace frontend\controllers;

use common\models\Messages;
use common\models\Posts;
use common\models\SeoPages;
use common\models\shop\AuxiliaryCategories;
use common\models\shop\Category;
use common\models\shop\Product;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Spatie\SchemaOrg\Schema;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function actionError()
    {

        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            if ($exception->statusCode == 404)
                return $this->render('404', ['exception' => $exception]);
            else
                return $this->render('404', ['exception' => $exception]);
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
//    public function actions()
//    {
//
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//            ],
//        ];
//    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

//                Yii::$app->session->removeAll();

        $seo = SeoPages::find()->where(['slug' => 'home'])->one();

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
                        'Monday',
                        'Tuesday',
                        'Wednesday',
                        'Thursday',
                        'Friday'
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

        $homepage = Schema::WebPage()
            ->name($seo->title)
            ->description($seo->description)
            ->url(Yii::$app->request->absoluteUrl);
        Yii::$app->params['webPage'] = $homepage->toScript();

        Yii::$app->metamaster
            ->setSiteName('AgroPro')
            ->setType('website')
            ->setTitle($seo->title)
            ->setDescription(strip_tags($seo->description))
            ->setImage('/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());

        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionLoadContent()
    {
        $name = Yii::$app->request->get('widgetName');

        switch ($name) {
            case 'bestsellers':
                $content = $this->renderPartial('_load-bestsellers-widgets');
                break;
            case 'popular-categories':
                $content = $this->renderPartial('_load-popular-categories-widgets');
                break;
            case 'bestsellers-dacha':
                $content = $this->renderPartial('_load-bestsellers-dacha-widgets');
                break;
            case 'columns':
                $content = $this->renderPartial('_load-columns-widgets');
                break;
            default:
                // Обработка ситуации, когда значение widgetName не соответствует ожидаемым
                $content = 'Unknown widgetName';
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'success' => true,
            'content' => $content,
        ];
    }

    public function actionMailingList()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isPost) {
            $email = Yii::$app->request->post('email');

                $model = new Messages();
                $model->name = 'AgroPro';
                $model->email = $email;
                $model->message = 'Додати в розсилку';
                if ($model->save()) {
                    return ['success' => true, 'message' => 'Подписка оформлена!'];
                } else {
                    return ['success' => false, 'message' => 'Ошибка при сохранении данных.'];
                }

        } else {
            throw new BadRequestHttpException('Неверный запрос.');
        }
    }

}
