<?php

namespace common\models\shop;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product_properties_translate".
 *
 * @property int $id
 * @property int|null $property_id
 * @property string|null $language
 * @property string|null $properties
 * @property string|null $value
 */
class ProductPropertiesTranslate extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_properties_translate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['property_id'], 'integer'],
            [['language'], 'string', 'max' => 10],
            [['properties'], 'string', 'max' => 50],
            [['value'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'property_id' => Yii::t('app', 'Property ID'),
            'language' => Yii::t('app', 'Language'),
            'properties' => Yii::t('app', 'Properties'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
}
