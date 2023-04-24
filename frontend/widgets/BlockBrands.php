<?php


namespace frontend\widgets;

use common\models\shop\Brand;
use yii\base\Widget;

class BlockBrands extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
$brands = Brand::find()->all();
        return $this->render('block-brands', ['brands' => $brands]);
    }


}