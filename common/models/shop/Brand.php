<?php

namespace common\models\shop;


use common\models\SeoPages;
use common\models\SeoPageTranslate;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "brand".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $name
 * @property string|null $file
 */
class Brand extends ActiveRecord
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
            [['name'], 'unique'],
            [['name'], 'required'],
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

    public function getBrandCategories($id)
    {
        $categories_id = Product::find()->select('category_id')->where(['brand_id' => $id])->column();
        $categories_id = array_unique($categories_id);
        $categories_name = Category::find()->select('name')->where(['id' => $categories_id])->column();

        return implode(', ', $categories_name);
    }

    public function getColorBrand($i)
    {
        $colors = [
            10 => '#0cdd9d',
            9 => '#bb43df',
            8 => '#198754',
            7 => '#6f42c1',
            6 => '#f907ed',
            5 => '#fd7e14',
            4 => '#e62e2e',
            3 => '#29cccc',
            2 => '#3377ff',
            1 => '#5dc728',
            0 => '#ffd333',
        ];

        return $colors[$i] ?? '#a79ea6';
    }

    public function getProductOrderBrand($id)
    {
        $totalOrderQuantity = OrderItem::find()
            ->joinWith('product')
            ->where(['product.brand_id' => $id])
            ->sum('quantity');

        return $totalOrderQuantity;
    }

    public function getIncomeOrderBrand($id)
    {
        $orderIds = Order::find()->select('id')->where(['order_pay_ment_id' => 3])->column();

        $totalIncome = OrderItem::find()
            ->select(['SUM(order_item.price * order_item.quantity)'])
            ->leftJoin('product', 'order_item.product_id = product.id')
            ->where(['order_item.order_id' => $orderIds])
            ->andWhere(['product.brand_id' => $id])
            ->scalar();

        return $totalIncome;
    }

    static function getSeoPage()
    {
        $language = Yii::$app->session->get('_language');
        $seo = SeoPages::find()->where(['slug' => 'brands'])->one();

        if (in_array($language, ['ru', 'en']) && $seo !== null) {
            $seo = SeoPageTranslate::find()
                ->where(['page_id' => $seo->id, 'language' => $language])
                ->one();
        }

        return $seo;
    }

    static function setMetamaster($seo)
    {
        Yii::$app->metamaster
            ->setSiteName('AgroPro')
            ->setType('website')
            ->setTitle($seo->title)
            ->setDescription(strip_tags($seo->description))
            ->setImage('/images/logos/meta_logo.jpg')
            ->register(Yii::$app->getView());
    }


}
