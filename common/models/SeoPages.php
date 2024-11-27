<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "seo_pages".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $title
 * @property string|null $description
 * @property string|null $page_description
 */
class SeoPages extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo_pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'page_description'], 'string'],
            [['name', 'slug', 'title'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['description', 'slug', 'title'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'title' => 'Title',
            'description' => 'Description',
            'page_description' => 'Page Description',
        ];
    }

    public function getTranslations()
    {
        return $this->hasMany(SeoPageTranslate::class, ['page_id' => 'id']);
    }

    public function getTranslation($language)
    {
        return $this->hasOne(SeoPageTranslate::class, ['page_id' => 'id'])->where(['language' => $language]);
    }
}
