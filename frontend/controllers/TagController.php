<?php

namespace frontend\controllers;

use common\models\shop\ProductTag;
use common\models\shop\Product;
use common\models\shop\Tag;
use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

class TagController extends BaseFrontendController
{
    public function actionView($slug)
    {
        $language = Yii::$app->session->get('_language');

        $params = $this->setSortAndCount();
        $sort = $params['sort'];
        $count = $params['count'];

        $tag_name = Tag::find()->where(['slug' => $slug])->one();
        $tags = ProductTag::find()->where(['tag_id' => $tag_name->id])->all();

        $query = Product::find()->where(['id' => []]);

        $this->applySorting($query, $sort);

        foreach ($tags as $tag) {
            $query->orWhere(['id' => $tag->product_id]);
        }

        $productIds = array_column($tags, 'product_id');
        $query->andWhere(['id' => $productIds]);

        $pages = $this->setPagination($query, $count);

        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

        $this->setProductMetadata($tag_name, $language);

        $products = $this->translateProduct($products, $language);

        return $this->render('view',
            [
                'products' => $products,
                'products_all' => $products_all,
                'tag_name' => $tag_name,
                'pages' => $pages,
                'language' => $language,
            ]);
    }

    public function actionRedirect($id)
    {
        $tag = Tag::findOne($id);
        if (!$tag) {
            throw new NotFoundHttpException("Tag not found");
        }
        $newUrl = Url::to(['tag/view', 'slug' => $tag->slug], true);

        return $this->redirect($newUrl, 301); // 301 - постоянный редирект
    }

    protected function setProductMetadata($tag_name, $language)
    {
        if ($tag_name->seo_title) {
            $title = $tag_name->getTagSeoTitleTranslate($tag_name, $language);
        } else {
            $title = 'Продукти які відповідають запиту ' . '[ ' . $tag_name->getTagTranslate($tag_name, $language) . ' ]';
        }
        if ($tag_name->seo_description) {
            $description = $tag_name->getTagSeoDescriptionTranslate($tag_name, $language);
        } else {
            $description = 'На сторінці відображено товари які згруповані запитом ' . '[ ' . $tag_name->getTagTranslate($tag_name, $language) . ' ]';

        }

        Yii::$app->metamaster
            ->setSiteName('AgroPro')
            ->setType('website')
            ->setTitle($title)
            ->setDescription($description)
            ->setImage('/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());
    }
}