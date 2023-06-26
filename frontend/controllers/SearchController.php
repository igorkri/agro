<?php


namespace frontend\controllers;


use common\models\shop\Product;
use common\models\shop\ProductTag;
use common\models\shop\Tag;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class SearchController extends Controller
{

    public function actionSuggestions($q = null){
        $products = [];
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

            $products = Product::find()
                ->select(['id', 'slug', 'name', 'price', 'currency', 'status_id'])
                ->where(['like', 'name', $q])
                ->orFilterWhere(['in', 'id', $id_prod])
                ->all();
        }
        if(Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->renderAjax('suggestions', [
                'products' => $products
            ]);
        }
        return $this->render('/search/suggestions-list', [
            'products' => $products
        ]);
    }

}