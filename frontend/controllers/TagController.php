<?php

namespace frontend\controllers;

use common\models\Settings;
use common\models\shop\Category;
use common\models\shop\ProductTag;
use common\models\shop\Product;
use common\models\shop\Tag;
use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

class TagController extends BaseFrontendController
{
    public function actionIndex()
    {
        $language = Yii::$app->session->get('_language');

        $categoriesTags = [];
        $categories = Category::find()
            ->select(['id', 'name', 'slug'])
            ->where(['visibility' => true])
            ->andWhere(['IS NOT', 'parentId', null])
            ->all();

        foreach ($categories as $category) {
            $this->translateCategory($category, $language);
        }

        foreach ($categories as $category) {

            $productsId = Product::find()
                ->select('id')
                ->where(['category_id' => $category->id])
                ->column();

            $productsTagsId = ProductTag::find()
                ->select('tag_id')
                ->where(['product_id' => $productsId])
                ->distinct()
                ->column();

            $tags = Tag::find()
                ->select(['id', 'name', 'slug'])
                ->where(['visibility' => true])
                ->andWhere(['id' => $productsTagsId])
                ->with('translations')
                ->all();

            if ($language !== 'uk') {
                foreach ($tags as $tag) {
                    $translationTag = null;

                    foreach ($tag->translations as $translation) {
                        if ($translation->language === $language) {
                            $translationTag = $translation;
                            break;
                        }
                    }

                    if ($translationTag && $translationTag->name) {
                        $tag->name = $translationTag->name;
                    }
                }
            }
            if ($tags) {
                $categoriesTags[] = [
                    'category' => $category,
                    'tags' => $tags,
                ];
            }
        }

        $seo = Settings::seoPageTranslate('tag');
        $type = 'website';
        $title = $seo->title;
        $description = $seo->description;
        $image = '';
        $keywords = '';
        Settings::setMetamaster($type, $title, $description, $image, $keywords);

        $page_description = $seo->page_description;

        return $this->render('index',
            [
                'categories' => $categoriesTags,
                'page_description' => $page_description,
            ]);
    }

    public function actionView($slug, $category_slug = null)
    {
        $language = Yii::$app->session->get('_language');

        $categoryName = '';

        $params = $this->setSortAndCount();
        $sort = $params['sort'];
        $count = $params['count'];

        $tag_name = Tag::find()->where(['slug' => $slug])->one();

        if ($category_slug) {
            $category = Category::find()->select(['id', 'name'])->where(['slug' => $category_slug])->one();
            $this->translateCategory($category, $language);
            $categoryId = $category->id;
            $categoryName = Yii::t('app','в категорії ') . '<span style="color: #90998cc7">' .  $category->name . '</span>';
            $productsId = Product::find()->select('id')->where(['category_id' => $categoryId])->column();
            $tags = ProductTag::find()->where(['tag_id' => $tag_name->id])->andWhere(['product_id' => $productsId])->all();
        } else {
            $tags = ProductTag::find()->where(['tag_id' => $tag_name->id])->all();
        }

        $query = Product::find()->where(['id' => []]);

        $this->applySorting($query, $sort);

        foreach ($tags as $tag) {
            $query->orWhere(['id' => $tag->product_id]);
        }

        $productIds = array_column($tags, 'product_id');
        $query->andWhere(['id' => $productIds]);

        $pages = $this->setPagination($query, $count);

        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

        $this->setProductMetadata($tag_name, $language);

        $products = $this->translateProduct($products, $language);

        return $this->render('view',
            [
                'products' => $products,
                'products_all' => $products_all,
                'tag_name' => $tag_name,
                'pages' => $pages,
                'language' => $language,
                'categoryName' => $categoryName,
            ]);

    }

    public function actionRedirect($id)
    {
        $tag = Tag::findOne($id);
        if (!$tag) {
            throw new NotFoundHttpException("Tag not found id = " . $id);
        }
        $newUrl = Url::to(['tag/view', 'slug' => $tag->slug], true);

        return $this->redirect($newUrl, 301);
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