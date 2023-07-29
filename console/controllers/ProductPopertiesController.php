<?php

namespace console\controllers;

use common\models\shop\Product;
use common\models\shop\ProductProperties;


class ProductPopertiesController extends \yii\console\Controller
{

    /**
     * Добавление ID Категории
     */
    public function actionAddCategoryID()
    {
        $i = 1;
        $properties = ProductProperties::find()->all();
        foreach ($properties as $property){
            $property->category_id = Product::find()->select('category_id')->where(['id' => $property->product_id]);

            if ($property->save(false)) {
                echo "\t" . $i . " Категория добавлена \n";
                $i++;
            }

        }


    }

    /**
     * Добавление Сортировки
     */
    public function actionSortProperties()
    {
        $i = 1;
        $properties = ProductProperties::find()->all();
        foreach ($properties as $property){

            if ($property->properties == 'діюча речовина:')
                $property->sort = 0;

            if ($property->properties == 'тип:')
                $property->sort = 1;

            if ($property->properties == 'культура:')
                $property->sort = 2;

            if ($property->properties == 'об\'єкт:')
                $property->sort = 3;

            if ($property->properties == 'спосіб дії:')
                $property->sort = 4;

            if ($property->properties == 'препаративна форма:')
                $property->sort = 5;

            if ($property->properties == 'норма витрати:')
                $property->sort = 6;

            if ($property->properties == 'застосування:')
                $property->sort = 7;

            if ($property->properties == 'тара:')
                $property->sort = 8;

            if ($property->properties == 'склад:')
                $property->sort = 1;


            if ($property->save(false)) {
                echo "\t" . $i . " Порядок сортировки изменен \n";
                $i++;
            }

        }


    }


}