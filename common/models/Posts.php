<?php

namespace common\models;

use common\models\shop\ActivePages;
use common\models\shop\Product;
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
 * @property string|null $date_updated Дата редактирования
 * @property string|null $image Картинка
 * @property string|null $webp_image Картинка
 * @property string|null $slug Слаг
 */
class Posts extends ActiveRecord
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
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_updated'],
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
            [['title', 'seo_title','description', 'seo_description'], 'required'],
            [['slug','title'], 'unique'],
            [['description', 'seo_description'], 'string'],
            [['date_public', 'date_updated'], 'string'],
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
            'date_updated' => Yii::t('app', 'Дата редактирования'),
            'image' => Yii::t('app', 'Картинка'),
            'slug' => Yii::t('app', 'Слаг'),
            'seo_title' => Yii::t('app', 'SEO заголовок'),
            'seo_description' => Yii::t('app', 'SEO опис'),
        ];
    }

    public function getTranslations()
    {
        return $this->hasMany(PostsTranslate::class, ['post_id' => 'id']);
    }

    public function getTranslation($language)
    {
        return $this->hasOne(PostsTranslate::class, ['post_id' => 'id'])->where(['language' => $language]);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])
            ->viaTable('post_products', ['post_id' => 'id']);
    }

    public function getReviews()
    {
        return $this->hasMany(PostsReview::class, ['post_id' => 'id']);
    }

    public function getSchemaRating($id)
    {
        $reviews = PostsReview::find()->where(['post_id' => $id])->all();
        $res = [];
        foreach ($reviews as $review) {
            $res[] = $review->rating;
        }
        if (count($res) > 0) {
            return array_sum($res) / count($res);

        } else {
            return '4.3';
        }
    }

    public function getSchemaCountReviews($id)
    {
        $reviews = PostsReview::find()->where(['post_id' => $id])->all();
        $res = [];
        foreach ($reviews as $review) {
            $res[] = $review;
        }
        if (count($res) > 0) {
            return count($res);

        } else {
            return '3';
        }
    }

    public function getPostViews($slug)
    {
        $slugs = ActivePages::find()->where(['like', 'url_page', "%$slug", false])->all();
        return count($slugs);
    }

    public function getPostDateView($slug)
    {
        return ActivePages::find()
            ->select('date_visit')
            ->where(['like', 'url_page', $slug])
            ->orderBy(['date_visit' => SORT_DESC])
            ->asArray()
            ->one(); // Получаем сразу одну запись
    }
}
