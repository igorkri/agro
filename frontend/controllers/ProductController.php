<?php

namespace frontend\controllers;

use Spatie\SchemaOrg\Schema;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\shop\Product;

class ProductController extends Controller
{
    public function actionView($slug): string
    {

        $product = Product::find()->with(['category.parent', 'images'])->where(['slug' => $slug])->one(); //all products

        $schemaProduct = Schema::product()
            ->name($product->name)
            ->image($product->getSchemaImg($product->id))
            ->description($product->seo_description)
            ->sku($product->id)
            ->mpn($product->id . '-' . $product->id)
            ->brand(Schema::brand()->name('Brand'))
            ->review(Schema::review()
                ->reviewRating(Schema::rating()->ratingValue(4)->bestRating(5))
                ->author(Schema::person()->name('Tatyana Khalimon'))
            )
            ->aggregateRating(Schema::aggregateRating()->ratingValue('4.4')->reviewCount('68'))
            ->offers(Schema::offer()
                ->url(Yii::$app->request->absoluteUrl)
                ->priceCurrency("UAH")
                ->price($product->price)
                ->priceValidUntil(date('Y-m-d', strtotime("+1 month")))
                ->itemCondition('https://schema.org/NewCondition')
                ->availability("https://schema.org/InStock")
            );

        Yii::$app->params['schema'] = $schemaProduct->toScript();

        Yii::$app->metamaster
            ->setTitle($product->name)
            ->setDescription($product->seo_description)
            ->setImage($product->getImgOne($product->id))
            ->register(Yii::$app->getView());

        return $this->render('_index', [
            'product' => $product,
            'isset_to_cart' => $product->getIssetToCart($product->id),
//            'schemaProduct' => $schemaProduct->toScript()
        ]);
    }

}
