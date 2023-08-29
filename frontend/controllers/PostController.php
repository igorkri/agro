<?php


namespace frontend\controllers;

use common\models\Posts;
use Yii;
use yii\i18n\Formatter;
use yii\web\Controller;
use Spatie\SchemaOrg\Schema;

class PostController extends Controller
{

    public function actionView($slug)
    {
        $blogs = Posts::find()->limit(6)->orderBy('date_public DESC')->all();
        $post = Posts::find()->where(['slug' => $slug])->one();
        $formatter = new Formatter();
        $schemaDate = $formatter->asDatetime($post->date_public, 'php:Y-m-d\TH:i:sP');
        $schemaPost = Schema::blogPosting()
            ->headline($post->title)
            ->description($post->seo_description)
            ->datePublished($schemaDate)
            ->author(Schema::person()->name('Tatyana Khalimon')
                ->url(Yii::$app->request->hostInfo . '/post/' . $post->slug))
//            ->review(Schema::review()
//                ->reviewRating(Schema::rating()->ratingValue(4)->bestRating(5))
//                ->author(Schema::person()->name('Tatyana Khalimon')))
            ->image(Yii::$app->request->hostInfo . '/frontend/web/posts/' . $post->webp_image)
            ->articleBody($post->description)
            ->mainEntityOfPage(Yii::$app->request->hostInfo . '/post/' . $post->slug);
//            ->aggregateRating(Schema::aggregateRating()
//                ->ratingValue('4.3')
//                ->reviewCount('27'));
        Yii::$app->params['schema'] = $schemaPost->toScript();

        Yii::$app->metamaster
            ->setTitle($post->seo_title)
            ->setDescription($post->seo_description)
            ->setImage(Yii::$app->request->hostInfo . '/frontend/web/posts/' . $post->webp_image)
            ->register(Yii::$app->getView());

        return $this->render('view', ['post' => $post, 'blogs' => $blogs]);
    }

}