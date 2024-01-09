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

    //Для фильтра frontend
    public function getBrandProductCountFilter($brandId, $categoryId)
    {
        $productCount = Product::find()
            ->where(['brand_id' => $brandId])
            ->andWhere(['category_id' => $categoryId])
            ->count();

        return $productCount;
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
        $colors = [
            10 => '#0cdd9d',
            9  => '#bb43df',
            8  => '#198754',
            7  => '#6f42c1',
            6  => '#f907ed',
            5  => '#fd7e14',
            4  => '#e62e2e',
            3  => '#29cccc',
            2  => '#3377ff',
            1  => '#5dc728',
            0  => '#ffd333',
        ];

        return $colors[$i] ?? '#a79ea6';
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
