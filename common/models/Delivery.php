<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "delivery".
 *
 * @property int $id
 * @property string|null $name Name
 * @property string|null $description Description
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    public function getSeoPage()
    {
        $language = Yii::$app->session->get('_language');
        $seo = SeoPages::find()->where(['slug' => 'delivery'])->one();

        if (in_array($language, ['ru', 'en']) && $seo !== null) {
            $seo = SeoPageTranslate::find()
                ->where(['page_id' => $seo->id, 'language' => $language])
                ->one();
        }

        return $seo;
    }

    public function setMetamaster($seo)
    {
        Yii::$app->metamaster
            ->setSiteName('AgroPro')
            ->setType('website')
            ->setTitle($seo->title)
            ->setDescription(strip_tags($seo->description))
            ->setImage('/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());
    }

}
