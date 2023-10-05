<?php

namespace frontend\controllers;

use common\models\shop\ProductProperties;
use Spatie\SchemaOrg\LocalBusiness;
use common\models\shop\Product;
use common\models\shop\Review;
use common\models\shop\Brand;
use Spatie\SchemaOrg\Schema;
use yii\i18n\Formatter;
use yii\web\Controller;
use Yii;

class ProductController extends Controller
{
    public function actionView($slug): string
    {
        $product = Product::find()->with(['category.parent', 'images'])->where(['slug' => $slug])->one();
        $product_properties = ProductProperties::find()->where(['product_id' => $product->id])->orderBy('sort ASC')->all();
        $img_brand = Brand::find()->where(['id' => $product->brand_id])->one();
        $model_review = new Review();

        $localBusiness = new LocalBusiness();
        $localBusiness
            ->name('AgroPro')
            ->address('Україна Полтава вул.Зіньківська 35, ін:36000')
            ->telephone('+3(066)394-18-28')
            ->image(Yii::$app->request->hostInfo . '/images/logos/meta_logo.jpg')
            ->url('https://agropro.org.ua/')
            ->logo(Yii::$app->request->hostInfo . '/images/logos/logoagro.jpg')
            ->priceRange("UAH");

        $reviews = [];
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

        $schemaProduct = Schema::product()
            ->name($product->name)
            ->image($product->getSchemaImg($product->id))
            ->description($product->seo_description)
            ->sku($product->sku)
            ->mpn($product->id . '-' . $product->id)
            ->brand(Schema::brand()->name($product->brand ? $product->brand->name : 'Brand'))
            ->review($reviews)
            ->aggregateRating(Schema::aggregateRating()
                ->ratingValue($product->getSchemaRating($product->id))
                ->reviewCount($product->getSchemaCountReviews($product->id)))
            ->offers(Schema::offer()
                ->url(Yii::$app->request->absoluteUrl)
                ->priceCurrency("UAH")
                ->price($product->getPrice())
                ->priceValidUntil(date('Y-m-d', strtotime("+1 month")))
                ->seller($localBusiness)
                ->itemCondition('https://schema.org/NewCondition')
                ->availability("https://schema.org/InStock")
                ->shippingDetails(Schema::offerShippingDetails()
                    ->shippingLabel('Доставка по тарифу перевізника')
                    ->deliveryTime('1-3 рабочих дня')
                    ->shippingDestination('Україна')
                    ->shippingRate('По тарифу перевізника')));

        Yii::$app->params['schema'] = $schemaProduct->toScript();

        Yii::$app->metamaster
            ->setTitle($product->seo_title)
            ->setDescription($product->seo_description)
            ->setImage($product->getImgSeo($product->id))
            ->register(Yii::$app->getView());

        return $this->render('index', [
            'product' => $product,
            'isset_to_cart' => $product->getIssetToCart($product->id),
            'model_review' => $model_review,
            'product_properties' => $product_properties,
            'img_brand' => $img_brand
        ]);
    }

}
