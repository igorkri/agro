<?php

namespace frontend\controllers;

use common\models\shop\Category;
use common\models\shop\Product;
use common\models\shop\Review;
use Spatie\SchemaOrg\Schema;
use Yii;
use yii\data\Pagination;
use yii\db\Expression;
use yii\i18n\Formatter;
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
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

        $index = 1;
        foreach ($products as $product) {
            $product_reviews = Review::find()->where(['product_id' => $product->id])->all();
            if ($product_reviews) {
                foreach ($product_reviews as $product_review) {
                    $formatter = new Formatter();
                    $schemaDate = $formatter->asDatetime($product_review->created_at, 'php:Y-m-d\TH:i:sP');

                    $reviews[] = Schema::review()
                        ->datePublished($schemaDate)
                        ->reviewBody($product_review->message)
                        ->author(Schema::person()
                            ->name($product_review->name))
                        ->reviewRating(Schema::rating()
                            ->ratingValue($product_review->rating)
                            ->bestRating(5)
                            ->worstRating(1)
                        );
                }
            } else {
                $reviews[] = Schema::review()
                    ->author(Schema::person()
                        ->name('Tatyana Khalimon')
                        ->datePublished('2023-06-07')
                        ->reviewBody('Все ОК. Гарний товар.')
                        ->reviewRating(Schema::rating()
                            ->ratingValue(4)
                            ->bestRating(5)
                            ->worstRating(1)
                        )
                    );
            }

            $productSchema = Schema::Product()
                ->position($index)
                ->name($product->name)
                ->url(Yii::$app->request->hostInfo . '/product/' . $product->slug)
                ->description($product->description)
                ->image($product->getSchemaImg($product->id))
                ->review($reviews)
                ->aggregateRating(Schema::aggregateRating()
                    ->ratingValue($product->getSchemaRating($product->id))
                    ->reviewCount($product->getSchemaCountReviews($product->id)));
            $itemListElement[] = $productSchema;
            $index++;
        }

        $categorySchema = Schema::ItemList()
            ->name($category->name)
            ->description($category->metaDescription)
            ->url(Yii::$app->request->hostInfo . '/product-list/' . $slug)
            ->image(Yii::$app->request->hostInfo . '/category/' . $category->file)
            ->itemListElement($itemListElement);

        Yii::$app->params['schema'] = $categorySchema->toScript();


        Yii::$app->metamaster
            ->setTitle($category->pageTitle)
            ->setDescription($category->metaDescription)
            ->setImage('/category/' . $category->file)
            ->register(Yii::$app->getView());

        return $this->render('catalog_dev', compact(['products', 'category', 'pages', 'products_all']));
    }

}
