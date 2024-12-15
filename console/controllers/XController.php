<?php

namespace console\controllers;

use common\models\IpBot;
use common\models\shop\Product;
use common\models\shop\ProductTag;
use yii\console\Controller;

class XController extends Controller
{

    /**
     * <<<<<<<< Найти похожие IP и заменить их всем диапазоном
     */
    public function actionFindCloneIp()
    {
        $ips = IpBot::find()->select('ip')->column();

        foreach ($ips as $key => $ip) {
            $parts = explode('.', $ip);
            array_pop($parts);
            $ips[$key] = implode('.', $parts) . '.';
        }

        $ips = array_unique($ips);
        $i = 1;

        foreach ($ips as $ip) {
            $ipStatistic = IpBot::find()
                ->where(['like', 'ip', $ip])
                ->count();

            if ($ipStatistic >= 3) {

                $isp = IpBot::find()
                    ->select('isp')
                    ->where(['like', 'ip', $ip])
                    ->scalar();

                if ($isp) {
                    $model = new IpBot();
                    $model->ip = $ip;
                    $model->isp = $isp;
                    $model->blocking = 1;
                    $model->comment = 'Весь диапазон IP';

                    if ($model->save()) {
                        IpBot::deleteAll([
                            'and',
                            ['like', 'ip', $ip],
                            ['!=', 'id', $model->id],
                        ]);
                        echo "$i \t  У \t $ip \t совпадений \t $ipStatistic \n";
                        $i++;
                    } else {
                        dd($model->errors);
                    }
                } else {
                    echo "ISP не существует \n";
                }
            }
        }
    }

    /**
     * <<<<<<<< Добавление Тегов продуктам по категориям
     */
    public function actionTagProducts()
    {
        $categoryId = 5;
        $tagId = 86;

        $productsId = Product::find()
            ->select('id')
            ->where(['category_id' => $categoryId])
            ->andWhere(['not in', 'id', ProductTag::find()->select('product_id')->where(['tag_id' => $tagId])])
            ->column();
        if ($productsId) {
            $i = 1;
            foreach ($productsId as $item) {
                $model = new ProductTag();
                $model->product_id = $item;
                $model->tag_id = $tagId;
                if ($model->save()) {
                    echo "$i \t  Сохранено  \n";
                } else {
                    dd($model->errors);
                }
                $i++;
            }
        } else {
            echo "\n\t  Нет результатов для \tКатегории $categoryId \tи \tТега $tagId \n";
        }
    }

}
