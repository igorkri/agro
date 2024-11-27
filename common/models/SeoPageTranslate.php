<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "seo_page_translate".
 *
 * @property int $id
 * @property string|null $language
 * @property int|null $page_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $page_description
 */
class SeoPageTranslate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo_page_translate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id'], 'integer'],
            [['language'], 'string', 'max' => 3],
            [['title', 'description', 'page_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'language' => Yii::t('app', 'Language'),
            'page_id' => Yii::t('app', 'Page ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'page_description' => Yii::t('app', 'Page Description'),
        ];
    }
}
