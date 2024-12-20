<?php

namespace frontend\controllers;

use common\models\Settings;
use common\models\shop\Product;
use Yii;
use yii\db\Expression;

class SpecialController extends BaseFrontendController
{
    public function actionView()
    {
        $language = Yii::$app->session->get('_language');

        $params = $this->setSortAndCount();
        $sort = $params['sort'];
        $count = $params['count'];

        $query = Product::find()
            ->andWhere(['not', ['label_id' => null]])
            ->orderBy([
                new Expression('FIELD(status_id, 1, 3, 4, 2)')
            ]);

        $this->applySorting($query, $sort);

        $pages = $this->setPagination($query, $count);

        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $products_all = $query->count();

        $products = $this->translateProduct($products, $language);

        $seo = Settings::seoPageTranslate('special');
        Settings::setMetamaster($seo);
        $page_description = $seo->page_description;

        return $this->render('view', compact(['products', 'products_all', 'pages', 'language', 'page_description']));
    }

}

