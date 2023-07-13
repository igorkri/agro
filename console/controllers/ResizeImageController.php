<?php


namespace app\commands;


use app\models\ProductPhoto;
use yii\console\Controller;
use yii\imagine\Image;

class ResizeImageController extends Controller
{

    /**
     * Обрізка зображення з оригіналу на 538 * 404; 345 * 259; 246 * 198; 158 * 119; 90 * 90;
     */
    public function actionProduct(){

        $photos = ProductPhoto::find()->all();

        $dir = ProductPhoto::FILE_URL;
        $path = \Yii::getAlias($dir);
$i = 1;
        foreach ($photos as $photo){
            $original = $path . $photo['path'];
            $is = ProductPhoto::find()->where(['x_large' => 'x_large-' . $original])->one();

            if (!$is && file_exists($original)) {
                Image::resize($original, 538, 404)->save($path . 'thumb/x_large-' . $photo['path'], ['quality' => 50]);
                Image::resize($original, 345, 259)->save($path . 'thumb/large-' . $photo['path'], ['quality' => 50]);
                Image::resize($original, 264, 198)->save($path . 'thumb/medium-' . $photo['path'], ['quality' => 50]);
                Image::resize($original, 158, 119)->save($path . 'thumb/small-' . $photo['path'], ['quality' => 50]);
                Image::resize($original, 90, 90)->save($path . 'thumb/x_small-' . $photo['path'], ['quality' => 50]);
                $photo->x_large = 'x_large-' . $photo['path'];
                $photo->large = 'large-' . $photo['path'];
                $photo->medium = 'medium-' . $photo['path'];
                $photo->small = 'small-' . $photo['path'];
                $photo->x_small = 'x_small-' . $photo['path'];
                if ($photo->save(false)) {
                    echo "\n " . $i . " | Успішно збережено: " . $photo['path'] . PHP_EOL;
                } else {
                    print_r($photo->errors);

                }
                $i++;
            }else{
                echo "\n " . $i . " | Успішно існує: " . $photo['path'] . PHP_EOL;
            }
        }

        echo "\nOk";
    }

    public function actionGallery(){

    }

}