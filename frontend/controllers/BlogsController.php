<?php


namespace frontend\controllers;


use common\models\Posts;
use common\models\shop\Tag;
use yii\web\Controller;

class BlogsController extends Controller
{

    public function actionView(){

        $blogs = Posts::find()->all();
        $tags = Tag::find()->all();
        return $this->render('view', ['blogs' => $blogs, 'tags' => $tags, ]);
    }

}