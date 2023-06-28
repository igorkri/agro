<?php


namespace frontend\controllers;


use common\models\About;
use Yii;
use yii\web\Controller;

class AboutController extends Controller
{

    public function actionView(){

        $model = About::find()->one();

        Yii::$app->metamaster
            ->setTitle('Про нас - AgroPro: Товари для сільського господарства та якісні рішення для вашого успіху')
            ->setDescription('Дізнайтеся більше про наш інтернет-магазин AgroPro. 
            Ми - команда професіоналів з багаторічним досвідом в сільському господарстві. 
            Довіряйте нам для забезпечення вашого успіху у вирощуванні рослин, 
            захисті від шкідників та підвищенні врожайності. 
            Ми пропонуємо широкий асортимент продуктів, оперативну доставку та персоналізоване обслуговування. 
            Дізнайтеся більше про нас та наші цінності на сторінці Про нас.')
            ->setImage('/frontend/web/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());

        return $this->render('view', ['model' => $model]);
    }

}