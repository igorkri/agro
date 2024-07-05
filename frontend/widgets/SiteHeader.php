<?php

namespace frontend\widgets;

use common\models\Contact;
use common\models\shop\Category;
use Yii;
use yii\base\Widget;
use yii\caching\DbDependency;

class SiteHeader extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $session = Yii::$app->session;
        $language = $session->get('_language');
        $compareList = $session->get('compareList', []);
        $compareList = count($compareList);
        $wishList = $session->get('wishList', []);
        $wishList = count($wishList);

        $categories = Category::find()->where(['visibility' => 1])->all();

        $cacheKey = 'contact_cache_key';
        $contacts = Yii::$app->cache->get($cacheKey);

        if ($contacts === false) {
            $contacts = Contact::find()->one();

            Yii::$app->cache->set($cacheKey, $contacts, 3600, new DbDependency([
                'sql' => 'SELECT COUNT(*) FROM contacts',
            ]));
        }

        if ($language !== 'uk') {
            foreach ($categories as $category) {
                if ($category) {
                    $translationCat = $category->getTranslation($language)->one();
                    if ($translationCat) {
                        if ($translationCat->name) {
                            $category->name = $translationCat->name;
                        }
                    }
                    if ($category->parents){
                        foreach ($category->parents as $parent){
                            if ($parent !== null) {
                                $translationCatParent = $parent->getTranslation($language)->one();
                                if ($translationCatParent) {
                                    $parent->name = $translationCatParent->name;
                                }
                            }
                        }
                    }
                }
            }
        }

        return $this->render('site-header',
            [
                'contacts' => $contacts,
                'compareList' => $compareList,
                'wishList' => $wishList,
                'categories' => $categories,
            ]);
    }
}
