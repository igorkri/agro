<?php

namespace backend\widgets;

use common\models\shop\Brand;

class BrandOrders extends \yii\base\Widget
{
    public function init()
    {

        parent::init();

    }

    public function run()
    {

        /**
         * $brand->getIncomeOrderBrand($brand->id)
         * $brand->getProductOrderBrand($brand->id)
         * $brand->getColorBrand($i)
         */

        $brands = Brand::find()->all();

        $carts = [];
        $i = 0;
        foreach ($brands as $brand) {
            $productOrderBrand = $brand->getProductOrderBrand($brand->id);
            $incomeOrderBrand = $brand->getIncomeOrderBrand($brand->id);
            if ($productOrderBrand != 0 && $incomeOrderBrand != 0) {
                $carts[] = [
                    "label" => $brand->name,
                    "value" => $incomeOrderBrand,
                    "color" => $brand->getColorBrand($i),
                    "orders" => $productOrderBrand,
                ];
                $i++;
            }
        }

        return $this->render('brand-orders', ['brands' => $brands, 'carts' => json_encode($carts)]);
    }

}

