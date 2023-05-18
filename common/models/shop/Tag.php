<?php

namespace common\models\shop;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string|null $name
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
        ];
    }

    public function getProductTag($id){

        $products = ProductTag::find()->where(['tag_id' => $id])->all();
        $total_res = [];
        foreach ($products as $product){
            $total_res[] = $product;
        }
        return count($total_res);
    }

}
