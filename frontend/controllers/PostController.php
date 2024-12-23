<?php

namespace frontend\controllers;

use common\models\PostProducts;
use common\models\Posts;
use common\models\PostsReview;
use common\models\Settings;
use Yii;
use yii\web\Controller;
use common\models\shop\Product;

class PostController extends Controller
{
    public function actionView($slug)
    {
        $language = Yii::$app->session->get('_language');

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

        if ($language !== 'uk') {
            foreach ($blogs as $blog) {
                $this->getPostTranslation($blog, $language);
            }
            $this->getPostTranslation($postItem, $language);
        }

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
                if ($translationPost->seo_title) {
                    $postItem->seo_title = $translationPost->seo_title;
                }
                if ($translationPost->seo_description) {
                    $postItem->seo_description = $translationPost->seo_description;
                }
            }
        }
    }
}