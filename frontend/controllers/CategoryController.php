<?php

namespace frontend\controllers;

use common\models\shop\Brand;
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
            ->setTitle("Категорії Товарів інтернет-магазину | AgroPro")
            ->setDescription("AgroPro - ваш інтернет-магазин для ЗЗР, добрив, посівного матеріалу та боротьби з гризунами. Оптимізуйте виробництво з нами!")
            ->register(Yii::$app->getView());

        return $this->render('list', ['categories' => $categories]);
    }

    public function actionChildren($slug)
    {
        $category = Category::find()
            ->with(['parents', 'parent', 'products'])
            ->where(['slug' => $slug])
            ->one();

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

        Yii::$app->metamaster
            ->setTitle($category->pageTitle)
            ->setDescription($category->metaDescription)
            ->setImage('/category/' . $category->file)
            ->register(Yii::$app->getView());

        return $this->render('children', ['category' => $category]);

    }

    public function actionCatalog($slug, $sort = null, $count = '12')
    {
        $minPrice = Product::find()->min('price');
        $maxPrice = Product::find()->max('price');

        $count = intval($count);

        $category = Category::find()->where(['slug' => $slug])->one();

        $query = Product::find()->where(['category_id' => $category->id]);


        $brands_id = Product::find()->select('brand_id')->where(['category_id' => $category->id])->asArray()->all();

        $id = [];

        foreach ($brands_id as $item) {
            $id[] = $item['brand_id'];
        }

        $id = array_values(array_unique($id));


        $brands = Brand::find()->where(['id' => $id])->all();

        if ($sort === 'price_lowest') {
            $query->orderBy(['price' => SORT_ASC]);
        } elseif ($sort === 'price_highest') {
            $query->orderBy(['price' => SORT_DESC]);
        } else {
            $query->orderBy([new Expression('FIELD(status_id, 1, 3, 4, 2)')]);
        }

        $results = $query->all();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $count]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

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

        Yii::$app->metamaster
            ->setTitle($category->pageTitle)
            ->setDescription($category->metaDescription)
            ->setImage('/category/' . $category->file)
            ->register(Yii::$app->getView());

        return $this->render('catalog',
            compact([
                'products',
                'category',
                'pages', 'products_all',
                'brands',
                'minPrice',
                'maxPrice'
            ]));
    }
}
