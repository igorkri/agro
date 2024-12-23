<?php

namespace common\models;

use Yii;
use yii\base\Model;

class Settings extends Model
{
    static function currencyRate($cc = 'USD')
    {
        $currency = Yii::$app->cache->get('currency');
        if ($currency === false) {
            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );
            $result = file_get_contents('https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5', false, stream_context_create($arrContextOptions));
            $rates = json_decode($result, true);
            Yii::$app->cache->set('currency', $rates, 1 * 3600);
        } else {
            $rates = $currency;
        }
        if ($rates) {
            foreach ($rates as $rate) {
                if ($rate['ccy'] == $cc) {
                    if ($rate) {
                        return floatval($rate['sale']);
                    } else {
                        return 0.00;
                    }
                }
            }
        } else {
            return 50.00;
        }
    }

    static function seoPageTranslate($slug)
    {
        $language = Yii::$app->session->get('_language');
        $seo = SeoPages::find()->where(['slug' => $slug])->one();
        if (in_array($language, ['ru', 'en']) && $seo !== null) {
            $seo = SeoPageTranslate::find()
                ->where(['page_id' => $seo->id, 'language' => $language])
                ->one();
        }

        return $seo;
    }

    static function setMetamaster($type = null, $title = null, $description = null, $image = null, $keywords = null)
    {

        $metaMaster = Yii::$app->metamaster;

        if ($type) {
            $metaMaster->setType($type);
        }
        if ($title) {
            $metaMaster->setTitle($title);
        }
        if ($description) {
            $metaMaster->setDescription(strip_tags($description));
        }
        if ($image) {
            $metaMaster->setImage($image);
        }
        if ($keywords) {
            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $keywords,
            ]);
        }

        $metaMaster->register(Yii::$app->getView());
    }
}