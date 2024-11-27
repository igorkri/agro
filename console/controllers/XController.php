<?php

namespace console\controllers;

use common\models\SeoPages;
use common\models\SeoPageTranslate;
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

}
