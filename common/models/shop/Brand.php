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
            $color = '#0cdd9d';
        elseif ($i == 9)
            $color = '#bb43df';
        elseif ($i == 8)
            $color = '#198754';
        elseif ($i == 7)
            $color = '#6f42c1';
        elseif ($i == 6)
            $color = '#f907ed';
        elseif ($i == 5)
            $color = '#fd7e14';
        elseif ($i == 4)
            $color = '#e62e2e';
        elseif ($i == 3)
            $color = '#29cccc';
        elseif ($i == 2)
            $color = '#3377ff';
        elseif ($i == 1)
            $color = '#5dc728';
        elseif ($i == 0)
            $color = '#ffd333';
        else
            $color = '#a79ea6';

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
        $orders_id = Order::find()
            ->select('id')
            ->where(['order_pay_ment_id' => 3])
            ->asArray()
            ->all();

        $orders_id = array_map(function ($item) {
            return $item['id'];
        }, $orders_id);

        $product_id = OrderItem::find()
            ->select('product_id')
            ->where(['order_id' => $orders_id])
            ->asArray()
            ->all();

        $product_id = array_map(function ($item) {
            return $item['product_id'];
        }, $product_id);

        $products = Product::find()
            ->select('id')
            ->where(['id' => $product_id])
            ->andWhere(['brand_id' => $id])
            ->asArray()
            ->all();

        $products = array_map(function ($item) {
            return $item['id'];
        }, $products);

        $total_income_brand = [];

        $income_count = OrderItem::find()->where(['product_id' => $products])->all();

        if ($income_count != null) {
            foreach ($income_count as $item) {
                $total_income_brand[] = $item->price * $item->quantity;
            }
        }
        return array_sum($total_income_brand);
    }
}
