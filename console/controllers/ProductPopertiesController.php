<?php

namespace console\controllers;

use common\models\shop\Category;
use common\models\shop\Product;
use common\models\shop\ProductProperties;
use yii\console\Controller;


class ProductPopertiesController extends Controller
{
    /**
     * Добавление ID Категории
     */
    public function actionAddCategoryID()
    {
        $i = 1;
        $properties = ProductProperties::find()->all();
        foreach ($properties as $property) {
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
        foreach ($properties as $property) {

            if ($property->properties == 'діюча речовина:')
                $property->sort = 1;

            if ($property->properties == 'тип:')
                $property->sort = 2;

            if ($property->properties == 'культура:')
                $property->sort = 3;

            if ($property->properties == 'об\'єкт:')
                $property->sort = 4;

            if ($property->properties == 'спосіб дії:')
                $property->sort = 5;

            if ($property->properties == 'препаративна форма:')
                $property->sort = 6;

            if ($property->properties == 'норма витрати:')
                $property->sort = 7;

            if ($property->properties == 'застосування:')
                $property->sort = 8;

            if ($property->properties == 'тара:')
                $property->sort = 9;

            if ($property->properties == 'склад:')
                $property->sort = 1;


            if ($property->save(false)) {
                echo "\t" . $i . " Порядок сортировки изменен \n";
                $i++;
            }
        }
    }

    /**
     * Форматирование характеристик
     */
    public function actionFormatProperties()
    {
        $cultura = [];
        $delimiter = ",";
        $properties = ProductProperties::find()->select(['properties', 'value'])->all();
        foreach ($properties as $property) {
            if ($property->properties == 'культура:' && $property->value != null) {
                $cultura[] = explode($delimiter, $property->value);
            }
        }

        // Новый массив
        $newArray = [];

// Обход внешнего массива
        foreach ($cultura as $innerArray) {
            // Обход вложенных массивов
            foreach ($innerArray as $value) {
                // Добавление значения в новый массив
                $newArray[] = $value;
            }
        }
        sort($newArray);
        $newArray = array_unique($newArray);

        echo "\t" . print_r($newArray) . "\n";
    }

    /**
     * Добавление новых характеристик
     */
    public function actionAddNewProperties()
    {
        $sort = 10;
        $catId = 5;

        $nameProperty = 'група:';
        $valueProperty = Category::find()->select('name')->where(['id' => $catId])->one();

        $productsId = ProductProperties::find()
            ->select('product_id')
            ->where(['category_id' => $catId])
            ->distinct()
            ->column();
        $i = 1;
        foreach ($productsId as $item) {
            $nameProduct = Product::find()->select('name')->where(['id' => $item])->one();
            $productProperty = ProductProperties::find()->select('properties')->where(['product_id' => $item])->all();
            $res = 0;
            foreach ($productProperty as $property) {
                if ($property->properties == $nameProperty) {
                    $res = 1;
                }
            }
            if ($res === 0) {
                $model = new ProductProperties();
                $model->product_id = $item;
                $model->properties = $nameProperty;
                $model->value = $valueProperty->name;
                $model->sort = $sort;
                $model->category_id = $catId;
                if ($model->save()) {
                    echo $i . " Новое свойство " . $nameProperty . " сохранено: Для продукта " . $nameProduct->name . "\n";
                    $i++;
                }else{
                    echo "ERROR: Для продукта " . $nameProduct->name . "\n";
                }
            }else{
                echo "### Свойство " . $nameProperty . " уже существует: Для продукта " . $nameProduct->name . "\n";
            }
        }
    }
}