<?php

namespace frontend\controllers;

use common\models\Posts;
use common\models\SeoPages;
use Spatie\SchemaOrg\Schema;
use yii\data\Pagination;
use yii\i18n\Formatter;
use yii\web\Controller;
use Yii;

class BlogsController extends Controller
{
    public function actionView() {

        $seo = SeoPages::find()->where(['slug' => 'blogs'])->one();
        $formatter = new Formatter();
        $posts = Posts::find()->all();

        $blogPosting = [];
        foreach ($posts as $post) {
            $blogPost = [
                "articleSection" => $post->seo_description,
                "headLine" => $post->title,
                "articleBody" => $post->description,
                "datePublished" => $formatter->asDatetime($post->date_public, 'php:Y-m-d\TH:i:sP'),
                "dateModified" => $formatter->asDatetime($post->date_public, 'php:Y-m-d\TH:i:sP'),
                "url" => Yii::$app->request->hostInfo . '/posts/' . $post->slug,
                "image" => Yii::$app->request->hostInfo . '/posts/' . $post->image,
                "author" => Schema::person()
                    ->name('AgroPro')
                    ->url(Yii::$app->request->hostInfo . '/post/' . $post->slug)
            ];
            $blogPosting[] = $blogPost;
        }

        $schemaBlog = Schema::Blog()
        ->blogPosts($blogPosting);
        Yii::$app->params['blog'] = $schemaBlog->toScript();

        Yii::$app->metamaster
            ->setTitle($seo->title)
            ->setDescription($seo->description)
            ->setImage('/images/logos/meta_logo.jpg')
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