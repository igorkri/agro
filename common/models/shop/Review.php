<?php

namespace common\models\shop;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int|null $product_id Товар
 * @property int|null $created_at Дата публікації
 * @property float|null $rating Рейтинг
 * @property string|null $name Імя
 * @property string|null $email Email
 * @property string|null $message Текст
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'created_at'], 'integer'],
            [['rating'], 'number'],
            [['name', 'email', 'message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'rating' => 'Rating',
            'name' => 'Name',
            'email' => 'Email',
            'message' => 'Message',
        ];
    }

    public function getProductName($id){

        $products = Product::find()->where(['id' => $id])->one();

        return $products->name;
    }

    public function getProductSlug($id){

        $products = Product::find()->where(['id' => $id])->one();

        return $products->slug;
    }

    public function getProductImage($id)
    {

        $products = ProductImage::find()->where(['product_id' => $id])->one();

        return $products->name;
    }

    public function getReviewRating($rating)
    {

        if ($rating == 5) {

            $value = 1;
        } elseif ($rating == 4) {

            $value = 0.8;
        } elseif ($rating == 3) {

            $value = 0.6;
        } elseif ($rating == 2) {

            $value = 0.4;
        } elseif ($rating == 1) {

            $value = 0.2;
        }
        return $value;
    }
}
