<?php

namespace console\controllers;

use common\models\shop\CategoriesTranslate;
use common\models\shop\Category;
use Stichoza\GoogleTranslate\GoogleTranslate;
use yii\console\Controller;

class CategoriesController extends Controller
{

    /**
     * <<<<<<<< ПЕРЕВОД Перевод данных Categories
     */
    public function actionTranslateCategory()
    {
        $categories = Category::find()->all();
        if (!$categories) {
            echo "Category not found.\n";
            return;
        }
        $i = 1;
        foreach ($categories as $category) {

            $descrSave = '';

            $sourceLanguage = 'uk'; // Исходный язык
            $targetLanguages = ['ru', 'en']; // Языки перевода

            $tr = new GoogleTranslate();

            foreach ($targetLanguages as $language) {
                $translation = $category->getTranslation($language)->one();
                if (!$translation) {
                    $translation = new CategoriesTranslate();
                    $translation->category_id = $category->id;
                    $translation->language = $language;
                }

                $tr->setSource($sourceLanguage);
                $tr->setTarget($language);

                $translation->name = $tr->translate($category->name ?? '');

                if (!empty($category->description) && strlen($category->description) < 5000) {
                    $translation->description = $tr->translate($category->description);
                } else {
                    $descrSave = 'Descr > 5000 или пустое значение';
                }

                $translation->pageTitle = $tr->translate($category->pageTitle ?? '');
                $translation->metaDescription = $tr->translate($category->metaDescription ?? '');
                $translation->prefix = $tr->translate($category->prefix ?? '');

                if ($translation->save()) {
                    echo "$i  Категория $category->name переведена и сохранена $descrSave для $language.\n";
                } else {
                    echo "$i  Ошибка во время сохранения $category->name для $language.\n";
                }
            }
            $i++;
        }
    }
}
