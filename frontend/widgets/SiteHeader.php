<?php

namespace frontend\widgets;

use common\models\Contact;
use Yii;
use yii\base\Widget;

class SiteHeader extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $session = Yii::$app->session;
        $compareList = $session->get('compareList', []);
        $compareList = count($compareList);
        $wishList = $session->get('wishList', []);
        $wishList = count($wishList);


        $contacts = Contact::find()->one();
        return $this->render('site-header',
            [
                'contacts' => $contacts,
                'compareList' => $compareList,
                'wishList' => $wishList,
            ]);
    }


}
