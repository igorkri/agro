<?php

namespace common\models\shop;

use common\models\TagTranslate;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $description
 */
class Tag extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
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
                'immutable' => true,
                // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general.
                'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'string', 'max' => 50],
            [['description'], 'string'],
            [['name'], 'unique'],
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
            'slug' => Yii::t('app', 'Slug'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    public function getTranslations()
    {
        return $this->hasMany(TagTranslate::class, ['tag_id' => 'id']);
    }

    public function getTranslation($language)
    {
        return $this->hasOne(TagTranslate::class, ['tag_id' => 'id'])->where(['language' => $language]);
    }

    public function getProductTag($id)
    {
        $products = ProductTag::find()->where(['tag_id' => $id])->all();
        $total_res = [];
        foreach ($products as $product) {
            $total_res[] = $product;
        }
        return count($total_res);
    }

    public function getTagTranslate($tag, $language)
    {
        switch ($language) {
            case 'ru':
                $translation = TagTranslate::find()
                    ->select('name')
                    ->where(['tag_id' => $tag->id, 'language' => 'ru'])
                    ->one();
                $name = $translation ? $translation->name : $tag->name;
                break;

            case 'en':
                $translation = TagTranslate::find()
                    ->select('name')
                    ->where(['tag_id' => $tag->id, 'language' => 'en'])
                    ->one();
                $name = $translation ? $translation->name : $tag->name;
                break;

            default:
                $name = $tag->name;
                break;
        }

        return $name;
    }

    public function getDescriptionTranslate($tag, $language)
    {
        switch ($language) {
            case 'ru':
                $translation = TagTranslate::find()
                    ->select('description')
                    ->where(['tag_id' => $tag->id, 'language' => 'ru'])
                    ->one();
                $description = $translation ? $translation->description : $tag->description;
                break;

            case 'en':
                $translation = TagTranslate::find()
                    ->select('description')
                    ->where(['tag_id' => $tag->id, 'language' => 'en'])
                    ->one();
                $description = $translation ? $translation->description : $tag->description;
                break;

            default:
                $description = $tag->description;
                break;
        }

        return $description;
    }


}
