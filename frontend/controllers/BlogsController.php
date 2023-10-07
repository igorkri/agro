<?php

namespace frontend\controllers;

use common\models\Posts;
use common\models\SeoPages;
use Spatie\SchemaOrg\Schema;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class BlogsController extends Controller
{

    public function actionView() {

        $seo = SeoPages::find()->where(['slug' => 'blogs'])->one();

        Yii::$app->metamaster
            ->setTitle($seo->title)
            ->setDescription($seo->description)
            ->setImage('/frontend/web/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());

        $posts = Posts::find();

        $pages = new Pagination(['totalCount' => $posts->count(), 'pageSize' => 3]);
        $blogs = $posts->offset($pages->offset)->limit($pages->limit)->orderBy('date_public DESC')->all();

        return $this->render('view',
            [
                'blogs' => $blogs,
                'pages' => $pages
            ]);
    }

}