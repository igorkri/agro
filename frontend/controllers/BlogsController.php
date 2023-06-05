<?php


namespace frontend\controllers;


use common\models\Posts;
use yii\data\Pagination;
use yii\web\Controller;

class BlogsController extends Controller
{

    public function actionView()
    {

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