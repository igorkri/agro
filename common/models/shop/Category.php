<?php

namespace common\models\shop;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int|null $parentId
 * @property string $name
 * @property string $svg
 * @property string $pageTitle
 * @property string $prefix
 * @property string|null $slug
 * @property string|null $file
 * @property string|null $visibility
 * @property string|null $description
 * @property string|null $metaDescription
 */
class Category extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'slugAttribute' => 'slug',
                'attribute' => 'pageTitle',
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
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parentId'], 'integer'],
            [['name', 'pageTitle'], 'required'],
            [['description', 'metaDescription'], 'string'],
            [['name', 'pageTitle', 'file', 'visibility', 'svg', 'prefix'], 'string', 'max' => 255],
            [['name', 'slug'], 'unique'],
            [['slug'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parentId' => 'Parent ID',
            'name' => 'Name',
            'pageTitle' => 'Page Title',
            'slug' => 'Slug',
            'file' => 'File',
            'visibility' => 'Visibility',
            'description' => 'Description',
            'metaDescription' => 'Meta Description',
            'svg' => 'SVG',
            'prefix' => 'Prefix',
        ];
    }

    public function getParent()
    {
        return $this->hasOne(Category::class, ['id' => 'parentId']);
    }

    public function getParents()
    {
        return $this->hasMany(Category::class, ['parentId' => 'id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' => 'id']);
    }

    public function getCountProductCategory($id)
    {
        $cat = [];
        $categories = Category::find()->select('id')->where(['parentId' => $id])->all();
        foreach ($categories as $category) {
            $cat[] = $category->id;
        }
        $products = Product::find()
            ->select('id')
            ->where(['category_id' => $cat])
            ->orWhere(['category_id' => $id])
            ->all();
        $res = [];
        foreach ($products as $product) {
            $res[] = $product;
        }
        if (count($res) > 0) {
            return count($res);

        } else {
            return 0;
        }
    }

    public function getCountProductCategoryChild($id)
    {
        $products = Product::find()->select('id')->where(['category_id' => $id])->all();
        $res = [];
        foreach ($products as $product) {
            $res[] = $product;
        }
        if (count($res) > 0) {
            return count($res);

        } else {
            return 0;
        }
    }

    public function getSchemaImg($id)
    {
        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false) {
            $webp_support = true; // webp поддерживается
        } else {
            $webp_support = false; // webp не поддерживается
        }
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        $images = [];
        foreach ($product->images as $image) {
            if ($webp_support == true && isset($image->webp_name)) {
                $images[] = Yii::$app->request->hostInfo . '/product/' . $image->webp_name;
            } else {
                $images[] = Yii::$app->request->hostInfo . '/product/' . $image->name;
            }
        }
        return $images;
    }

    public function getSchemaRatingCategory($id)
    {
        $products = Product::find()
            ->select('id')
            ->where(['category_id' => $id])
            ->asArray()
            ->all();
        $flatArray = array_column($products, 'id');

        $reviews = Review::find()
            ->select('rating')
            ->where(['product_id' => $flatArray])
            ->all();
        $res = [];
        foreach ($reviews as $review) {
            $res[] = $review->rating;
        }
        if (count($res) > 0) {
            $average = array_sum($res) / count($res);
            return round($average, 1);
        } else {
            return '4.4';
        }
    }

    public function getSchemaCountReviewsCategory($id)
    {
        $products = Product::find()
            ->select('id')
            ->where(['category_id' => $id])
            ->asArray()
            ->all();
        $flatArray = array_column($products, 'id');

        $reviews = Review::find()
            ->select('id')
            ->where(['product_id' => $flatArray])
            ->all();
        $res = [];
        foreach ($reviews as $review) {
            $res[] = $review;
        }
        if (count($res) > 0) {
            return count($res);

        } else {
            return '28';
        }
    }

    public function getCatalogHighPrice($id)
    {
        $highPrice = Product::find()
            ->where(['category_id' => $id])
            ->orderBy(['price' => SORT_DESC])
            ->one();

        return $highPrice->price;
    }

    public function getCatalogLowPrice($id)
    {
        $lowPrice = Product::find()
            ->where(['category_id' => $id])
            ->orderBy(['price' => SORT_ASC])
            ->one();

        return $lowPrice->price;
    }

    public function getChildrenHighPrice($res)
    {
        $highPrice = Product::find()
            ->where(['category_id' => $res])
            ->orderBy(['price' => SORT_DESC])
            ->one();

        return $highPrice->price;
    }

    public function getChildrenLowPrice($res)
    {
        $lowPrice = Product::find()
            ->where(['category_id' => $res])
            ->orderBy(['price' => SORT_ASC])
            ->one();

        return $lowPrice->price;
    }

    public function getSchemaRatingChildren($res)
    {
        $products = Product::find()
            ->select('id')
            ->where(['category_id' => $res])
            ->asArray()
            ->all();
        $flatArray = array_column($products, 'id');

        $reviews = Review::find()
            ->select('rating')
            ->where(['product_id' => $flatArray])
            ->all();
        $res = [];
        foreach ($reviews as $review) {
            $res[] = $review->rating;
        }
        if (count($res) > 0) {
            $average = array_sum($res) / count($res);
            return round($average, 1);
        } else {
            return '4.4';
        }
    }

    public function getSchemaCountReviewsChildren($res)
    {
        $products = Product::find()
            ->select('id')
            ->where(['category_id' => $res])
            ->asArray()
            ->all();
        $flatArray = array_column($products, 'id');

        $reviews = Review::find()
            ->select('id')
            ->where(['product_id' => $flatArray])
            ->all();
        $res = [];
        foreach ($reviews as $review) {
            $res[] = $review;
        }
        if (count($res) > 0) {
            return count($res);

        } else {
            return '28';
        }
    }
}
