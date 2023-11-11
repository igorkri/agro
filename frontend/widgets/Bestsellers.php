<?php


namespace frontend\widgets;


use common\models\shop\Product;
use common\models\shop\ProductGrup;
use yii\base\Widget;

class Bestsellers extends Widget  // Товари для Фермера
{

    public function init()
    {
        parent::init();

    }

    public function run() {

        $products_grup = ProductGrup::find()
            ->select('product_id')
            ->where(['grup_id' => 1])            //  Перша_Группа_Тест
            ->column();


        $products = Product::find()
            ->select([
                'id',
                'name',
                'slug',
                'price',
                'old_price',
                'status_id',
                'label_id',
                'currency',
                'category_id',
            ])
            ->with('label')
            ->where(['id' => $products_grup])
            ->limit(7)
            ->all();

        return $this->render('bestsellers', ['products' => $products]);
    }


}