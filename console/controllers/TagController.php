<?php

namespace console\controllers;

use common\models\shop\Tag;
use Stichoza\GoogleTranslate\GoogleTranslate;
use yii\console\Controller;
use yii\helpers\Inflector;

class TagController extends Controller
{

    /**
     * <<<<<<<< ПЕРЕВОД Перевод данных Tag
     */
    public function actionTranslateTag()
    {
        $tags = Tag::find()->all();
        if (!$tags) {
            echo "Tags not found.\n";
            return;
        }

        $i = 1;
        foreach ($tags as $tag) {

            $sourceLanguage = 'uk'; // Исходный язык
            $targetLanguages = ['ru', 'en']; // Языки перевода

            $tr = new GoogleTranslate();

            foreach ($targetLanguages as $language) {
                $tr->setSource($sourceLanguage);
                $tr->setTarget($language);

                // Перевод текста
                $translatedName = $tr->translate($tag->name);

                if ($language == 'ru') {
                    $tag->name_ru = $translatedName;
                }
                if ($language == 'en') {
                    $tag->name_en = $translatedName;
                }

                if ($tag->save()) {
                    echo "$i  Тег $tag->name переведен и сохранен для $language.\n";
                } else {
                    echo "$i  Ошибка во время сохранения $tag->name для $language.\n";
                }
            }
            $i++;
        }
    }

    public function actionAddSlug()
    {
        $tags = Tag::find()->all();
        $i = 1;
        foreach ($tags as $tag){
            $tag->slug = Inflector::slug($tag->name);
            if ($tag->save()) {
                echo "$i  Тег $tag->name переведен и сохранен для $tag->slug.\n";
            } else {
                echo "$i  Ошибка во время сохранения $tag->name для $tag->slug.\n";
            }
       $i++; }
    }

}
