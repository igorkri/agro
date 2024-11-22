<?php

use common\models\shop\ActivePages;
use common\models\shop\Product;

/** @var Product $products */

ActivePages::setActiveUser();

echo '<?xml version="1.0" encoding="UTF-8"?>';

?>

<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
    <channel>
        <title>Інтернет магазин AgroPro</title>
        <description>Інтернет магазин засобів захисту рослин</description>
        <link><?= Yii::$app->request->hostInfo ?></link>
        <?php foreach ($products as $product) : ?>
            <item>
                <g:id><?= $product->sku ?></g:id>
                <g:mpn><?= $product->id . '-' . $product->id ?></g:mpn>
                <title><?= $product->category->prefix . ' ' . $product->name ?></title>
                <link><?= Yii::$app->request->hostInfo . '/product/' . $product->slug ?></link>
                <g:description>
                        <![CDATA[<?= $product->short_description ?>]]>
                </g:description>
                <g:price><?= $product->price ?> UAH</g:price>
                <g:image_link><?= $product->getImgOne($product->id) ?></g:image_link>
                <?php if (isset($product->brand->name)) : ?>
                    <g:brand><?= $product->brand->name ?></g:brand>
                <?php endif; ?>
                <?php if ($product->status->id == 1) : ?>
                    <g:availability>in_stock</g:availability>
                <?php else : ?>
                    <g:availability>out_of_stock</g:availability>
                <?php endif; ?>
                <g:shipping>
                    <g:price>40.00</g:price>
                </g:shipping>
                <g:shipping_label>+доставка</g:shipping_label>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>