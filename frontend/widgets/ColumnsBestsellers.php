<?php


namespace frontend\widgets;


use common\models\shop\Product;
use yii\base\Widget;

class ColumnsBestsellers extends Widget  //  Інсектециди
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {

        $products = Product::find()
            ->with('label')
            ->where(['category_id' => 7])
            ->andWhere(['IN', 'status_id', [1, 3, 4]])
            ->limit(3)
            ->all();

        return $this->render('columns-bestsellers', ['products' => $products]);
    }


}