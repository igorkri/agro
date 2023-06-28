<?php


namespace frontend\controllers;

use common\models\Posts;
use Yii;
use yii\web\Controller;

class PostController extends Controller {

    public function actionView($slug)
    {
        $blogs = Posts::find()->limit(4)->all();
        $post = Posts::find()->where(['slug' => $slug])->one();

        Yii::$app->metamaster
            ->setTitle($post->seo_title)
            ->setDescription($post->seo_description)
            ->setImage('/posts/'.$post->image)
            ->register(Yii::$app->getView());

        return $this->render('view', ['post' => $post, 'blogs' => $blogs]);
    }

}