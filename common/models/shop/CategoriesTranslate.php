<?php

namespace common\models\shop;

use Yii;

/**
 * This is the model class for table "categories_translate".
 *
 * @property int $id
 * @property string|null $language
 * @property int|null $category_id
 * @property string|null $name
 * @property string|null $pageTitle
 * @property string|null $description
 * @property string|null $metaDescription
 * @property string|null $prefix
 */
class CategoriesTranslate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories_translate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['description'], 'string'],
            [['language'], 'string', 'max' => 10],
            [['name', 'pageTitle', 'metaDescription'], 'string', 'max' => 255],
            [['prefix'], 'string', 'max' => 50],
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
            'category_id' => Yii::t('app', 'Category ID'),
            'name' => Yii::t('app', 'Name'),
            'pageTitle' => Yii::t('app', 'Page Title'),
            'description' => Yii::t('app', 'Description'),
            'metaDescription' => Yii::t('app', 'Meta Description'),
            'prefix' => Yii::t('app', 'Prefix'),
        ];
    }
}
