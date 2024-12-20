<?php

namespace frontend\controllers;

use common\models\SeoPages;
use common\models\Settings;
use common\models\shop\Product;
use Yii;
use yii\base\BaseObject;
use yii\data\Pagination;
use yii\db\Expression;
use yii\web\Controller;

class SpecialController extends Controller
{
    public function actionView()
    {
        $language = Yii::$app->session->get('_language');

        if (!Yii::$app->session->has('sort')) {
            Yii::$app->session->set('sort', '');
        } else {
            if (Yii::$app->request->post('sort') !== null) {
                Yii::$app->session->set('sort', Yii::$app->request->post('sort'));
            }
        }
        $sort = Yii::$app->session->get('sort');

        if (!Yii::$app->session->has('count')) {
            Yii::$app->session->set('count', 12);
        } else {
            if (Yii::$app->request->post('count') !== null) {
                Yii::$app->session->set('count', Yii::$app->request->post('count'));
            }
        }
        $count = intval(Yii::$app->session->get('count'));

        $query = Product::find()
            ->andWhere(['not', ['label_id' => null]])
            ->orderBy([
                new Expression('FIELD(status_id, 1, 3, 4, 2)')
            ]);

        if ($sort === 'price_lowest') {
            $query->orderBy(['price' => SORT_ASC]);
        } elseif ($sort === 'price_highest') {
            $query->orderBy(['price' => SORT_DESC]);
        } elseif ($sort === 'name_a') {
            $query->orderBy(['name' => SORT_ASC]);
        } elseif ($sort === 'name_z') {
            $query->orderBy(['name' => SORT_DESC]);
        } else {
            $query->orderBy([new Expression('FIELD(status_id, 1, 3, 4, 2)')]);
        }

        $pages = new Pagination([
            'totalCount' => $query->count(), 'pageSize' => $count,
            'forcePageParam' => false, 'pageSizeParam' => false
        ]);

        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

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

        $seo = Settings::seoPageTranslate('special');
        Settings::setMetamaster($seo);
        $page_description = $seo->page_description;

        return $this->render('view', compact(['products', 'products_all', 'pages', 'language', 'page_description']));
    }

}

