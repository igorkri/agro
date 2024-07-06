<?php

namespace common\models\shop;

use Yii;

/**
 * This is the model class for table "product_properties".
 *
 * @property int $id
 * @property int $sort
 * @property int $category_id
 * @property int|null $product_id ID Продукта
 * @property string|null $properties Властивысть 
 * @property string|null $value Значення
 */
class ProductProperties extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_properties';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'category_id', 'sort'], 'integer'],
            [['properties', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'ID Продукта'),
            'properties' => Yii::t('app', 'Властивысть '),
            'value' => Yii::t('app', 'Значення'),
            'sort' => Yii::t('app', 'Сортировка'),
            'category_id' => Yii::t('app', 'ID Категории'),
        ];
    }

    public function getTranslations()
    {
        return $this->hasMany(ProductPropertiesTranslate::class, ['property_id' => 'id']);
    }

    public function getTranslation($language)
    {
        return $this->hasOne(ProductPropertiesTranslate::class, ['property_id' => 'id'])->where(['language' => $language]);
    }
}
