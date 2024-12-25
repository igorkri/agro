<?php

namespace frontend\controllers;

use common\models\Settings;
use common\models\shop\AnalogProducts;
use common\models\shop\Product;
use common\models\shop\Review;
use common\models\shop\Brand;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class ProductController extends Controller
{
    public function actionView($slug): string
    {
        $language = Yii::$app->session->get('_language');

        $product = Product::find()->with(['category.parent', 'images'])->where(['slug' => $slug])->one();

        if ($product === null) {
            throw new NotFoundHttpException('Product not found ' . '" ' . $slug . ' "');
        }

        $analog = AnalogProducts::find()->select('analog_product_id')->where(['product_id' => $product->id])->asArray()->all();
        $analog = ArrayHelper::getColumn($analog, 'analog_product_id');
        $products_analog = Product::find()->with(['category.parent', 'images'])->where(['id' => $analog])->all();
        $products_analog_count = count($products_analog);

        $images = $product->images;
        $priorities = array_column($images, 'priority');
        array_multisort($priorities, SORT_ASC, $images);

        $product_properties = $product->properties;
        $img_brand = Brand::find()->where(['id' => $product->brand_id])->one();
        $model_review = new Review();

        if ($language !== 'uk') {
            $this->getProductTranslation($product, $language, $product_properties);
        }

        $schemaBreadcrumb = $product->getSchemaBreadcrumb();
        Yii::$app->params['breadcrumb'] = $schemaBreadcrumb->toScript();

        $schemaProduct = $product->getSchemaProduct();
        Yii::$app->params['product'] = $schemaProduct->toScript();

        $type = 'product';
        $title = $product->seo_title;
        $description = $product->seo_description;
        $image = $product->getImgSeo($product->id);
        $keywords = '';
        Settings::setMetamaster($type, $title, $description, $image, $keywords);

        $this->setAlernateUrl($slug);

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

    protected function getProductTranslation($product, $language, $product_properties)
    {
        if ($product) {
            $translationProd = $product->getTranslation($language)->one();
            if ($translationProd) {
                if ($translationProd->name) {
                    $product->name = $translationProd->name;
                }
                if ($translationProd->description) {
                    $product->description = $translationProd->description;
                }
                if ($translationProd->short_description) {
                    $product->short_description = $translationProd->short_description;
                }
                if ($translationProd->footer_description) {
                    $product->footer_description = $translationProd->footer_description;
                }
                if ($translationProd->seo_title) {
                    $product->seo_title = $translationProd->seo_title;
                }
                if ($translationProd->seo_description) {
                    $product->seo_description = $translationProd->seo_description;
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
            if ($product->category->parent) {
                $translationCatParent = $product->category->parent->getTranslation($language)->one();
                if ($translationCatParent) {
                    if ($translationCatParent->name) {
                        $product->category->parent->name = $translationCatParent->name;
                    }
                }
            }
        }
        if ($product_properties) {
            foreach ($product_properties as $property) {
                $translationProperty = $property->getTranslation($language)->one();
                if ($translationProperty) {
                    if ($translationProperty->properties) {
                        $property->properties = $translationProperty->properties;
                    }
                    if ($translationProperty->value) {
                        $property->value = $translationProperty->value;
                    }
                }
            }
        }
    }

    protected function setAlernateUrl($slug)
    {
        $url = Yii::$app->request->hostInfo;
        $ukUrl = $url . '/product/' . $slug;
        $enUrl = $url . '/en/product/' . $slug;
        $ruUrl = $url . '/ru/product/' . $slug;

        $alternateUrls = [
            'ukUrl' => $ukUrl,
            'enUrl' => $enUrl,
            'ruUrl' => $ruUrl,
        ];

        Yii::$app->params['alternateUrls'] = $alternateUrls;
    }

}
