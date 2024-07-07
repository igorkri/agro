<?php

namespace frontend\controllers;

use common\models\shop\AuxiliaryCategories;
use common\models\shop\ProductProperties;
use common\models\shop\Category;
use common\models\shop\Product;
use Spatie\SchemaOrg\Schema;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\Controller;
use yii\db\Expression;
use Yii;

class CategoryController extends Controller
{
    public function actionList()
    {
        $language = Yii::$app->session->get('_language');
        $categories = Category::find()
            ->with(['products'])
            ->where(['is', 'parentId', new Expression('null')])
            ->andWhere(['visibility' => 1])
            ->all();

        Yii::$app->metamaster
            ->setSiteName('AgroPro')
            ->setType('website')
            ->setTitle("Категорії Товарів інтернет-магазину | AgroPro")
            ->setDescription("AgroPro - ваш інтернет-магазин для ЗЗР, добрив, 
            посівного матеріалу та боротьби з гризунами. Оптимізуйте виробництво з нами!")
            ->register(Yii::$app->getView());

        if ($language !== 'uk') {
            if ($categories) {
                foreach ($categories as $category) {
                    if ($category) {
                        $translationCat = $category->getTranslation($language)->one();
                        if ($translationCat) {
                            if ($translationCat->name) {
                                $category->name = $translationCat->name;
                            }
                        }
                    }
                }
            }
        }

        return $this->render('list',
            [
                'categories' => $categories,
                'language' => $language,
            ]);
    }

    public function actionChildren($slug)
    {
        $language = Yii::$app->session->get('_language');

        $category = Category::find()
            ->with(['parents', 'parent', 'products'])
            ->where(['slug' => $slug])
            ->one();

        if ($language !== 'uk') {
            $translationCat = $category->getTranslation($language)->one();
            if ($translationCat) {
                if ($translationCat->name) {
                    $category->name = $translationCat->name;
                }
                if ($translationCat->description) {
                    $category->description = $translationCat->description;
                }
                if ($translationCat->pageTitle) {
                    $category->pageTitle = $translationCat->pageTitle;
                }
                if ($translationCat->metaDescription) {
                    $category->metaDescription = $translationCat->metaDescription;
                }
            }
            if ($category->parents) {
                foreach ($category->parents as $parent) {
                    if ($parent !== null) {
                        $translationCatParent = $parent->getTranslation($language)->one();
                        if ($translationCatParent) {
                            $parent->name = $translationCatParent->name;
                        }
                    }
                }
            }
        }

        $imageMetamaster = '/category/' . $category->file;

        $this->setCategoryMetamaster($category, $imageMetamaster);
        $this->setChildrenProductSchema($category);

        return $this->render('children',
            [
                'category' => $category,
                'language' => $language,
            ]);
    }

    public function actionCatalog($slug)
    {
//        Yii::$app->session->removeAll();
        $language = Yii::$app->session->get('_language');
        $result = $this->getSortVariableSession();
        $sort = $result['sort'];
        $count = $result['count'];

        $brandCheck = Yii::$app->request->post('brandCheck');
        $propertiesCheck = Yii::$app->request->post('propertiesCheck');
        $minPrice = Yii::$app->request->post('minPrice');
        $maxPrice = Yii::$app->request->post('maxPrice');

        Yii::$app->session->set('brandCheckFilter', $brandCheck);
        Yii::$app->session->set('propertiesCheckFilter', $propertiesCheck);
        Yii::$app->session->set('minPriceFilter', $minPrice);
        Yii::$app->session->set('maxPriceFilter', $maxPrice);

        $category = Category::find()->where(['slug' => $slug])->one();

        $auxiliaryCategories = AuxiliaryCategories::find()
            ->where(['parentId' => $category->id])
            ->andWhere(['visibility' => 1])
            ->all();

        $propertiesFilter = ProductProperties::find()
            ->select(['properties'])
            ->distinct()
            ->where(['category_id' => $category->id])
            ->orderBy(['sort' => SORT_ASC])
            ->column();

        $query = Product::find()->where(['category_id' => $category->id]);

        $query->andFilterWhere(['>=', 'price', $minPrice])
            ->andFilterWhere(['<=', 'price', $maxPrice]);

        if ($propertiesCheck !== null) {
            $queryProdId = ProductProperties::find()
                ->select('product_id')
                ->where(['category_id' => $category->id]);

            foreach ($propertiesCheck as $value) {
                $subQuery = ProductProperties::find()
                    ->select('product_id')
                    ->where(['category_id' => $category->id])
                    ->andWhere(['like', 'value', $value]);

                $queryProdId->andWhere(['in', 'product_id', $subQuery]);
            }
            $productsId = $queryProdId->column();

            $query->andFilterWhere(['in', 'id', $productsId]);
        }

        if ($brandCheck !== null) {
            $query->andFilterWhere(['in', 'brand_id', $brandCheck]);
        }

        $this->getProductsSort($sort, $query);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $count]);

        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

        if ($language !== 'uk') {
            if ($category) {
                $translationCat = $category->getTranslation($language)->one();
                if ($translationCat) {
                    if ($translationCat->name) {
                        $category->name = $translationCat->name;
                    }
                    if ($translationCat->description) {
                        $category->description = $translationCat->description;
                    }
                    if ($translationCat->pageTitle) {
                        $category->pageTitle = $translationCat->pageTitle;
                    }
                    if ($translationCat->metaDescription) {
                        $category->metaDescription = $translationCat->metaDescription;
                    }
                }
            }
            if ($category->parent) {
                $translationCatParent = $category->parent->getTranslation($language)->one();
                if ($translationCatParent) {
                    if ($translationCatParent->name) {
                        $category->parent->name = $translationCatParent->name;
                    }
                }
            }
            if ($category->parent) {
                if ($category->parent->parents) {
                    foreach ($category->parent->parents as $parent) {
                        $translationCatParentsParent = $parent->getTranslation($language)->one();
                        if ($translationCatParentsParent) {
                            if ($translationCatParentsParent->name) {
                                $parent->name = $translationCatParentsParent->name;
                            }
                        }
                    }
                }
            }
            if ($products) {
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
            if ($auxiliaryCategories) {
                foreach ($auxiliaryCategories as $auxiliaryCategory) {
                    if ($auxiliaryCategory) {
                        $translationAuxiliaryCategory = $auxiliaryCategory->getTranslation($language)->one();
                        if ($translationAuxiliaryCategory) {
                            if ($translationAuxiliaryCategory->name) {
                                $auxiliaryCategory->name = $translationAuxiliaryCategory->name;
                            }
                        }
                    }
                }
            }
        }

        $imageMetamaster = '/category/' . $category->file;

        $this->setCatalogBreadCrumbSchema($category);
        $this->setCatalogProductSchema($category, $products_all);
        $this->setCategoryMetamaster($category, $imageMetamaster);

        return $this->render('catalog',
            compact([
                'products',
                'category',
                'pages',
                'products_all',
                'propertiesFilter',
                'auxiliaryCategories',
                'language',
            ]));
    }

    public function actionAuxiliaryCatalog($slug)
    {
//        Yii::$app->session->removeAll();
        $language = Yii::$app->session->get('_language');
        $result = $this->getSortVariableSession();
        $sort = $result['sort'];
        $count = $result['count'];

//        $brandCheck = Yii::$app->request->post('brandCheck');
//        $propertiesCheck = Yii::$app->request->post('propertiesCheck');
//        $minPrice = Yii::$app->request->post('minPrice');
//        $maxPrice = Yii::$app->request->post('maxPrice');
//
//        Yii::$app->session->set('brandCheckFilter', $brandCheck);
//        Yii::$app->session->set('propertiesCheckFilter', $propertiesCheck);
//        Yii::$app->session->set('minPriceFilter', $minPrice);
//        Yii::$app->session->set('maxPriceFilter', $maxPrice);


        $category = AuxiliaryCategories::find()->where(['slug' => $slug])->one();

        $breadcrumbCategory = Category::find()->where(['id' => $category->parentId])->one();

        $categoryId = $category->parentId;

        $subQuery = ProductProperties::find()
            ->select('product_id')
            ->where(['category_id' => $categoryId])
            ->andWhere(['like', 'value', $category->object]);

        $productsId = $subQuery->column();

//        $propertiesFilter = ProductProperties::find()
//            ->select(['properties'])
//            ->distinct()
//            ->where(['category_id' => $categoryId])
//            ->orderBy(['sort' => SORT_ASC])
//            ->column();

        $query = Product::find()->where(['id' => $productsId]);

//        $query->andFilterWhere(['>=', 'price', $minPrice])
//            ->andFilterWhere(['<=', 'price', $maxPrice]);

//        if ($propertiesCheck !== null) {
//            $queryProdId = ProductProperties::find()
//                ->select('product_id')
//                ->where(['category_id' => $categoryId]);
//
//            foreach ($propertiesCheck as $value) {
//                $subQuery = ProductProperties::find()
//                    ->select('product_id')
//                    ->where(['category_id' => $categoryId])
//                    ->andWhere(['like', 'value', $value]);
//
//                $queryProdId->andWhere(['in', 'product_id', $subQuery]);
//            }
//            $productsId = $queryProdId->column();
//
//            $query->andFilterWhere(['in', 'id', $productsId]);
//        }
//
//        if ($brandCheck !== null) {
//            $query->andFilterWhere(['in', 'brand_id', $brandCheck]);
//        }

        $this->getProductsSort($sort, $query);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $count]);

        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

        if ($language !== 'uk') {
            if ($category) {
                $translationCat = $category->getTranslation($language)->one();
                if ($translationCat) {
                    if ($translationCat->name) {
                        $category->name = $translationCat->name;
                    }
                    if ($translationCat->description) {
                        $category->description = $translationCat->description;
                    }
                    if ($translationCat->pageTitle) {
                        $category->pageTitle = $translationCat->pageTitle;
                    }
                    if ($translationCat->metaDescription) {
                        $category->metaDescription = $translationCat->metaDescription;
                    }
                }
            }

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
                    $translationParentCat = $breadcrumbCategory->getTranslation($language)->one();
                    if ($translationParentCat) {
                        if ($translationParentCat->name) {
                            $breadcrumbCategory->name = $translationParentCat->name;
                        }
                    }
                }
            }
        }

        $imageMetamaster = '/auxiliary-categories/' . $category->image;

        $this->setAuxiliaryCatalogBreadCrumbSchema($category, $breadcrumbCategory);
        $this->setAuxiliaryCatalogProductSchema($category, $products_all, $productsId);
        $this->setCategoryMetamaster($category, $imageMetamaster);

        return $this->render('view',
            compact([
                'products',
                'category',
                'pages',
                'products_all',
                'breadcrumbCategory',
                'language',
//                'propertiesFilter',
//                'auxiliaryCategories',
            ]));
    }

    protected function getSortVariableSession()
    {
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

        return ['sort' => $sort, 'count' => $count];
    }

    protected function getProductsSort($sort, $query)
    {
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
    }

    protected function setChildrenProductSchema($category)
    {
        $language = Yii::$app->session->get('_language');

        if ($language !== 'uk') {
            $url = Yii::$app->request->hostInfo . '/' . $language;
        } else {
            $url = Yii::$app->request->hostInfo;
        }

        $url = rtrim($url, '/') . '/';

        $res = [];
        foreach ($category->parents as $cat) {
            if ($cat->parentId === $category->id) {
                $res[] = $cat->id;
            }
        }

        $results = Product::find()->where(['category_id' => $res])->all();

        $offers = [];
        foreach ($results as $product) {
            $offer = [
                "url" => $url . 'product/' . $product->slug
            ];
            $offers[] = $offer;
        }

        $products_all = count($offers);

        if ($res) {
            $productList = Schema::Product()
                ->name($category->name)
                ->url($url . 'catalog/' . $category->slug)
                ->description($category->description)
                ->image(Yii::$app->request->hostInfo . '/category/' . $category->file)
                ->aggregateRating(Schema::aggregateRating()
                    ->ratingValue($category->getSchemaRatingChildren($res))
                    ->reviewCount($category->getSchemaCountReviewsChildren($res)))
                ->offers(Schema::AggregateOffer()
                    ->highPrice($category->getChildrenHighPrice($res))
                    ->lowPrice($category->getChildrenLowPrice($res))
                    ->offerCount($products_all)
                    ->priceCurrency("UAH")
                    ->offers($offers));
            Yii::$app->params['schema'] = $productList->toScript();
        }
    }

    protected function setCatalogProductSchema($category, $products_all)
    {
        $language = Yii::$app->session->get('_language');

        if ($language !== 'uk') {
            $url = Yii::$app->request->hostInfo . '/' . $language;
        } else {
            $url = Yii::$app->request->hostInfo;
        }

        $url = rtrim($url, '/') . '/';

        $results = Product::find()->where(['category_id' => $category->id])->all();
        $offers = [];
        foreach ($results as $product) {

            $offer = [
                "url" => $url . 'product/' . $product->slug
            ];
            $offers[] = $offer;
        }

        $productList = Schema::Product()
            ->name($category->name)
            ->url($url)
            ->description($category->description)
            ->image(Yii::$app->request->hostInfo . '/category/' . $category->file)
            ->aggregateRating(Schema::aggregateRating()
                ->ratingValue($category->getSchemaRatingCategory($category->id))
                ->reviewCount($category->getSchemaCountReviewsCategory($category->id)))
            ->offers(Schema::AggregateOffer()
                ->highPrice($category->getCatalogHighPrice($category->id))
                ->lowPrice($category->getCatalogLowPrice($category->id))
                ->offerCount($products_all)
                ->priceCurrency("UAH")
                ->offers($offers));
        Yii::$app->params['schema'] = $productList->toScript();
    }

    protected function setAuxiliaryCatalogProductSchema($category, $products_all, $productsId)
    {
        $language = Yii::$app->session->get('_language');

        if ($language !== 'uk') {
            $url = Yii::$app->request->hostInfo . '/' . $language;
        } else {
            $url = Yii::$app->request->hostInfo;
        }

        $url = rtrim($url, '/') . '/';

        $results = Product::find()->where(['id' => $productsId])->all();
        $offers = [];
        foreach ($results as $product) {
            $offer = [
                "url" => $url . 'product/' . $product->slug
            ];
            $offers[] = $offer;
        }

        $productList = Schema::Product()
            ->name($category->name)
            ->url($url . 'auxiliary-product-list/' . $category->slug)
            ->description($category->description)
            ->image(Yii::$app->request->hostInfo . '/auxiliary-categories/' . $category->image)
            ->aggregateRating(Schema::aggregateRating()
                ->ratingValue($category->getSchemaRatingCategory($productsId))
                ->reviewCount($category->getSchemaCountReviewsCategory($productsId)))
            ->offers(Schema::AggregateOffer()
                ->highPrice($category->getCatalogHighPrice($productsId))
                ->lowPrice($category->getCatalogLowPrice($productsId))
                ->offerCount($products_all)
                ->priceCurrency("UAH")
                ->offers($offers));

        Yii::$app->params['schema'] = $productList->toScript();
    }

    protected function setCatalogBreadCrumbSchema($category)
    {

        $language = Yii::$app->session->get('_language');

        if ($language !== 'uk') {
            $url = Yii::$app->request->hostInfo . '/' . $language;
        } else {
            $url = Yii::$app->request->hostInfo;
        }

        $url = rtrim($url, '/') . '/';

        if (isset($category->parent->name)) {
            $schemaBreadcrumb = Schema::breadcrumbList()
                ->itemListElement([
                    Schema::listItem()
                        ->position(1)
                        ->item(Schema::thing()->name(Yii::t('app', 'Головна'))
                            ->url($url)
                            ->setProperty('id', $url)),
                    Schema::listItem()
                        ->position(2)
                        ->item(Schema::thing()->name($category->parent->name)
                            ->url(Url::to(['category/children', 'slug' => $category->parent->slug]))
                            ->setProperty('id', Url::to(['category/children', 'slug' => $category->parent->slug]))),
                    Schema::listItem()
                        ->position(3)
                        ->item(Schema::thing()->name($category->name)
                            ->url(Url::to(['category/catalog', 'slug' => $category->slug]))
                            ->setProperty('id', Url::to(['category/catalog', 'slug' => $category->slug]))),
                ]);
        } else {
            $schemaBreadcrumb = Schema::breadcrumbList()
                ->itemListElement([
                    Schema::listItem()
                        ->position(1)
                        ->item(Schema::thing()->name(Yii::t('app', 'Головна'))
                            ->url($url)
                            ->setProperty('id', $url)),
                    Schema::listItem()
                        ->position(2)
                        ->item(Schema::thing()->name(Yii::t('app', 'Категорії'))
                            ->url(Url::to(['category/list']))
                            ->setProperty('id', Url::to(['category/list']))),
                    Schema::listItem()
                        ->position(3)
                        ->item(Schema::thing()->name($category->name)
                            ->url(Url::to(['category/catalog', 'slug' => $category->slug]))
                            ->setProperty('id', Url::to(['category/catalog', 'slug' => $category->slug]))),
                ]);
        }

        Yii::$app->params['breadcrumb'] = $schemaBreadcrumb->toScript();
    }

    protected function setAuxiliaryCatalogBreadCrumbSchema($category, $breadcrumbCategory)
    {
        $language = Yii::$app->session->get('_language');

        if ($language !== 'uk') {
            $url = Yii::$app->request->hostInfo . '/' . $language;
        } else {
            $url = Yii::$app->request->hostInfo;
        }

        $url = rtrim($url, '/') . '/';

        $schemaBreadcrumb = Schema::breadcrumbList()
            ->itemListElement([
                Schema::listItem()
                    ->position(1)
                    ->item(Schema::thing()->name(Yii::t('app', 'Головна'))
                        ->url($url)
                        ->setProperty('id', $url)),
                Schema::listItem()
                    ->position(2)
                    ->item(Schema::thing()->name($breadcrumbCategory->name)
                        ->url(Url::to(['category/catalog', 'slug' => $breadcrumbCategory->slug]))
                        ->setProperty('id', Url::to(['category/catalog', 'slug' => $breadcrumbCategory->slug]))),
                Schema::listItem()
                    ->position(3)
                    ->item(Schema::thing()->name($category->name)
                        ->url(Url::to(['category/auxiliary-catalog', 'slug' => $category->slug]))
                        ->setProperty('id', Url::to(['category/auxiliary-catalog', 'slug' => $category->slug]))),
            ]);

        Yii::$app->params['breadcrumb'] = $schemaBreadcrumb->toScript();
    }

    protected function setCategoryMetamaster($category, $imageMetamaster)
    {
        Yii::$app->metamaster
            ->setSiteName('AgroPro')
            ->setType('website')
            ->setTitle($category->pageTitle)
            ->setDescription($category->metaDescription)
            ->setImage($imageMetamaster)
            ->register(Yii::$app->getView());
    }
}
