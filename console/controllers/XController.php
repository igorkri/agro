<?php

namespace console\controllers;

use common\models\IpBot;
use common\models\SeoPages;
use common\models\SeoPageTranslate;
use common\models\shop\ActivePages;
use Stichoza\GoogleTranslate\GoogleTranslate;
use yii\console\Controller;

class XController extends Controller
{
    /**
     * <<<<<<<< ПЕРЕВОД Перевод данных Seo-pages
     */
    public function actionTranslateSeo()
    {
        $pages = SeoPages::find()->all();
        if (!$pages) {
            echo "Page not found.\n";
            return;
        }

        $i = 1;
        foreach ($pages as $page) {

            $sourceLanguage = 'uk'; // Исходный язык
            $targetLanguages = ['ru', 'en']; // Языки перевода

            $tr = new GoogleTranslate();

            foreach ($targetLanguages as $language) {
                $tr->setSource($sourceLanguage);
                $tr->setTarget($language);

                // Перевод текста
                $translatedTitle = $tr->translate($page->title);
                $translatedDescription = $tr->translate($page->description);


                $pageTranslate = new SeoPageTranslate();
                $pageTranslate->language = $language;
                $pageTranslate->page_id = $page->id;
                $pageTranslate->title = $translatedTitle;
                $pageTranslate->description = $translatedDescription;

                if ($pageTranslate->save()) {
                    echo "$i  Тег $page->name переведен и сохранен для $language.\n";
                } else {
                    echo "$i  Ошибка во время сохранения $page->name для $language.\n";
                }
            }
            $i++;
        }
    }

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
                    }else{
                        dd($model->errors);
                    }
                }else{
                    echo "ISP не существует \n";
                }
            }
        }
    }


}
