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
 * @property string|null $seo_title Название
 * @property string|null $description Описание
 * @property string|null $seo_description Описание
 * @property string|null $date_public Дата публикации
 * @property string|null $image Картинка
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
            [['title', 'seo_title', 'image'], 'string', 'max' => 255],
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
