<?php


namespace frontend\controllers;


use common\models\Posts;
use common\models\shop\Tag;
use yii\data\Pagination;
use yii\web\Controller;

class BlogsController extends Controller
{

    public function actionView()
    {

        $posts = Posts::find();

        $pages = new Pagination(['totalCount' => $posts->count(), 'pageSize' => 3]);
        $blogs = $posts->offset($pages->offset)->limit($pages->limit)->all();

        $tags = Tag::find()->all();

        return $this->render('view',
            [
                'blogs' => $blogs,
                'tags' => $tags,
                'pages' => $pages
            ]);
    }

}