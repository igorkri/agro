<?php

namespace frontend\widgets;

use common\models\Contact;
use yii\base\Widget;

class SiteHeader extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $contacts = Contact::find()->one();
        return $this->render('site-header',['contacts' => $contacts]);
    }


}
