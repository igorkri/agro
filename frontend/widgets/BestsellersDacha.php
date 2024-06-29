<?php


namespace frontend\widgets;

use common\models\shop\Product;
use common\models\shop\ProductGrup;
use Yii;
use yii\base\Widget;

class BestsellersDacha extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run() {

        $language =Yii::$app->session->get('_language');
        $title = 'Товари для Дачі';

        $products_grup = ProductGrup::find()
            ->select('product_id')
            ->where(['grup_id' => 7])
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

        return $this->render('bestsellers',
            [
                'products' => $products,
                'title' => $title,
                'language' => $language,
            ]);
    }


}