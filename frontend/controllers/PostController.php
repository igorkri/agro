<?php


namespace frontend\controllers;


use common\models\Posts;
use common\models\shop\Tag;
use yii\web\Controller;

class PostController extends Controller
{

    public function actionView($slug)
    {
        $blogs = Posts::find()->limit(4)->all();
        $post = Posts::find()->where(['slug' => $slug])->one();
        $tags = Tag::find()->all();
        return $this->render('view', ['post' => $post, 'tags' => $tags, 'blogs' => $blogs]);
    }

}