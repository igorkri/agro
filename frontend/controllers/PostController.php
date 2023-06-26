<?php


namespace frontend\controllers;

use common\models\Posts;
use yii\web\Controller;

class PostController extends Controller {

    public function actionView($slug)
    {
        $blogs = Posts::find()->limit(4)->all();
        $post = Posts::find()->where(['slug' => $slug])->one();

        return $this->render('view', ['post' => $post, 'blogs' => $blogs]);
    }

}