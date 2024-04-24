<?php

namespace frontend\widgets;

use common\models\Contact;
use Yii;
use yii\base\Widget;
use yii\caching\DbDependency;

class SiteFooter extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $cacheKey = 'contact_cache_key';
        $contacts = Yii::$app->cache->get($cacheKey);

        if ($contacts === false) {
            $contacts = Contact::find()->one();

            Yii::$app->cache->set($cacheKey, $contacts, 3600, new DbDependency([
                'sql' => 'SELECT COUNT(*) FROM contacts',
            ]));
        }

        return $this->render('site-footer',['contacts' => $contacts]);
    }
}
