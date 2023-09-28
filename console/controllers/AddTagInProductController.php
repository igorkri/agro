<?php


namespace console\controllers;


use common\models\shop\Product;
use common\models\shop\ProductProperties;
use common\models\shop\ProductTag;
use common\models\shop\Tag;

class AddTagInProductController extends \yii\console\Controller
{
    public function actionTag()
    {
        $i = 1;
        $tags = Tag::find()->all();
        foreach ($tags as $tag) {
            $products = ProductProperties::find()
                ->where(['LIKE', 'value', $tag->name])
                ->all();
            foreach ($products as $product) {
                $product_tag = ProductTag::find()->where(['and', ['product_id' => $product->product_id], ['tag_id' => $tag->id]])->one();
                if (!$product_tag) {
                    $tag_new = new ProductTag();
                    $tag_new->product_id = $product->product_id;
                    $tag_new->tag_id = $tag->id;
                   if ($tag_new->save()){
                       echo $i++ . "\t" . ' Тег ' . $tag->name . ' добавлен товару ' . $product->product_id . "\n";
                   }
                }
            }

        }

    }
}
