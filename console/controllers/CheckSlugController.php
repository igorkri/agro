<?php

namespace console\controllers;

use common\models\Posts;
use common\models\shop\Product;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yii;
use yii\console\Controller;

class CheckSlugController extends Controller
{
    /**
     * Проверка индексированых слагов
     */
    public function actionGoogleIndexSlug()
    {
        $filePath = Yii::getAlias('@console') . '/runtime/check-slug/slug.xlsx';
        $filePath = str_replace('/', '\\', $filePath);
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();

        $data = array_reduce($data, function ($carry, $item) {
            $carry[] = $item[0];
            return $carry;
        }, []);

        $products = [];
        $posts = [];
        $other = [];

        foreach ($data as $datum) {
            if (strpos($datum, 'product') !== false) {
                $products[] = $datum;
            } elseif (strpos($datum, 'post') !== false) {
                $posts[] = $datum;
            } else {
                $other[] = $datum;
            }
        }
//                print_r($other); die;


        foreach ($posts as $item) {

            $path = parse_url($item, PHP_URL_PATH); // Получаем путь из URL
            $parts = explode("/", $path); // Разбиваем путь на части
            $lastPart = end($parts); // Получаем последнюю часть пути
            $slug = Posts::find()->where(['slug' => $lastPart])->one();
            if ($slug === null) {
                echo "\t Слаг " . $lastPart . " не найден \n";
            }


        }


    }
}
