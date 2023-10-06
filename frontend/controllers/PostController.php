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

        $organization = Schema::organization()
            ->name('AgroPro')
            ->address([
                "@type" => "PostalAddress",
                "streetAddress" => 'Україна Полтава вул.Зіньківська 35',
                "postalCode" => '36000',
                "addressCountry" => 'Україна'
            ])
            ->telephone('+3(066)394-18-28')
            ->image(Yii::$app->request->hostInfo . '/images/logos/meta_logo.jpg')
            ->url('https://agropro.org.ua/')
            ->logo(Yii::$app->request->hostInfo . '/images/logos/logoagro.jpg');
        Yii::$app->params['organization'] = $organization->toScript();

        $schemaDate = $formatter->asDatetime($postItem->date_public, 'php:Y-m-d\TH:i:sP');
        $schemaPost = Schema::blogPosting()
            ->headline($postItem->title)
            ->description($postItem->seo_description)
            ->datePublished($schemaDate)
            ->author(Schema::person()
                ->name('Tatyana Khalimon')
                ->url(Yii::$app->request->hostInfo . '/post/' . $postItem->slug))
            ->image(Yii::$app->request->hostInfo . '/posts/' . $postItem->webp_image)
            ->articleBody($postItem->description)
            ->mainEntityOfPage(Yii::$app->request->hostInfo . '/post/' . $postItem->slug)
            ->aggregateRating(Schema::aggregateRating()
                ->ratingValue($postItem->getSchemaRating($postItem->id))
                ->reviewCount($postItem->getSchemaCountReviews($postItem->id)));
        Yii::$app->params['blogPosting'] = $schemaPost->toScript();

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