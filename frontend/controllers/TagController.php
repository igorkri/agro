<?php

namespace frontend\controllers;

use common\models\shop\ProductTag;
use common\models\shop\Product;
use common\models\shop\Tag;
use yii\data\Pagination;
use yii\web\Controller;
use yii\db\Expression;
use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

class TagController extends Controller
{
    public function actionView($slug)
    {
        $language = Yii::$app->session->get('_language');

        if (!Yii::$app->session->has('sort')) {
            Yii::$app->session->set('sort', '');
        } else {
            if (Yii::$app->request->post('sort') !== null) {
                Yii::$app->session->set('sort', Yii::$app->request->post('sort'));
            }
        }
        $sort = Yii::$app->session->get('sort');

        if (!Yii::$app->session->has('count')) {
            Yii::$app->session->set('count', 12);
        } else {
            if (Yii::$app->request->post('count') !== null) {
                Yii::$app->session->set('count', Yii::$app->request->post('count'));
            }
        }
        $count = intval(Yii::$app->session->get('count'));

        $tag_name = Tag::find()->where(['slug' => $slug])->one();
        $tags = ProductTag::find()->where(['tag_id' => $tag_name->id])->all();

        $query = Product::find()->where(['id' => []]);

        if ($sort === 'price_lowest') {
            $query->orderBy(['price' => SORT_ASC]);
        } elseif ($sort === 'price_highest') {
            $query->orderBy(['price' => SORT_DESC]);
        } elseif ($sort === 'name_a') {
            $query->orderBy(['name' => SORT_ASC]);
        } elseif ($sort === 'name_z') {
            $query->orderBy(['name' => SORT_DESC]);
        } else {
            $query->orderBy([new Expression('FIELD(status_id, 1, 3, 4, 2)')]);
        }


        foreach ($tags as $tag) {
            $query->orWhere(['id' => $tag->product_id]);
        }

        $productIds = array_column($tags, 'product_id');
        $query->andWhere(['id' => $productIds]);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $count]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

        $this->setProductMetadata($tag_name, $language);


        if ($language !== 'uk') {
            foreach ($products as $product) {
                if ($product) {
                    $translationProd = $product->getTranslation($language)->one();
                    if ($translationProd) {
                        if ($translationProd->name) {
                            $product->name = $translationProd->name;
                        }
                    }
                    $translationCat = $product->category->getTranslation($language)->one();
                    if ($translationCat) {
                        if ($translationCat->name) {
                            $product->category->name = $translationCat->name;
                        }
                        if ($translationCat->prefix) {
                            $product->category->prefix = $translationCat->prefix;
                        }
                    }
                }
            }
        }

        return $this->render('view',
            [
                'products' => $products,
                'products_all' => $products_all,
                'tag_name' => $tag_name,
                'pages' => $pages,
                'language' => $language,
            ]);
    }

    public function actionRedirect($id)
    {
        $tag = Tag::findOne($id);
        if (!$tag) {
            throw new NotFoundHttpException("Tag not found");
        }
        $newUrl = Url::to(['tag/view', 'slug' => $tag->slug], true);

        return $this->redirect($newUrl, 301); // 301 - постоянный редирект
    }

    protected function setProductMetadata($tag_name, $language)
    {
        if ($tag_name->seo_title) {
            $title = $tag_name->getTagSeoTitleTranslate($tag_name, $language);
        } else {
            $title = 'Продукти які відповідають запиту ' . '[ ' . $tag_name->getTagTranslate($tag_name, $language) . ' ]';
        }
        if ($tag_name->seo_description) {
            $description = $tag_name->getTagSeoDescriptionTranslate($tag_name, $language);
        } else {
            $description = 'На сторінці відображено товари які згруповані запитом ' . '[ ' . $tag_name->getTagTranslate($tag_name, $language) . ' ]';

        }

        Yii::$app->metamaster
            ->setSiteName('AgroPro')
            ->setType('website')
            ->setTitle($title)
            ->setDescription($description)
            ->setImage('/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());
    }
}