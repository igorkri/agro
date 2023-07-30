<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "seo_pages".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $title
 * @property string|null $description
 */
class SeoPages extends \yii\db\ActiveRecord
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
            [['description'], 'string'],
            [['name', 'slug', 'title'], 'string', 'max' => 255],
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
        ];
    }
}
