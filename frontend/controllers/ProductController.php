<?php

namespace frontend\controllers;

use common\models\shop\ProductProperties;
use common\models\shop\AnalogProducts;
use common\models\shop\Product;
use common\models\shop\Review;
use common\models\shop\Brand;
use Spatie\SchemaOrg\Schema;
use yii\helpers\ArrayHelper;
use yii\i18n\Formatter;
use yii\web\Controller;
use yii\helpers\Url;
use Yii;

class ProductController extends Controller
{
    public function actionView($slug): string
    {
        $product = Product::find()->with(['category.parent', 'images'])->where(['slug' => $slug])->one();

        $analog = AnalogProducts::find()->select('analog_product_id')->where(['product_id' => $product->id])->asArray()->all();
        $analog = ArrayHelper::getColumn($analog, 'analog_product_id');
        $products_analog = Product::find()->with(['category.parent', 'images'])->where(['id' => $analog])->all();
        $products_analog_count = count($products_analog);

        $images = $product->images;
        $priorities = array_column($images, 'priority');
        array_multisort($priorities, SORT_ASC, $images);

        $product_properties = ProductProperties::find()->where(['product_id' => $product->id])->orderBy('sort ASC')->all();
        $img_brand = Brand::find()->where(['id' => $product->brand_id])->one();
        $model_review = new Review();

        $this->setProductSchemaBreadcrumb($product);
        $this->setSchemaProduct($product);
        $this->setProductMetadata($product);

        return $this->render('index', [
            'product' => $product,
            'images' => $images,
            'isset_to_cart' => $product->getIssetToCart($product->id),
            'model_review' => $model_review,
            'product_properties' => $product_properties,
            'img_brand' => $img_brand,
            'products_analog' => $products_analog,
            'products_analog_count' => $products_analog_count,
        ]);
    }

    protected function setProductMetadata($product)
    {
        Yii::$app->metamaster
            ->setTitle($product->seo_title)
            ->setDescription($product->seo_description)
            ->setImage($product->getImgSeo($product->id))
            ->register(Yii::$app->getView());
    }

    protected function setProductSchemaBreadcrumb($product)
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
                    ->item(Schema::thing()->name($product->category->name)
                        ->url(Url::to(['category/catalog', 'slug' => $product->category->slug]))
                        ->setProperty('id', Url::to(['category/catalog', 'slug' => $product->category->slug]))),
                Schema::listItem()
                    ->position(3)
                    ->item(Schema::thing()->name($product->name)
                        ->url(Url::to(['product/view', 'slug' => $product->slug]))
                        ->setProperty('id', Url::to(['product/view', 'slug' => $product->slug]))),
            ]);
        Yii::$app->params['breadcrumb'] = $schemaBreadcrumb->toScript();
    }

    protected function setSchemaProduct($product)
    {
        $reviews = [];
        $product_reviews = Review::find()->where(['product_id' => $product->id])->all();
        if ($product_reviews) {
            foreach ($product_reviews as $product_review) {
                $formatter = new Formatter();
                $schemaDate = [];
                $schemaDate[] = $formatter->asDatetime($product_review->created_at, 'php:Y-m-d\TH:i:sP');

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
        $itemCondition[] = 'NewCondition';
        $returnFees[] = 'FreeReturn';
        $returnPolicyCategory[] = 'MerchantReturnFiniteReturnWindow';
        $returnMethod[] = 'ReturnByMail';
        $priceValidUntil[] = date('Y-m-d', strtotime("+1 month"));
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
                ->priceValidUntil($priceValidUntil)
                ->itemCondition($itemCondition)
                ->availability($product->getAvailabilityProduct($product->status_id))
                ->hasMerchantReturnPolicy(Schema::merchantReturnPolicy()
                    ->name('Умови повернення')
                    ->description('У нашому онлайн-магазині ми надаємо вам можливість повернути будь-який придбаний товар. 
                    Відповідно до "Закону про захист прав споживачів", 
                    протягом перших 14 днів після покупки у нас ви можете здійснити обмін або повернення товару. 
                    Важливо зазначити, що ми приймаємо на обмін або повернення лише новий товар, 
                    який не має слідів використання і зберігає оригінальну комплектацію та упаковку.')
                    ->returnMethod($returnMethod)
                    ->merchantReturnDays(14)
                    ->returnFees($returnFees)
                    ->returnPolicyCategory($returnPolicyCategory)
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
                        ->addressRegion('Полтава')
                    )
                    ->shippingRate(Schema::monetaryAmount()
                        ->currency("UAH")
//                        ->value(100)
                    )
                )
            );
        Yii::$app->params['product'] = $schemaProduct->toScript();
    }
}
