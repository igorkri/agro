<?php

namespace frontend\controllers;

use common\models\shop\ProductProperties;
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
                        ->worstRating(1));
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
                        ->worstRating(1)));
        }

        $schemaProduct = Schema::product()
            ->name($product->name)
            ->url(Yii::$app->request->absoluteUrl)
            ->image($product->getSchemaImg($product->id))
            ->description($product->seo_description)
            ->sku($product->sku)
            ->mpn($product->id . '-' . $product->id)
            ->brand(Schema::brand()->name($product->brand ? $product->brand->name : 'AgroPro'))
            ->review($reviews)
            ->aggregateRating(Schema::aggregateRating()
                ->ratingValue($product->getSchemaRating($product->id))
                ->reviewCount($product->getSchemaCountReviews($product->id)))
            ->offers(Schema::offer()
                ->url(Yii::$app->request->absoluteUrl)
                ->image($product->getSchemaImg($product->id))
                ->priceCurrency("UAH")
                ->price($product->getPrice())
                ->priceValidUntil(date('Y-m-d', strtotime("+1 month")))
                ->itemCondition('https://schema.org/NewCondition')
                ->availability($product->getAvailabilityProduct($product->status_id))
                ->hasMerchantReturnPolicy(Schema::merchantReturnPolicy()
                    ->name('Умови повернення')
                    ->description('У нашому онлайн-магазині ми надаємо вам можливість повернути будь-який придбаний товар. 
                    Відповідно до "Закону про захист прав споживачів", 
                    протягом перших 14 днів після покупки у нас ви можете здійснити обмін або повернення товару. 
                    Важливо зазначити, що ми приймаємо на обмін або повернення лише новий товар, 
                    який не має слідів використання і зберігає оригінальну комплектацію та упаковку.')
                    ->returnMethod("ReturnByMail")
                    ->merchantReturnDays(14)
                    ->returnFees("http://schema.org/FreeReturn")
                    ->returnPolicyCategory("http://schema.org/MerchantReturnFiniteReturnWindow")
                    ->applicableCountry('UA')
                )
                ->shippingDetails(Schema::offerShippingDetails()
                    ->shippingLabel('Доставка по тарифу перевізника')
                    ->deliveryTime(Schema::shippingDeliveryTime()
                        ->transitTime(Schema::quantitativeValue()
                            ->unitCode('d')
                            ->minValue(1)
                            ->maxValue(10))
                        ->handlingTime(Schema::quantitativeValue()
                            ->unitCode('d')
                            ->minValue(1)
                            ->maxValue(2)
                        )
                    )
                    ->shippingDestination(Schema::definedRegion()
                        ->addressCountry('UA')
                        ->addressRegion(53)
                    )
                    ->shippingRate(Schema::monetaryAmount()
                        ->currency("UAH")
                        ->value(100)
                    )
                )
            );
        Yii::$app->params['product'] = $schemaProduct->toScript();

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
