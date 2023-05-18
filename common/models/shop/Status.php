<?php

namespace common\models\shop;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string|null $name
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
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

    public function getProductStatus($id){
        $products = Product::find()->where(['status_id' => $id])->all();
        $total_res = [];
        foreach ($products as $product){
            $total_res[] = $product;
        }
        return count($total_res);
    }
}
