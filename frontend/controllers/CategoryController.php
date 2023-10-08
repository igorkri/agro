<?php

namespace frontend\controllers;

use common\models\shop\Category;
use common\models\shop\Product;
use Spatie\SchemaOrg\Schema;
use Yii;
use yii\data\Pagination;
use yii\db\Expression;
use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionList()
    {
        $categories = Category::find()->with(['products'])->where(['is', 'parentId', new \yii\db\Expression('null')])->all();

        Yii::$app->metamaster
            ->setTitle("Категорії Товарів | AgroPro")
            ->setDescription("AgroPro - ваш інтернет-магазин для ЗЗР, добрив, посівного матеріалу та боротьби з гризунами. Оптимізуйте виробництво з нами!")
            ->register(Yii::$app->getView());

        return $this->render('list', ['categories' => $categories]);
    }

    public function actionChildren($slug)
    {

        $category = Category::find()
            ->with(['parents', 'parent', 'products'])
            ->where(['slug' => $slug])->one();

        debug_pr();

        $offers = [];
        foreach ($results as $product){
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
                ->highPrice($category->getCategoryHighPrice($category->id))
                ->lowPrice($category->getCategoryLowPrice($category->id))
                ->offerCount($products_all)
                ->priceCurrency("UAH")
                ->offers($offers));
        Yii::$app->params['productList'] = $productList->toScript();

        Yii::$app->metamaster
            ->setTitle($category->pageTitle)
            ->setDescription($category->metaDescription)
            ->setImage('/category/' . $category->file)
            ->register(Yii::$app->getView());

        return $this->render('children', ['category' => $category]);

    }

    public function actionCatalog($slug)
    {
        $category = Category::find()->where(['slug' => $slug])->one();
        $query = Product::find()
            ->where(['category_id' => $category->id])
            ->orderBy([
                new Expression('FIELD(status_id, 1, 3, 4, 2)')
            ]);
        $results = $query->all();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

        $offers = [];
        foreach ($results as $product){
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
                ->highPrice($category->getCategoryHighPrice($category->id))
                ->lowPrice($category->getCategoryLowPrice($category->id))
                ->offerCount($products_all)
                ->priceCurrency("UAH")
                ->offers($offers));
        Yii::$app->params['productList'] = $productList->toScript();


        Yii::$app->metamaster
            ->setTitle($category->pageTitle)
            ->setDescription($category->metaDescription)
            ->setImage('/category/' . $category->file)
            ->register(Yii::$app->getView());

        return $this->render('catalog', compact(['products', 'category', 'pages', 'products_all']));
//        return $this->render('catalog_dev', compact(['products', 'category', 'pages', 'products_all']));
    }

}
