<?php


namespace console\controllers;


use common\models\shop\Product;

class AddProductTableController extends \yii\console\Controller
{
    /**
     * Добавление  в footer карточки товара
     */
    public function actionFooterDescr()
    {
        $descr = '<p>---------------------------
</p>
<p><strong>Увага!!!</strong>  Для безпечного використання препарату (*name_product*) та досягнення максимальної ефективності його дії, слід строго дотримуватися інструкцій виробника та правил техніки безпеки при обробці хімічних речовин.
</p>
<p>Інтернет-магазин <a href="https://agropro.org.ua/">AgroPro</a> пропонує одні з найвигідніших цін на (*name_product*). Ви можете замовити необхідний препарат на нашому веб-сайті, і наші менеджери оперативно оброблять та доставлять ваше замовлення.
</p>
<p>Наші модератори дуже уважно перевіряють інформацію, перед тим як публікувати її на сайті. Однак, на жаль, дані про товар можуть змінюватися виробником без попередження, тому інтернет-магазин <a href="https://agropro.org.ua/">AgroPro</a> не несе відповідальності за точність опису, і наявна помилка не може служити підставою для повернення товару.
</p>';

        $products = Product::find()->all();
        $categories = [11, 20, 18, 26];
        foreach ($products as $product) {
            if (!in_array($product->category_id, $categories)) {
                $product->footer_description = $descr;
                $product->save();
                echo "\t" . $product->id . " Footer описание добавлено! \t" . $product->category_id . "\n";
            } else {
                echo "\t" . $product->id . " Footer описание НЕ добавлено! \t" . $product->category_id . "\n";
            }
        }
    }

    public function actionPackage()
    {
        $products = Product::find()->all();
        $categories = [22, 23, 24, 25];
        foreach ($products as $product) {
            if (!in_array($product->category_id, $categories)) {
                $product->package = 'BIG';
                $product->save();
                echo "\t" . $product->id . " BIG добавлено! \t" . $product->category_id . "\n";
            } else {
                $product->package = 'SMALL';
                $product->save();
                echo "\t" . $product->id . " SMALL добавлено! \t" . $product->category_id . "\n";
            }
        }
    }

    public function actionFindAndReplace()
    {
        $products = Product::find()
            ->where(['like', 'description', '%<h2>%', false]) // false означает, что чувствительность к регистру отключена
            ->all();

        if ($products) {
            foreach ($products as $product) {

                $product->description = str_replace('<h2>', '<h4>', $product->description);
                $product->description = str_replace('</h2>', '</h4>', $product->description);

                $product->save(false); // false отключает валидацию, использовать осторожно
                echo "\t" . $product->name . " Teg добавлено! \t" . "\n";
            }
        } else {
            echo "\t" . " Не работает! \t" . "\n";
        }

    }
}