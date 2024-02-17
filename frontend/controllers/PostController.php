<?php

namespace frontend\controllers;

use common\models\PostProducts;
use common\models\Posts;
use common\models\PostsReview;
use Yii;
use yii\helpers\Url;
use yii\i18n\Formatter;
use yii\web\Controller;
use Spatie\SchemaOrg\Schema;
use common\models\shop\Product;

class PostController extends Controller
{
    public function actionView($slug)
    {
        $blogs = Posts::find()->limit(6)->orderBy('date_public DESC')->all();
        $postItem = Posts::find()->where(['slug' => $slug])->one();

        $products_id = PostProducts::find()
            ->select('product_id')
            ->where(['post_id' => $postItem->id])
            ->asArray()
            ->all();
        $products_id = array_column($products_id, 'product_id');
        $products = Product::find()->where(['id' => $products_id])->all();

        $model_review = new PostsReview();
        $formatter = new Formatter();

        $schemaDate = $formatter->asDatetime($postItem->date_public, 'php:Y-m-d\TH:i:sP');
        $schemaPost = Schema::Article()
            ->headline($postItem->title)
            ->description($postItem->seo_description)
            ->image(Yii::$app->request->hostInfo . '/posts/' . $postItem->image)
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
                    ->name('AgroPro')
                    ->url(Yii::$app->request->hostInfo . '/images/logos/logoagro.jpg')
                )
            );

        $schemaBreadcrumb = Schema::breadcrumbList()
            ->itemListElement([
                Schema::listItem()
                    ->position(1)
                    ->item(Schema::thing()->name('Головна')
                        ->url(Yii::$app->homeUrl)
                        ->setProperty('id', Yii::$app->homeUrl)),
                Schema::listItem()
                    ->position(2)
                    ->item(Schema::thing()->name('Статті')
                        ->url(Url::to(['blogs/view']))
                        ->setProperty('id', Url::to(['blogs/view']))),
                Schema::listItem()
                    ->position(3)
                    ->item(Schema::thing()->name($postItem->title)
                        ->url(Url::to(['post/view', 'slug' => $postItem->slug]))
                        ->setProperty('id', Url::to(['post/view', 'slug' => $postItem->slug]))),
            ]);

        Yii::$app->params['breadcrumb'] = $schemaBreadcrumb->toScript();
        Yii::$app->params['post'] = $schemaPost->toScript();

        Yii::$app->metamaster
            ->setTitle($postItem->seo_title)
            ->setDescription($postItem->seo_description)
            ->setImage(Yii::$app->request->hostInfo . '/posts/' . $postItem->image)
            ->register(Yii::$app->getView());

        return $this->render('view', [
            'postItem' => $postItem,
            'blogs' => $blogs,
            'model_review' => $model_review,
            'products' => $products,
            'products_id' => $products_id,
        ]);
    }

}