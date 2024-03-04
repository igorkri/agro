<?php

namespace frontend\controllers;

use common\models\shop\ProductProperties;
use common\models\shop\ProductTag;
use common\models\shop\Product;
use common\models\shop\Tag;
use common\models\Posts;
use yii\data\Pagination;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\Response;
use Yii;

class SearchController extends Controller
{

    public function actionSuggestions($q = null)
    {
        if ($q) {
            $pr_tags = Tag::find()->where(['like', 'name', $q])->asArray()->all();
            $id_tag = [];
            foreach ($pr_tags as $pr_tag) {
                $id_tag[] = $pr_tag['id'];
            }
            $tag_products = ProductTag::find()->where(['in', 'tag_id', $id_tag])->asArray()->all();
            $id_prod = [];
            foreach ($tag_products as $product) {
                $id_prod[] = $product['product_id'];
            }
            $val_products = ProductProperties::find()->where(['like', 'value', $q])->asArray()->all();
            foreach ($val_products as $product) {
                $id_prod[] = $product['product_id'];
            }
            $sku_products = Product::find()->where(['like', 'sku', $q])->asArray()->all();
            foreach ($sku_products as $product) {
                $id_prod[] = $product['id'];
            }
        }
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $products = Product::find()
                ->select(['id', 'slug', 'name', 'price', 'currency', 'status_id', 'sku', 'category_id'])
                ->where(['like', 'name', $q])
                ->orFilterWhere(['in', 'id', $id_prod])
                ->limit(15)
                ->orderBy([new Expression('FIELD(status_id, 1, 3, 4, 2)')])
                ->all();

            return $this->renderAjax('suggestions', [
                'products' => $products
            ]);
        }
        $query = Product::find()
            ->select(['id', 'slug', 'name', 'price', 'currency', 'status_id', 'sku', 'category_id'])
            ->where(['like', 'name', $q])
            ->orFilterWhere(['in', 'id', $id_prod])
            ->orderBy([new Expression('FIELD(status_id, 1, 3, 4, 2)')]);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

        return $this->render('/search/suggestions-list', [
            'products' => $products,
            'pages' => $pages,
            'products_all' => $products_all,
        ]);
    }

    public function actionBlogs($f = null)
    {
        if ($f) {
            $blogs = Posts::find()->where(['like', 'title', $f])->all();
            return $this->render('/search/blogs-list', [
                'blogs' => $blogs
            ]);
        }
        return null;
    }
}