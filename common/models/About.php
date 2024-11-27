<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "about".
 *
 * @property int $id
 * @property string|null $name Назва
 * @property string|null $description Опис
 */
class About extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'about';
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
        $seo = SeoPages::find()->where(['slug' => 'about'])->one();

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
