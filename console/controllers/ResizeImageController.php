<?php


namespace console\controllers;


use common\models\Posts;
use common\models\shop\ProductImage;
use Yii;
use yii\console\Controller;
use yii\imagine\Image;

class ResizeImageController extends Controller
{

    /**
     * Обрізка зображення з оригіналу;
     */
    public function actionProduct(){

        $photos = ProductImage::find()->all();

        $dir = Yii::getAlias('@frontendWeb/product/');
        $i = 1;
        foreach ($photos as $photo){
            $original = $dir . $photo['name'];
            $is = ProductImage::find()->where(['extra_extra_large' => 'extra_extra_large-' . $original])->one();
            if (!$is && file_exists($original)) {
                $name = basename( $photo['name']);
                Image::resize($original, 350, 350)->save($dir . $photo->product_id . '/extra_extra_large-' . $name, ['quality' => 70]);
                Image::resize($original, 290, 290)->save($dir . $photo->product_id .'/extra_large-' . $name, ['quality' => 70]);
                Image::resize($original, 195, 195)->save($dir . $photo->product_id .'/large-' . $name, ['quality' => 70]);
                Image::resize($original, 150, 150)->save($dir . $photo->product_id .'/medium-' . $name, ['quality' => 70]);
                Image::resize($original, 90, 90)->save($dir . $photo->product_id .'/small-' . $name, ['quality' => 70]);
                Image::resize($original, 64, 64)->save($dir . $photo->product_id .'/extra_small-' . $name, ['quality' => 70]);
                $photo->extra_extra_large = $photo->product_id . '/' . 'extra_extra_large-' . $name;
                $photo->extra_large = $photo->product_id . '/' . 'extra_large-' . $name;
                $photo->large = $photo->product_id . '/' . 'large-' . $name;
                $photo->medium = $photo->product_id . '/' . 'medium-' . $name;
                $photo->small = $photo->product_id . '/' . 'small-' . $name;
                $photo->extra_small = $photo->product_id . '/' . 'extra_small-' . $name;
                if ($photo->save(false)) {
                    echo "\n " . $i . " | Успішно збережено: " . $name . PHP_EOL;
                } else {
                    print_r($photo->errors);
                }
                $i++;
            }else{
                echo "\n " . $i . " | Успішно існує: " . $photo['name'] . PHP_EOL;
            }
        }

        echo "\nOk";
    }

    public function actionPost(){

        $photos = Posts::find()->all();

        $dir = Yii::getAlias('@frontendWeb/posts/');
        $i = 1;
        foreach ($photos as $photo){
            $original = $dir . $photo['image'];
            $is = Posts::find()->where(['extra_large' => 'extra_large-' . $original])->one();
            if (!$is && file_exists($original)) {
                $name =  $photo['image'];
                Image::resize($original, 330, 222)->save($dir . 'thumb/extra_large-' . $name, ['quality' => 70]);
                Image::resize($original, 263, 177)->save($dir . 'thumb/large-' . $name, ['quality' => 70]);
                Image::resize($original, 159, 107)->save($dir . 'thumb/medium-' . $name, ['quality' => 70]);
                Image::resize($original, 90, 60)->save($dir . 'thumb/small-' . $name, ['quality' => 70]);
                $photo->extra_large = 'extra_large-' . $name;
                $photo->large = 'large-' . $name;
                $photo->medium = 'medium-' . $name;
                $photo->small = 'small-' . $name;
                if ($photo->save(false)) {
                    echo "\n " . $i . " | Успішно збережено: " . $name . PHP_EOL;
                } else {
                    print_r($photo->errors);
                }
                $i++;
            }else{
                echo "\n " . $i . " | Успішно існує: " . $photo['image'] . PHP_EOL;
            }
        }

        echo "\nOk";
    }

}