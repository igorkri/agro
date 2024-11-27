<?php

namespace frontend\controllers;

use common\models\Posts;
use common\models\Settings;
use Spatie\SchemaOrg\Schema;
use yii\data\Pagination;
use yii\i18n\Formatter;
use yii\web\Controller;
use Yii;

class BlogsController extends Controller
{
    public function actionView()
    {
        $language = Yii::$app->session->get('_language');

        $posts = Posts::find()->all();

        if ($language !== 'uk') {
            foreach ($posts as $post) {
                $this->getPostTranslation($post, $language);
            }
        }

        $this->setShemaBlogs($posts);

        $posts = Posts::find();

        $pages = new Pagination(['totalCount' => $posts->count(), 'pageSize' => 4]);
        $blogs = $posts->offset($pages->offset)->limit($pages->limit)->orderBy('date_public DESC')->all();

        if ($language !== 'uk') {
            foreach ($blogs as $blog) {
                $this->getPostTranslation($blog, $language);
            }
        }

        $seo = Settings::seoPageTranslate('blogs');
        Settings::setMetamaster($seo);

        return $this->render('view',
            [
                'blogs' => $blogs,
                'pages' => $pages,
                'page_description' => $seo->page_description,
            ]);
    }

    protected function getPostTranslation($postItem, $language)
    {
        if ($postItem) {
            $translationPost = $postItem->getTranslation($language)->one();
            if ($translationPost) {
                if ($translationPost->title) {
                    $postItem->title = $translationPost->title;
                }
                if ($translationPost->description) {
                    $postItem->description = $translationPost->description;
                }
            }
        }
    }

    protected function setShemaBlogs($posts)
    {
        $blogPosting = [];
        $formatter = new Formatter;
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
    }
}