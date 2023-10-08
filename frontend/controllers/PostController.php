<?php


namespace frontend\controllers;

use common\models\Posts;
use common\models\PostsReview;
use Yii;
use yii\i18n\Formatter;
use yii\web\Controller;
use Spatie\SchemaOrg\Schema;

class PostController extends Controller
{
    public function actionView($slug)
    {
        $blogs = Posts::find()->limit(6)->orderBy('date_public DESC')->all();
        $postItem = Posts::find()->where(['slug' => $slug])->one();
        $model_review = new PostsReview();
        $formatter = new Formatter();

        $schemaDate = $formatter->asDatetime($postItem->date_public, 'php:Y-m-d\TH:i:sP');
        $schemaPost = Schema::BlogPosting()
            ->headline($postItem->title)
            ->description($postItem->seo_description)
            ->image(Yii::$app->request->hostInfo . '/posts/' . $postItem->webp_image)
            ->datePublished($schemaDate)
            ->dateModified($schemaDate)
            ->articleBody($postItem->description)
            ->mainEntityOfPage(Schema::WebPage()
                ->id(Yii::$app->request->hostInfo . '/post/' . $postItem->slug))
            ->author(Schema::person()
                ->name('AgroPro')
                ->url(Yii::$app->request->hostInfo . '/post/' . $postItem->slug))
            ->publisher(Schema::Organization()
                ->name('AgroPro')
                ->logo(Schema::imageObject()
                    ->url(Yii::$app->request->hostInfo . '/images/logos/logoagro.jpg')
                )
            );
        Yii::$app->params['post'] = $schemaPost->toScript();

        Yii::$app->metamaster
            ->setTitle($postItem->seo_title)
            ->setDescription($postItem->seo_description)
            ->setImage(Yii::$app->request->hostInfo . '/posts/' . $postItem->webp_image)
            ->register(Yii::$app->getView());

        return $this->render('view', [
            'postItem' => $postItem,
            'blogs' => $blogs,
            'model_review' => $model_review,
        ]);
    }

}