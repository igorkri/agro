<?php


namespace backend\widgets;


use common\models\shop\Brand;
use yii\helpers\VarDumper;

class BrandOrders extends \yii\base\Widget
{
    public function init() {

        parent::init();

    }

    public function run() {

        /**
         * $brand->getIncomeOrderBrand($brand->id)
         * $brand->getProductOrderBrand($brand->id)
         * $brand->getColorBrand($i)
         */

        $brands = Brand::find()->all();

        $carts = [];
        $i = 0;
        foreach ($brands as $brand){
            $carts[] = [
                "label" => $brand->name,
                "value" => $brand->getIncomeOrderBrand($brand->id),
                "color" => $brand->getColorBrand($i),
                "orders" => $brand->getProductOrderBrand($brand->id),

            ];
            $i++;
        }


        return $this->render('brand-orders', ['brands' => $brands, 'carts' => json_encode($carts)]);
    }

}

