<?php


namespace frontend\controllers;


use common\models\Posts;
use yii\web\Controller;

class PostController extends Controller
{

    public function actionView(){

//        $model = About::find()->one();
        return $this->render('view');
    }

}