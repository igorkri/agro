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
    public function actionView($id)
    {

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

        $tag_name = Tag::find()->where(['id' => $id])->one();
        $tags = ProductTag::find()->where(['tag_id' => $id])->all();

        $query = Product::find()->where(['id' => []]);

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


        foreach ($tags as $tag) {
            $query->orWhere(['id' => $tag->product_id]);
        }

        $productIds = array_column($tags, 'product_id');
        $query->andWhere(['id' => $productIds]);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $count]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

        $this->setProductMetadata($tag_name);

        return $this->render('view', [
            'products' => $products,
            'products_all' => $products_all,
            'tag_name' => $tag_name,
            'pages' => $pages]);
    }

    protected function setProductMetadata($tag_name)
    {
        Yii::$app->metamaster
            ->setTitle('Продукти які відповідають запиту ' . '[ ' . $tag_name->name . ' ]')
            ->setDescription('На сторінці відображено товари які згруповані запитом ' . '[ ' . $tag_name->name . ' ]')
            ->setImage('/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());
    }
}