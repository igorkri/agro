<?php

namespace console\controllers;

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

    public function actionAddHost()
    {
        $host = "http://agro";
        $urls = ActivePages::find()->all();
        $i = 1;
        foreach ($urls as $url) {
            if (str_contains($url->url_page, $host) == false) {
                $url->url_page = $host . $url->url_page;
                $url->save();

                echo "$i \t Параметр $host дописан в URL $url->url_page \n";
            } else {
                echo "$i \t Параметр $host уже есть у $url->url_page \n";
            }
            $i++;
        }
    }

}
