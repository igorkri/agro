<?php

namespace frontend\controllers;

use common\models\shop\Brand;
use common\models\shop\ProductProperties;
use common\models\shop\Review;
use Spatie\SchemaOrg\Schema;
use Yii;
use yii\base\BaseObject;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\shop\Product;
use yii\web\Response;

class ProductController extends Controller
{
    public function actionView($slug): string
    {
        $product = Product::find()->with(['category.parent', 'images'])->where(['slug' => $slug])->one();
        $product_properties = ProductProperties::find()->where(['product_id' => $product->id])->all();

        $img_brand = Brand::find()->where(['id' => $product->brand_id])->one();

        $model_review = new Review();
        $schemaProduct = Schema::product()
            ->name($product->name)
            ->image($product->getSchemaImg($product->id))
            ->description($product->seo_description)
            ->sku($product->id)
            ->mpn($product->id . '-' . $product->id)
            ->brand(Schema::brand()->name($product->brand ? $product->brand->name : 'Brand'))
            ->review(Schema::review()
                ->reviewRating(Schema::rating()->ratingValue(4)->bestRating(5))
                ->author(Schema::person()->name('Tatyana Khalimon'))
            )
            ->aggregateRating(Schema::aggregateRating()->ratingValue('4.4')->reviewCount('68'))
            ->offers(Schema::offer()
                ->url(Yii::$app->request->absoluteUrl)
                ->priceCurrency("UAH")
                ->price($product->getPrice())
                ->priceValidUntil(date('Y-m-d', strtotime("+1 month")))
                ->itemCondition('https://schema.org/NewCondition')
                ->availability("https://schema.org/InStock")
            );

        Yii::$app->params['schema'] = $schemaProduct->toScript();

        Yii::$app->metamaster
            ->setTitle($product->seo_title)
            ->setDescription($product->seo_description)
            ->setImage($product->getImgOne($product->id))
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
