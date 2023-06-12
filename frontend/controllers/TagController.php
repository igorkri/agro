<?php


namespace frontend\controllers;

use common\models\shop\Product;
use common\models\shop\ProductProperties;
use common\models\shop\ProductTag;
use common\models\shop\Tag;
use yii\base\BaseObject;
use yii\data\Pagination;
use yii\web\Controller;

class TagController extends Controller
{

    public function actionView($id) {

        $tag_name = Tag::find()->where(['id' => $id])->one();
        $tags = ProductTag::find()->where(['tag_id' => $id])->all();

        $query = Product::find()->where(['id' => []]);
        foreach ($tags as $tag) {
            $query->orWhere(['id' => $tag->product_id]);
        }

        $productIds = array_column($tags, 'product_id');
        $query->andWhere(['id' => $productIds]);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

        return $this->render('view', ['products' => $products, 'products_all' => $products_all, 'tag_name' => $tag_name, 'pages' => $pages]);
    }

}