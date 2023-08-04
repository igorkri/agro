<?php


namespace frontend\widgets;


use common\models\shop\Product;
use common\models\shop\ProductGrup;
use yii\base\Widget;

class ColumnsBestsellers extends Widget  //  Інсектициди
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {

        $products_grup = ProductGrup::find()
            ->select('product_id')
            ->where(['grup_id' => 6])            //  Перша_Группа_Тест
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
            ])
            ->with('label')
            ->where(['id' => $products_grup])
            ->limit(3)
            ->all();

        return $this->render('columns-bestsellers', ['products' => $products]);
    }


}