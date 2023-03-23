<?php

namespace console\controllers;

use common\models\shop\Product;
use common\models\shop\Review;
use Faker\Factory;
use Yii;
use yii\base\BaseObject;

class ReviewController extends \yii\console\Controller
{

    public function actionGenerate(){
        $users = Yii::$app->db->createCommand('SELECT `second_name` FROM users_review_test')
            ->queryAll();
        $products = Product::find()->all();
        foreach ($users as $user){
            if($user['second_name'] != '') {
                foreach ($products as $product) {
                    $rand = rand(3, 5);
                    $review = new Review();
                    $review->product_id = $product->id;
                    $review->rating = $rand;
                    $review->name = $user['second_name'];
                    $review->save(false);
                }
            }
        }
    }

    /**
     * Добавление отзывов в магазин продукту
     */
    public function actionReviewsUser()
    {
        $faker = Factory::create('uk_UA');
        $products = Product::find()->all();
        $i = 1;
        foreach ($products as $product) {
            $users = Yii::$app->db->createCommand('SELECT `second_name` FROM users_review_test')
                ->queryAll();
            $user_ramd = rand(1, count($users));
            $rating = rand(1, 5);

            if (count($product->reviews) <= 25) {
                if (isset($users[$user_ramd])) {
                    $review = new Review();
                    $review->product_id = $product->id;
                    $review->created_at = strtotime('-' . $i . ' day');
                    $review->rating = $rating;
                    $review->name = $users[$user_ramd]['second_name'];
                    $review->message =  $faker->realText(255);
                    if ($review->save(false)) {
                        echo "\t" . $i . " Отзыв добавлен! \n";
                        $i++;
                    }
                }
            }
        }
    }


}