<?php

namespace common\models\shop;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $name
 * @property string|null $file
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'name', 'file'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'slugAttribute' => 'slug',
                'attribute' => 'name',
                // optional params
                'ensureUnique' => true,
                'replacement' => '-',
                'lowercase' => true,
                'immutable' => false,
                // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general.
                'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'name' => 'Name',
            'file' => 'File',
        ];
    }

    public function getProductBrand($id)
    {
        $products = Product::find()->where(['brand_id' => $id])->all();
        $total_res = [];
        foreach ($products as $product) {
            $total_res[] = $product;
        }
        return count($total_res);
    }

    public function getColorBrand($i)
    {
        $color = '';

        if ($i == 10)
            $color = '#ffd333';
        elseif ($i == 9)
            $color = '#0d6efd';
        elseif ($i == 8)
            $color = '#0dcaf0';
        elseif ($i == 7)
            $color = '#6f42c1';
        elseif ($i == 6)
            $color = '#dc3545';
        elseif ($i == 5)
            $color = '#fd7e14';
        elseif ($i == 4)
            $color = '#3cfd14';
        elseif ($i == 3)
            $color = '#148bfd';
        elseif ($i == 2)
            $color = '#fd14ba';
        elseif ($i == 1)
            $color = '#14fde3';
        elseif ($i == 0)
            $color = '#b3fd14';

        return $color;
    }

    public function getProductOrderBrand($id)
    {
        $products = Product::find()->where(['brand_id' => $id])->all();
        $total_res = [];
        $total_order_brand = [];
        $i = 0;
        foreach ($products as $product) {
            $total_res[] = $product->id;
        }
        foreach ($total_res as $total_order) {
            $order_count = OrderItem::find()->where(['product_id' => $total_res[$i]])->all();
            if ($order_count != null)
                foreach ($order_count as $item) {
                    $total_order_brand[] = $item->quantity;
                }
            $i++;
        }
        return array_sum($total_order_brand);
    }

    public function getIncomeOrderBrand($id)
    {
        $products = Product::find()->where(['brand_id' => $id])->all();
        $total_res = [];
        $total_income_brand = [];
        $i = 0;
        foreach ($products as $product) {
            $total_res[] = $product->id;
        }
        foreach ($total_res as $total_order) {
            $income_count = OrderItem::find()->where(['product_id' => $total_res[$i]])->all();
            if ($income_count != null)
                foreach ($income_count as $item) {
                    $total_income_brand[] = $item->price * $item->quantity;
                }
            $i++;
        }
        return array_sum($total_income_brand);
    }
}
