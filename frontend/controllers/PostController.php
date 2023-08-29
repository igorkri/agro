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
        $schemaPost = Schema::blogPosting()
            ->headline($postItem->title)
            ->description($postItem->seo_description)
            ->datePublished($schemaDate)
            ->author(Schema::person()
                    ->name('Tatyana Khalimon')
                    ->url(Yii::$app->request->hostInfo . '/post/' . $postItem->slug))
            ->image(Yii::$app->request->hostInfo . '/frontend/web/posts/' . $postItem->webp_image)
            ->articleBody($postItem->description)
            ->mainEntityOfPage(Yii::$app->request->hostInfo . '/post/' . $postItem->slug)
            ->aggregateRating(Schema::aggregateRating()
                    ->itemReviewed(Schema::LocalBusiness()
                            ->name($postItem->title))
                    ->ratingValue($postItem->getSchemaRating($postItem->id))
                    ->reviewCount($postItem->getSchemaCountReviews($postItem->id)));

        Yii::$app->params['schema'] = $schemaPost->toScript();

        Yii::$app->metamaster
            ->setTitle($postItem->seo_title)
            ->setDescription($postItem->seo_description)
            ->setImage(Yii::$app->request->hostInfo . '/frontend/web/posts/' . $postItem->webp_image)
            ->register(Yii::$app->getView());

        return $this->render('view', [
            'postItem' => $postItem,
            'blogs' => $blogs,
            'model_review' => $model_review,
        ]);
    }

}