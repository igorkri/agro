<?php

namespace frontend\controllers;

use common\models\PostProducts;
use common\models\Posts;
use common\models\PostsReview;
use common\models\Settings;
use Yii;
use yii\web\Controller;
use common\models\shop\Product;
use yii\web\NotFoundHttpException;

class PostController extends Controller
{
    public function actionView($slug)
    {
        $language = Yii::$app->session->get('_language', 'uk');
        $model_review = new PostsReview();
        $blogs = Posts::find()
            ->alias('p')
            ->select([
                'p.id',
                'p.slug',
                'p.webp_small',
                'p.date_public',
                'p.title AS original_title',
                'IFNULL(pt.title, p.title) AS title', // Переведенное название
            ])
            ->leftJoin('posts_translate pt', 'pt.post_id = p.id AND pt.language = :language')
            ->addParams([':language' => $language]) // Параметр для языка
            ->limit(6)
            ->orderBy(['p.date_public' => SORT_DESC])
            ->all();

        $postItem = Posts::find()
            ->alias('p')
            ->select([
                'p.id',
                'p.date_public',
                'p.date_updated',
                'p.slug',
                'p.image',
                'p.title AS original_title',
                'p.description AS original_description',
                'p.seo_title AS original_seo_title',
                'p.seo_description AS original_seo_description',
                'IFNULL(pt.title, p.title) AS title', // Переведенное название
                'IFNULL(pt.description, p.description) AS description', // Переведенное описание
                'IFNULL(pt.seo_title, p.seo_title) AS seo_title', // Переведенный SEO заголовок
                'IFNULL(pt.seo_description, p.seo_description) AS seo_description' // Переведенное SEO описание
            ])
            ->leftJoin('posts_translate pt', 'pt.post_id = p.id AND pt.language = :language')
            ->where(['p.slug' => $slug])
            ->addParams([':language' => $language]) // Параметр языка
            ->one();

        if ($postItem === null) {
            throw new NotFoundHttpException('Post not found ' . '" ' . $slug . ' "');
        }

        $products_id = PostProducts::find()->select('product_id')->where(['post_id' => $postItem->id])->column();
        $products = Product::find()
            ->alias('p')
            ->select([
                'p.id',
                'p.slug',
                'p.price',
                'p.old_price',
                'p.currency',
                'p.status_id',
                'p.name AS original_name',
                'p.description AS original_description',
                'IFNULL(pt.name, p.name) AS name', // Переведенное название
                'IFNULL(pt.description, p.description) AS description' // Переведенное описание
            ])
            ->leftJoin('products_translate pt', 'pt.product_id = p.id AND pt.language = :language')
            ->where(['p.id' => $products_id])
            ->addParams([':language' => $language]) // Параметр языка
            ->all();

        $schemaPost = $postItem->getSchemaPost();
        $schemaBreadcrumb = $postItem->getSchemaBreadcrumb();

        Yii::$app->params['breadcrumb'] = $schemaBreadcrumb->toScript();
        Yii::$app->params['post'] = $schemaPost->toScript();

        $type = 'article';
        $title = $postItem->seo_title;
        $description = $postItem->seo_description;
        $image = '/posts/' . $postItem->image;
        $keywords = '';
        Settings::setMetamaster($type, $title, $description, $image, $keywords);

        $this->setAlernateUrl($slug);

        return $this->render('view', [
            'postItem' => $postItem,
            'blogs' => $blogs,
            'model_review' => $model_review,
            'products' => $products,
            'products_id' => $products_id,
        ]);
    }

    protected function setAlernateUrl($slug)
    {
        $url = Yii::$app->request->hostInfo;
        $ukUrl = $url . '/post/' . $slug;
        $enUrl = $url . '/en/post/' . $slug;
        $ruUrl = $url . '/ru/post/' . $slug;

        $alternateUrls = [
            'ukUrl' => $ukUrl,
            'enUrl' => $enUrl,
            'ruUrl' => $ruUrl,
        ];

        Yii::$app->params['alternateUrls'] = $alternateUrls;
    }

}