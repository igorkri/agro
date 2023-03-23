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
}
