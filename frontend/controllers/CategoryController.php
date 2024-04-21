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

        return $this->render('list', ['categories' => $categories]);
    }

    public function actionChildren($slug)
    {
        $category = Category::find()
            ->with(['parents', 'parent', 'products'])
            ->where(['slug' => $slug])
            ->one();

        $this->setChildrenProductSchema($category);
        $this->setChildrenMetamaster($category);

        return $this->render('children', ['category' => $category]);
    }

    public function actionCatalog($slug)
    {
//        Yii::$app->session->removeAll();
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

        $this->setCatalogBreadCrumbSchema($category);
        $this->setCatalogProductSchema($category, $products_all);
        $this->setCatalogMetamaster($category);

        return $this->render('catalog',
            compact([
                'products',
                'category',
                'pages',
                'products_all',
                'propertiesFilter',
                'auxiliaryCategories',
            ]));
    }

    public function actionAuxiliaryCatalog($slug)
    {
//        Yii::$app->session->removeAll();
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

        $this->setAuxiliaryCatalogBreadCrumbSchema($category, $breadcrumbCategory);
        $this->setAuxiliaryCatalogProductSchema($category, $products_all, $productsId);
        $this->setAuxiliaryCatalogMetamaster($category);

        return $this->render('view',
            compact([
                'products',
                'category',
                'pages',
                'products_all',
                'breadcrumbCategory',
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
                "url" => Yii::$app->request->hostInfo . '/product/' . $product->slug
            ];
            $offers[] = $offer;
        }

        $products_all = count($offers);

        if ($res) {
            $productList = Schema::Product()
                ->name($category->name)
                ->url(Yii::$app->request->hostInfo . '/catalog/' . $category->slug)
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

    protected function setChildrenMetamaster($category)
    {
        Yii::$app->metamaster
            ->setSiteName('AgroPro')
            ->setType('website')
            ->setTitle($category->pageTitle)
            ->setDescription($category->metaDescription)
            ->setImage('/category/' . $category->file)
            ->register(Yii::$app->getView());
    }

    protected function setCatalogBreadCrumbSchema($category)
    {
        if (isset($category->parent->name)) {
            $schemaBreadcrumb = Schema::breadcrumbList()
                ->itemListElement([
                    Schema::listItem()
                        ->position(1)
                        ->item(Schema::thing()->name('Головна')
                            ->url(Yii::$app->homeUrl)
                            ->setProperty('id', Yii::$app->homeUrl)),
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
                        ->item(Schema::thing()->name('Головна')
                            ->url(Yii::$app->homeUrl)
                            ->setProperty('id', Yii::$app->homeUrl)),
                    Schema::listItem()
                        ->position(2)
                        ->item(Schema::thing()->name('Категорії')
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

    protected function setCatalogProductSchema($category, $products_all)
    {
        $results = Product::find()->where(['category_id' => $category->id])->all();
        $offers = [];
        foreach ($results as $product) {
            $offer = [
                "url" => Yii::$app->request->hostInfo . '/product/' . $product->slug
            ];
            $offers[] = $offer;
        }

        $productList = Schema::Product()
            ->name($category->name)
            ->url(Yii::$app->request->hostInfo . '/product-list/' . $category->slug)
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

    protected function setCatalogMetamaster($category)
    {
        Yii::$app->metamaster
            ->setSiteName('AgroPro')
            ->setType('website')
            ->setTitle($category->pageTitle)
            ->setDescription($category->metaDescription)
            ->setImage('/category/' . $category->file)
            ->register(Yii::$app->getView());
    }

    protected function setAuxiliaryCatalogBreadCrumbSchema($category, $breadcrumbCategory)
    {
        $schemaBreadcrumb = Schema::breadcrumbList()
            ->itemListElement([
                Schema::listItem()
                    ->position(1)
                    ->item(Schema::thing()->name('Головна')
                        ->url(Yii::$app->homeUrl)
                        ->setProperty('id', Yii::$app->homeUrl)),
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

    protected function setAuxiliaryCatalogProductSchema($category, $products_all, $productsId)
    {
        $results = Product::find()->where(['id' => $productsId])->all();
        $offers = [];
        foreach ($results as $product) {
            $offer = [
                "url" => Yii::$app->request->hostInfo . '/product/' . $product->slug
            ];
            $offers[] = $offer;
        }

        $productList = Schema::Product()
            ->name($category->name)
            ->url(Yii::$app->request->hostInfo . '/auxiliary-product-list/' . $category->slug)
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

    protected function setAuxiliaryCatalogMetamaster($category)
    {
        Yii::$app->metamaster
            ->setSiteName('AgroPro')
            ->setType('website')
            ->setTitle($category->pageTitle)
            ->setDescription($category->metaDescription)
            ->setImage('/auxiliary-categories/' . $category->image)
            ->register(Yii::$app->getView());
    }
}
