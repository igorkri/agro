<?php

namespace frontend\controllers;

use common\models\shop\ProductTag;
use common\models\shop\Product;
use common\models\shop\Tag;
use yii\data\Pagination;
use yii\web\Controller;
use yii\db\Expression;
use Yii;

class TagController extends Controller
{
    public function actionView($id, $sort = null, $count = '12')
    {
        $count = intval($count);

        $tag_name = Tag::find()->where(['id' => $id])->one();
        $tags = ProductTag::find()->where(['tag_id' => $id])->all();

        $query = Product::find()->where(['id' => []]);

        if ($sort === 'price_lowest') {
            $query->orderBy(['price' => SORT_ASC]);
        } elseif ($sort === 'price_highest') {
            $query->orderBy(['price' => SORT_DESC]);
        } else {
            $query->orderBy([new Expression('FIELD(status_id, 1, 3, 4, 2)')]);
        }


        foreach ($tags as $tag) {
            $query->orWhere(['id' => $tag->product_id]);
        }

        $productIds = array_column($tags, 'product_id');
        $query->andWhere(['id' => $productIds]);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $count]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

        Yii::$app->metamaster
            ->setTitle('Продукти запиту ' . '[ ' . $tag_name->name . ' ]')
            ->setDescription('На сторінці відображено товари які згруповані запитом ' . '[ ' . $tag_name->name . ' ]')
            ->setImage('/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());

        return $this->render('view', [
            'products' => $products,
            'products_all' => $products_all,
            'tag_name' => $tag_name,
            'pages' => $pages]);
    }

}