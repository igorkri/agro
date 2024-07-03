<?php

namespace common\models\shop;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $name_ru
 * @property string|null $name_en
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'name_ru', 'name_en'], 'string', 'max' => 50],
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
            'name_ru' => Yii::t('app', 'Name RU'),
            'name_en' => Yii::t('app', 'Name EN'),
        ];
    }

    public function getProductTag($id) {

        $products = ProductTag::find()->where(['tag_id' => $id])->all();
        $total_res = [];
        foreach ($products as $product) {
            $total_res[] = $product;
        }
        return count($total_res);
    }

}
