<?php


namespace frontend\controllers;


use common\models\Posts;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class BlogsController extends Controller
{

    public function actionView() {

        Yii::$app->metamaster
            ->setTitle('Статті - AgroPro: Поради, новини та інформація про сільське господарство')
            ->setDescription('Ознайомтесь з нашою колекцією статей на сайті AgroPro. 
            Знайдіть корисні поради, останні новини та цікаву інформацію про сільське господарство. 
            Ви дізнаєтесь про ефективні методи вирощування рослин, боротьби зі шкідниками, використання добрив та багато іншого. 
            Наші статті допоможуть вам підвищити врожайність та ефективність вашого сільськогосподарського бізнесу. 
            Запрошуємо вас відкрити світ знань і досвіду на сторінці статей AgroPro.')
            ->setImage('/frontend/web/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());

        $posts = Posts::find();

        $pages = new Pagination(['totalCount' => $posts->count(), 'pageSize' => 3]);
        $blogs = $posts->offset($pages->offset)->limit($pages->limit)->orderBy('date_public DESC')->all();

        return $this->render('view',
            [
                'blogs' => $blogs,
                'pages' => $pages
            ]);
    }

}