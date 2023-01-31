<?php

namespace common\models\shop;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int|null $parentId
 * @property string $name
 * @property string $pageTitle
 * @property string|null $slug
 * @property string|null $file
 * @property string|null $visibility
 * @property string|null $description
 * @property string|null $metaDescription
 */
class Category extends \yii\db\ActiveRecord
{
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
            [['name', 'pageTitle', 'slug', 'file', 'visibility'], 'string', 'max' => 255],
            [['slug'], 'unique'],
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
        ];
    }

    public function getParent(){
        return $this->hasOne(Category::class, ['id' => 'parentId']);
    }
}
