<?php

namespace common\models\shop;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $name_ru
 * @property string|null $name_en
 * @property string|null $slug
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'name_ru', 'name_en', 'slug'], 'string', 'max' => 50],
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
            'name_ru' => Yii::t('app', 'Name RU'),
            'name_en' => Yii::t('app', 'Name EN'),
            'slug' => Yii::t('app', 'Slug'),
        ];
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
                $name = $tag->name_ru;
                break;

            case 'en':
                $name = $tag->name_en;
                break;

            default:
                $name = $tag->name;
                break;
        }

        return $name;
    }

}
