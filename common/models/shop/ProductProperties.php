<?php

namespace common\models\shop;

use Yii;

/**
 * This is the model class for table "product_properties".
 *
 * @property int $id
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
            [['product_id'], 'integer'],
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
        ];
    }
}
