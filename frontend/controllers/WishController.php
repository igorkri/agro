<?php

namespace frontend\controllers;

use common\models\shop\Product;
use Yii;
use yii\web\Controller;

class WishController extends Controller
{
    public function actionView()
    {
        $language = Yii::$app->session->get('_language');
        $session = Yii::$app->session;
        $wishList = $session->get('wishList', []);

        $products = Product::find()->where(['id' => $wishList])->all();

        if ($language !== 'uk') {
            foreach ($products as $product) {
                if ($product) {
                    $translationProd = $product->getTranslation($language)->one();
                    if ($translationProd) {
                        if ($translationProd->name) {
                            $product->name = $translationProd->name;
                        }
                    }
                    $translationCat = $product->category->getTranslation($language)->one();
                    if ($translationCat) {
                        if ($translationCat->name) {
                            $product->category->name = $translationCat->name;
                        }
                        if ($translationCat->prefix) {
                            $product->category->prefix = $translationCat->prefix;
                        }
                    }
                }
            }
        }

        return $this->render('view',
            [
                'products' => $products,
            ]);
    }

    public function actionAddToWish()
    {
        $id = Yii::$app->request->post('id');

        $session = Yii::$app->session;

        // Инициализируем массив сравнения в сессии, если его еще нет
        if (!$session->has('wishList')) {
            $session->set('wishList', []);
        }

        $wishList = $session->get('wishList');

        // Добавляем товар в список сравнения, если его там еще нет
        if (!in_array($id, $wishList)) {
            $wishList[] = $id;
            $session->set('wishList', $wishList);
        }

        return $this->asJson(
            [
                'success' => true,
                'wishCount' => count($wishList),
            ]);
    }

    public function actionDeleteFromWish()
    {
        $id = Yii::$app->request->post('id');

        $session = Yii::$app->session;
        $wishList = $session->get('wishList', []);

        $index = array_search($id, $wishList);

        if ($index !== false) {
            unset($wishList[$index]);
            $session->set('wishList', $wishList);

            $products = Product::find()->where(['id' => $wishList])->all();

            return $this->asJson([
                'success' => true,
                'wishListHtml' => $this->renderPartial('_wishlist',
                    [
                        'wishList' => $wishList,
                        'products' => $products,
                    ]),
                'wishCount' => count($wishList),
            ]);
        }

        // Если товар не найден, отправляем JSON-ответ с ошибкой
        return $this->asJson(['success' => false]);
    }

}