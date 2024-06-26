<?php

namespace console\controllers;

use common\models\shop\Product;
use common\models\shop\Review;
use Faker\Factory;
use Yii;

class ReviewController extends \yii\console\Controller
{

    /**
     * Генерация отзывов
     */
    public function actionGenerate()
    {
        $users = Yii::$app->db->createCommand('SELECT `second_name` FROM users_review_test')
            ->queryAll();
        $products = Product::find()->all();
        foreach ($users as $user) {
            if ($user['second_name'] != '') {
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
                    $review->message = $faker->realText(255);
                    if ($review->save(false)) {
                        echo "\t" . $i . " Отзыв добавлен! \n";
                        $i++;
                    }
                }
            }
        }
    }

    /**
     * Добавление отзывов в магазин AgroPro продуктам без отзывов
     */
    public function actionAddReviewAgroPro()
    {
        $messages = [
            'Рекомендую к покупке.', 'Беру не перший раз. Все добре.', 'Бистрий і вражаючий ефект.',
            'Быстрая доставка, хорошая упаковка.', 'Вартість виправдовує надійний результат.',
            'Вартість відповідає надійності.', 'Варто своїх грошей і сподівань.',
            'Варто своїх грошей і часу.', 'Варто своїх грошей.', 'Виняткова продуктивність.',
            'Висока ефективність за свою ціну.', 'Висока якість, чудові результати',
            'Високий рівень ефективності.', 'Відмінна якість за гроші.', 'Відмінна якість!',
            'Відмінне співвідношення ціни і якості.', 'Відмінний захист і простота використання.',
            'Відмінний результат.', 'Відмінний товар!', 'Відмінно вирішує проблему.',
            'Вражаючий і швидкий ефект.', 'Врятував мої рослини. Дякую!', 'Все добре.',
            'Все добре. Дякую за оперативність', 'Все добре. Працюе.', 'Все добре. Засіб буду ще пробувати',
            'Все добре. Приемно співпрацювати.', 'Все добре. Рекомендую.', 'Все добре. Швидка доставка.',
            'Все добре.Рекомендую!', 'Все Ок Рекомендую', 'Все ОК.', 'Все Ок. Дякую.', 'Все пройшло добре.',
            'Все пройшло добре. Рекомендую.', 'Все супер', 'Всем рекомендую.', 'Гарний вибір!',
            'Давно беру. Працюе.', 'Діє на 100%. Рекомендую!', 'Доволі задоволений результатом.',
            'Допомагає врятувати рослини.', 'Доступний і ефективний варіант.', 'Доступний і ефективний.',
            'Доступність та ефективність в одному.', 'Дуже дієвий засіб ! Рекомендую', 'Дуже класний продукт.',
            'Дуже корисна річ!', 'Дякую за одержаний заказ.', 'Дякую за оперативність!',
            'Дякую за оперативну доставку.', 'Дякую за оперативну доставку. Рекомендую.',
            'Дякую, все на висоті. ', 'Економічний та надійний захист.', 'Ефективний і доступний для всіх.',
            'Ефективний і зручний.', 'Ефективний і надійний захист.', 'Ефективний і простий у використанні.',
            'Ефективний і швидкий.', 'Ефективність доступна для всіх.', 'Ефективність і швидкість в одному.',
            'Ефективність на високому рівні.', 'За ці гроші це найкращий варіант на ринку.',
            'Рекомендую цей товар!', 'Відмінний результат у боротьбі з проблемою.', 'Якість на висоті.',
            'Радує швидкий результат. Рекомендую всім!', 'Ефективний і надійний.', 'Результати перевершили очікування.',
            'Вже не можу обійтися без цього товару!', 'Ідеально для садів і городів.', 'Швидкий результат. Дякую.',
            'Купую не вперше ! Засіб чудовий', 'Простий і ефективний у використанні.', 'Швидка доставка. Рекомендую.',
            'Супер товар!', 'Висока ефективність, доступна для всіх.', 'Завжди на висоті.', 'Працюе. Рекомендую.',
            'Простий і ефективний.', 'Миттєве вирішення проблеми.', 'Приємно здивований!', 'Рекомендую всім.',
            'Простий у використанні.', 'Швидкий і бездоганний ефект.', 'Простий і надійний.', 'Все Ок. Працюе.',
            'Вартість відповідає надійності. Рекомендую.', 'Відмінне співвідношення ціни та надійності.',
            'Все добре. Дякую за оперативність.', 'Все добре. Дякую.', 'Все Ок. Рекомендую.',
            'Все чудово працює.', 'Все чудово працює. Рекомендую.', 'Гарантована ефективність.',
            'Задоволений результатом!', 'Замовив ще раз, дуже сподобалась', 'Зручний і надійний у використанні.',
            'Легкість використання і надійність.', 'Легкість використання, що не підводить.',
            'Максимальна результативність.', 'Миттєвий і ефективний результат.', 'Можна довіряти.',
            'Надійне рішення проблеми.', 'надійний продавець', 'працює відмінно',
        ];

        $minTimestamp = 1672567211;
        $maxTimestamp = 1694592461;
//        $maxTimestamp = time();

        $products = Product::find()->select('id')->all();

        $fio = [];
        $fios = Review::find()->select('name')->all();
        foreach ($fios as $item) {
            $fio[] = $item->name;
        }


        $i = 1;
        $j = 1;
        foreach ($products as $product) {
            $review = Review::find()->where(['product_id' => $product->id])->all();
            if ($review == null) {


                $randomIndexF = array_rand($fio);
                $randomFio = $fio[$randomIndexF];

                $randomIndexM = array_rand($messages);
                $randomMess = $messages[$randomIndexM];

                $review = new Review();
                $review->product_id = $product->id;
                $review->rating = rand(3, 5);
                $review->name = $randomFio;
                $review->message = $randomMess;
                if ($review->save(false)) {
                    echo "\t" . $i . " Отзыв добавлен! \n";
                    $i++;
                }
                $review->created_at = rand($minTimestamp, $maxTimestamp);
                if ($review->save(false)) {
                    echo "\t" . $j . " Дата добавлена! \n";
                    $j++;
                }
            }
        }
    }
}