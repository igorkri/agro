<?php

namespace frontend\controllers;

use common\models\Settings;
use common\models\shop\Product;
use common\models\shop\ProductProperties;
use Yii;

class CompareController extends BaseFrontendController
{
    public function actionView()
    {
        $language = Yii::$app->session->get('_language');
        $compareList = Yii::$app->session->get('compareList', []);

        $categories_id = [];
        $products = Product::find()->where(['id' => $compareList])->all();

        foreach ($products as $product) {
            $categories_id[] = $product->category_id;
        }
        $categories_id = array_unique($categories_id);
        $properties = ProductProperties::find()
            ->select('properties')
            ->where(['category_id' => $categories_id])
            ->orderBy(['sort' => SORT_ASC])
            ->asArray()
            ->all();

        $newArray = [];
        foreach ($properties as $innerArray) {
            foreach ($innerArray as $value) {
                $newArray[] = $value;
            }
        }
        $properties = array_unique($newArray);

        $products = $this->translateProduct($products, $language);

        $seo = Settings::seoPageTranslate('compare');
        $type = 'website';
        $title = $seo->title;
        $description = $seo->description;
        $image = '';
        $keywords = '';
        Settings::setMetamaster($type, $title, $description, $image, $keywords);

        $page_description = $seo->page_description;

        return $this->render('view',
            [
                'products' => $products,
                'properties' => $properties,
                'page_description' => $page_description,
            ]);
    }

    public function actionAddToCompare()
    {
        $id = Yii::$app->request->post('id');

        $session = Yii::$app->session;

        // Инициализируем массив сравнения в сессии, если его еще нет
        if (!$session->has('compareList')) {
            $session->set('compareList', []);
        }

        $compareList = $session->get('compareList');

        // Добавляем товар в список сравнения, если его там еще нет
        if (!in_array($id, $compareList)) {
            $compareList[] = $id;
            $session->set('compareList', $compareList);
        }

        return $this->asJson(
            [
                'success' => true,
                'compareCount' => count($compareList),
            ]);
    }

    public function actionDeleteFromCompare()
    {
        $id = Yii::$app->request->post('id');

        $session = Yii::$app->session;
        $compareList = $session->get('compareList', []);

        $index = array_search($id, $compareList);

        if ($index !== false) {
            unset($compareList[$index]);
            $session->set('compareList', $compareList);

            $categories_id = [];
            $products = Product::find()->where(['id' => $compareList])->all();

            foreach ($products as $product) {
                $categories_id[] = $product->category_id;
            }
            $categories_id = array_unique($categories_id);
            $properties = ProductProperties::find()
                ->select('properties')
                ->where(['category_id' => $categories_id])
                ->orderBy(['sort' => SORT_ASC])
                ->asArray()
                ->all();

            $newArray = [];
            foreach ($properties as $innerArray) {
                foreach ($innerArray as $value) {
                    $newArray[] = $value;
                }
            }
            $properties = array_unique($newArray);
            return $this->asJson([
                'success' => true,
                'compareListHtml' => $this->renderPartial('_compareList',
                    [
                        'compareList' => $compareList,
                        'products' => $products,
                        'properties' => $properties,
                    ]),
                'compareCount' => count($compareList), // Отправляем количество продуктов в сравнении
            ]);
        }

        // Если товар не найден, отправляем JSON-ответ с ошибкой
        return $this->asJson(['success' => false]);
    }

}