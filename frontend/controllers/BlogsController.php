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
            ->setDescription('Дізнайтесь про гербіциди, інсектициди, фунгіциди, протруйники, прилипачі, десиканти, добрива, посівний матеріал та інші препарати в статтях AgroPro. 
            Корисні поради, новини та методи вирощування рослин. 
            Підвищуйте врожайність та ефективність вашого бізнесу. 
            Знання AgroPro - успіх вашого господарства.')
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