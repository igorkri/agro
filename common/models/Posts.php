<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string|null $title Название
 *
 * @property string|null $extra_large Размер картинки
 * @property string|null $large Размер картинки
 * @property string|null $medium Размер картинки
 * @property string|null $small Размер картинки
 *
 * @property string|null $webp_extra_large Размер картинки
 * @property string|null $webp_large Размер картинки
 * @property string|null $webp_medium Размер картинки
 * @property string|null $webp_small Размер картинки
 *
 * @property string|null $seo_title Название
 * @property string|null $description Описание
 * @property string|null $seo_description Описание
 * @property string|null $date_public Дата публикации
 * @property string|null $image Картинка
 * @property string|null $webp_image Картинка
 * @property string|null $slug Слаг
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',                 // создание слага
                'slugAttribute' => 'slug',
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',  // создание даты
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_public'],
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
            [['description', 'seo_description'], 'string'],
            [['date_public'], 'string'],
            [['slug'], 'string'],
            [['title', 'seo_title', 'image',
                'extra_large', 'large', 'medium',
                'small', 'webp_image', 'webp_extra_large',
                'webp_large', 'webp_medium', 'webp_small'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'date_public' => Yii::t('app', 'Дата публикации'),
            'image' => Yii::t('app', 'Картинка'),
            'slug' => Yii::t('app', 'Слаг'),
            'seo_title' => Yii::t('app', 'SEO заголовок'),
            'seo_description' => Yii::t('app', 'SEO опис'),
        ];
    }
}
