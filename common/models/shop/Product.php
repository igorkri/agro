<?php

namespace common\models\shop;

use common\models\Settings;
use Yii;
use yii\db\ActiveRecord;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $sku
 * @property string $slug
 * @property string $brand_id
 * @property string $description
 * @property string $footer_description
 * @property string $short_description
 * @property string $currency
 * @property string $package
 * @property float $price
 * @property float|null $old_price
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property int $status_id
 * @property int $category_id
 * @property int $label_id
 * @property string $date_public Дата публикации
 * @property string|null $date_updated Дата редактирования
 *
 * @property ProductTag[] $productTags
 * @property Tag[] $tags
 */
class Product extends ActiveRecord implements CartPositionInterface
{

    use CartPositionTrait;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
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
            [['name', 'description', 'short_description', 'seo_title', 'seo_description', 'price', 'status_id', 'package', 'category_id'], 'required'],
            [['description', 'footer_description', 'short_description', 'currency'], 'string'],
            [['price', 'old_price'], 'number'],
            [['status_id', 'category_id', 'label_id', 'brand_id'], 'safe'],
            [['name', 'seo_title', 'seo_description', 'package', 'slug', 'sku', 'date_public', 'date_updated'], 'string', 'max' => 255],
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
            'brand_id' => Yii::t('app', 'Brand'),
            'slug' => Yii::t('app', 'Slug'),
            'currency' => Yii::t('app', 'Currency'),
            'description' => Yii::t('app', 'Description'),
            'short_description' => Yii::t('app', 'Short Description'),
            'price' => Yii::t('app', 'Price'),
            'old_price' => Yii::t('app', 'Old Price'),
            'seo_title' => Yii::t('app', 'Seo Title'),
            'seo_description' => Yii::t('app', 'Seo Description'),
            'status_id' => Yii::t('app', 'Status'),
            'category_id' => Yii::t('app', 'Category'),
            'label_id' => Yii::t('app', 'Label'),
            'sku' => Yii::t('app', 'SKU'),
            'footer_description' => Yii::t('app', 'Footer Description'),
            'package' => Yii::t('app', 'Package'),
            'date_updated' => Yii::t('app', 'Date Updated'),
        ];
    }

    /**
     * Gets query for [[ProductsTranslate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(ProductsTranslate::class, ['product_id' => 'id']);
    }

    public function getTranslation($language)
    {
        return $this->hasOne(ProductsTranslate::class, ['product_id' => 'id'])->where(['language' => $language]);
    }

    /**
     * Gets query for [[ProductGrups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductGrups()
    {
        return $this->hasMany(ProductGrup::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('product_tag', ['product_id' => 'id']);
    }

    public function getTag()
    {
        return $this->hasOne(Tag::class, ['id' => 'id']);
    }

    public function getProductTags()
    {
        return $this->hasMany(ProductTag::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Grups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrups()
    {
        return $this->hasMany(Grup::class, ['id' => 'grup_id'])
            ->viaTable('product_grup', ['product_id' => 'id']);
    }

    public function getGrup()
    {
        return $this->hasOne(Grup::class, ['id' => 'id']);
    }

    /**
     * Gets query for [[AnalogProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnalogs()
    {
        return $this->hasMany(Product::class, ['id' => 'analog_product_id'])
            ->viaTable('analog_products', ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Label]].
     *
     * @return \yii\db\ActiveQuery
     *
     */
    public function getLabel()
    {
        return $this->hasOne(Label::class, ['id' => 'label_id']);
    }

    /**
     * Gets query for [[ProductImage]].
     *
     * @return \yii\db\ActiveQuery
     *
     */
    public function getImages()
    {
        return $this->hasMany(ProductImage::class, ['product_id' => 'id'])->orderBy(['priority' => SORT_ASC]);
    }

    public function getBrand()
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    public function getProperties()
    {
        return $this->hasMany(ProductProperties::class, ['product_id' => 'id'])
            ->orderBy(['sort' => SORT_ASC]);
    }


    public function getReviews()
    {
        return $this->hasMany(Review::class, ['product_id' => 'id'])->orderBy(['created_at' => SORT_ASC]);
    }

    public function getPrice()
    {
        if ($this->currency === 'UAH') {
            return $this->price;
        } else {
            return floatval($this->price) * floatval(Settings::currencyRate($this->currency));
        }
    }

    public function getOldPrice()
    {
        if ($this->currency === 'UAH') {
            return $this->old_price;
        } else {
            return floatval($this->old_price) * floatval(Settings::currencyRate($this->currency));
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIssetToCart($product_id)
    {
        $isset_to_cart = null;
        if (isset($_SESSION['agro_cart'])) {
            $keys = array_keys(unserialize($_SESSION['agro_cart']));

            if (in_array($product_id, $keys)) {
                $isset_to_cart = Yii::$app->cart->getPositions()[$product_id];
            }
        }
        return $isset_to_cart;
    }

    public function getSchemaImg($id)
    {
        $product = Product::find()->with('images')->where(['id' => $id])->one();

        $images = $product->images;
        if (isset($images[0])) {
            $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->name;
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    public function getSchemaRating($id)
    {
        $reviews = Review::find()->where(['product_id' => $id])->all();
        $res = [];
        foreach ($reviews as $review) {
            $res[] = $review->rating;
        }
        if (count($res) > 0) {
            return array_sum($res) / count($res);

        } else {
            return '4.4';
        }
    }

    public function getSchemaCountReviews($id)
    {
        $reviews = Review::find()->where(['product_id' => $id])->all();
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

    public function getImgOne($id)
    {
        $webp_support = ProductImage::imageWebp();
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        $images = $product->images;
        if (isset($images[0])) {
            if ($webp_support == true && isset($images[0]->webp_name)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->webp_name;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->name;
            }
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    public function getImgSeo($id)
    {
        $webp_support = ProductImage::imageWebp();

        $product = Product::find()->with('images')->where(['id' => $id])->one();

        $images = $product->images;
        $priorities = array_column($images, 'priority');
        array_multisort($priorities, SORT_ASC, $images);

        if (isset($images[0])) {
            if ($webp_support == true && isset($images[0]->webp_large)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->webp_large;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->large;
            }
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    // 350 * 350
    public function getImgOneExtraExtraLarge($id)
    {
        $webp_support = ProductImage::imageWebp();
        $product = Product::find()->with('images')->where(['id' => $id])->one();

        $images = $product->images;
        $priorities = array_column($images, 'priority');
        array_multisort($priorities, SORT_ASC, $images);

        if (isset($images[0])) {
            if ($webp_support == true && isset($images[0]->webp_extra_extra_large)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->webp_extra_extra_large;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->extra_extra_large;
            }
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    // 290 * 290
    public function getImgOneExtraLarge($id)
    {
        $webp_support = ProductImage::imageWebp();
        $product = Product::find()->with('images')->where(['id' => $id])->one();

        $images = $product->images;
        $priorities = array_column($images, 'priority');
        array_multisort($priorities, SORT_ASC, $images);

        if (isset($images[0])) {
            if ($webp_support == true && isset($images[0]->webp_extra_large)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->webp_extra_large;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->extra_large;
            }
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    //  195 * 195
    public function getImgOneLarge($id)
    {
        $webp_support = ProductImage::imageWebp();
        $product = Product::find()->with('images')->where(['id' => $id])->one();

        $images = $product->images;
        $priorities = array_column($images, 'priority');
        array_multisort($priorities, SORT_ASC, $images);

        if (isset($images[0])) {
            if ($webp_support == true && isset($images[0]->webp_large)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->webp_large;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->large;
            }
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    // 150 * 150
    public function getImgOneMedium($id)
    {
        $webp_support = ProductImage::imageWebp();
        $product = Product::find()->with('images')->where(['id' => $id])->one();

        $images = $product->images;
        $priorities = array_column($images, 'priority');
        array_multisort($priorities, SORT_ASC, $images);

        if (isset($images[0])) {
            if ($webp_support == true && isset($images[0]->webp_medium)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->webp_medium;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->medium;
            }
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    // 90 * 90
    public
    function getImgOneSmall($id)
    {
        $webp_support = ProductImage::imageWebp();
        $product = Product::find()->with('images')->where(['id' => $id])->one();

        $images = $product->images;
        $priorities = array_column($images, 'priority');
        array_multisort($priorities, SORT_ASC, $images);

        if (isset($images[0])) {
            if ($webp_support == true && isset($images[0]->webp_small)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->webp_small;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->small;
            }
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    // 64 * 64
    public
    function getImgOneExtraSmal($id)
    {
        $webp_support = ProductImage::imageWebp();
        $product = Product::find()->with('images')->where(['id' => $id])->one();

        $images = $product->images;
        $priorities = array_column($images, 'priority');
        array_multisort($priorities, SORT_ASC, $images);

        if (isset($images[0])) {
            if ($webp_support == true && isset($images[0]->webp_extra_small)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->webp_extra_small;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $images[0]->extra_small;
            }
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    public
    static function productImage($slug)
    {
        $product = Product::find()->where(['slug' => $slug])->one();
        if ($product !== null) {
            $product_image = ProductImage::find()->where(['product_id' => $product->id])->orderBy('priority')->one();

            if ($product_image !== null && isset($product_image->extra_small)) {
                return $product_image->extra_small;
            } else {
                return 'no-image.png';
            }
        } else {
            return 'no-image.png';
        }
    }

    public
    static function productName($slug)
    {
        $product = Product::find()->select('name')->where(['slug' => $slug])->one();
        if ($product) {
            return $product->name;
        } else {
            return '';
        }
    }

    public
    static function productId($slug)
    {
        $product = Product::find()->select('id')->where(['slug' => $slug])->one();
        if ($product) {
            return $product->id;
        } else {
            return '';
        }
    }

    public
    static function productStatusId($slug)
    {
        $product = Product::find()->select('status_id')->where(['slug' => $slug])->one();
        if ($product) {
            return $product->status_id;
        } else {
            return '';
        }
    }

    public
    static function productStatusName($slug)
    {
        $product = Product::find()->select('status_id')->where(['slug' => $slug])->one();
        if ($product) {
        $status = Status::find()->select('name')->where(['id' => $product->status_id])->one();
            return $status->name;
        } else {
            return '';
        }
    }

    public
    static function productParams($id)
    {
        $title_param = '';
        $product_params = ProductProperties::find()->where(['product_id' => $id])->orderBy('sort ASC')->all();
        foreach ($product_params as $params) {
            $title_param .= $params->properties . '<br><b>' . $params->value . '</b><br><br>';
        }
        if ($title_param == '') {
            $title_param = '-------------------------<br>
                              параметри заповнюються<br>
                              -------------------------<br>
                             ';
        }
        return $title_param;
    }

    public
    static function productParamsList($id)
    {
        $language = Yii::$app->session->get('_language');
        $title_param = '';
        $product_params = ProductProperties::find()->where(['product_id' => $id])->orderBy('sort ASC')->all();

   if ($language != 'uk'){
       foreach ($product_params as $param){
           $idParam[] = $param->id;
       }
       $product_params = ProductPropertiesTranslate::find()->where(['property_id' => $idParam])->andWhere(['language' => $language])->all();
   }

        foreach ($product_params as $params) {
            if ($params->value && $params->value != '*') {
                $title_param .= '<li style="
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
">' . $params->properties . ' ' . '<b>' . $params->value . '</b></li>';
            }
        }
        if ($title_param == '') {
            $title_param = '-------------------------<br>
                              параметри заповнюються<br>
                              -------------------------<br>
                             ';
        }
        return $title_param;
    }

    public
    function getRatingCount($id)
    {
        $product = Product::find()->with('reviews')->where(['id' => $id])->one();
        $res = '<a href="#tab-reviews"> 0 (Не оцінювалось)</a>';
        if ($product->reviews) {
            $s = [];
            foreach ($product->reviews as $review) {
                $s[] = $review->rating;
            }
            $res = array_sum($s) / count($product->reviews);
            $count = count($product->reviews);
            $res = '<a href="#tab-reviews"> ' . Yii::$app->formatter->asDecimal($res, 1) . ' (' . $count . ' оцінок)</a>';
        }
        return $res;
    }

    // Особое внимание к продуктам
    public
    function getNonParametr($id)
    {
        $parametrs = ProductProperties::find()->select('value')->where(['product_id' => $id])->all();

        if ($parametrs == null) {
            return '<a data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="Незаповнені характеристики"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 18 18" style="color: red">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg> </a>';

        } else {

            foreach ($parametrs as $parametr) {
                if ($parametr->value === null or $parametr->value === '') {
                    return '<a data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="Незаповнені характеристики"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 18 18" style="color: red">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg> </a>';
                }
            }
        }
        return null;
    }

    public
    function getNonBrand($id)
    {
        $product = Product::find()->select('brand_id')->where(['id' => $id])->one();
        if ($product->brand_id == null) {
            $res = '<a data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="Невказаний бренд"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 18 18" style="color: #ffcc00">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg> </a>';
            return $res;
        }
        return null;
    }

    public
    function getNonShortDescr($id)
    {
        $productShortDescription = Product::find()
            ->select('short_description')
            ->where(['id' => $id])
            ->andWhere(['<=', 'CHAR_LENGTH(short_description)', 150])
            ->scalar();

        if ($productShortDescription !== false) {
            $res = '<a data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="Короткий опис < 150 знаків"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 18 18" style="color: #40ff00">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg> </a>';
            return $res;
        }
        return null;
    }

    public
    function getNonDescription($id)
    {
        $product = Product::find()
            ->select('description')
            ->where(['id' => $id])
            ->andWhere('CHAR_LENGTH(description) < 1000')
            ->one();
        if ($product != null) {
            $res = '<a data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="Опис < 1000 знаків"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 18 18" style="color: #02ade1">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg> </a>';
            return $res;
        }
        return null;
    }

    public
    function getNonSeoTitle($id)
    {
        $product = Product::find()
            ->select('seo_title')
            ->where(['id' => $id])
            ->andWhere('CHAR_LENGTH(seo_title) < 50 OR CHAR_LENGTH(seo_title) > 60')
            ->one();

        if ($product != null) {
            $res = '<a data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="SEO Тайтл < 50 или > 60"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 18 18" style="color: #9607f5">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg> </a>';
            return $res;
        }
        return null;
    }

    public
    function getNonSeoDescr($id)
    {
        $product = Product::find()
            ->select('seo_description')
            ->where(['id' => $id])
            ->andWhere('CHAR_LENGTH(seo_description) < 130 OR CHAR_LENGTH(seo_description) > 180')
            ->one();
        if ($product != null) {
            $res = '<a data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="SEO Дескрип < 130 или > 180"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 18 18" style="color: #e1029e">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg> </a>';
            return $res;
        }
        return null;
    }

    public
    function getNonH3Descr($id)
    {
        $product = Product::find()
            ->select('description')
            ->where(['id' => $id])
            ->andWhere(['LIKE', 'description', '<h3>'])
            ->one();
        if ($product === null) {
            $res = '<a data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="Нет <Н3> в описании"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 18 18" style="color: #dc79b7">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg> </a>';
            return $res;
        }
        return null;
    }
//     End Особое внимание к продуктам

    public function getProductsAnalog($id)
    {
        $analog = AnalogProducts::find()->where(['product_id' => $id])->all();
        if ($analog) {
            $analog = count($analog);
            return $analog;
        }
        return null;
    }

    public
    function getRating($id, $w = 18, $h = 17)
    {
        $product = Product::find()->with('reviews')->where(['id' => $id])->one();

        $res = '
            <div class="rating">
                                                    <div class="rating__body">';
        if ($product->reviews) {
            $s = [];
            foreach ($product->reviews as $review) {
                $s[] = $review->rating;
            }
            $rating = round(array_sum($s) / count($product->reviews));

            if ($rating != null) {
                for ($i = 1; $i <= $rating; $i++) {
                    $res .= '<svg class="rating__star rating__star--active" width="' . $w . 'px" height="' . $h . 'px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="/images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="/images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                <div class="rating__fill">
                                                                    <div class="fake-svg-icon"></div>
                                                                </div>
                                                                <div class="rating__stroke">
                                                                    <div class="fake-svg-icon"></div>
                                                                </div>
                                                            </div>';
                }
                if (5 - $rating != 0) {
                    for ($i = 1; $i <= 5 - $rating; $i++) {
                        $res .= '<svg class="rating__star " width="' . $w . 'px" height="' . $h . 'px">
                                                                        <g class="rating__fill">
                                                                            <use xlink:href="/images/sprite.svg#star-normal"></use>
                                                                        </g>
                                                                        <g class="rating__stroke">
                                                                            <use xlink:href="/images/sprite.svg#star-normal-stroke"></use>
                                                                        </g>
                                                                    </svg>
                                                                    <div class="rating__star rating__star--only-edge ">
                                                                        <div class="rating__fill">
                                                                            <div class="fake-svg-icon"></div>
                                                                        </div>
                                                                        <div class="rating__stroke">
                                                                            <div class="fake-svg-icon"></div>
                                                                        </div>
                                                                    </div>';
                    }
                }
            }

        } else {
            for ($i = 1; $i <= 5; $i++) {
                $res .= '<svg class="rating__star " width="' . $w . 'px" height="' . $h . 'px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="/images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="/images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge ">
                                                                <div class="rating__fill">
                                                                    <div class="fake-svg-icon"></div>
                                                                </div>
                                                                <div class="rating__stroke">
                                                                    <div class="fake-svg-icon"></div>
                                                                </div>
                                                            </div>';
            }
        }
        $res .= '</div>
                                                </div>';

        return $res;
    }

    public function getFooterDescription($description, $name)
    {
        if ($description) {
            $footer_descr = str_replace("(*name_product*)", '<b>' . $name . '</b>', $description);
            return $footer_descr;
        } else {
            return '';
        }
    }

    public function getAvailabilityProduct($status_id)
    {
        if ($status_id === 2) {
            $status = 'http://schema.org/OutOfStock';
        } elseif ($status_id === 1) {
            $status = 'https://schema.org/InStock';
        } else {
            $status = 'https://schema.org/PreOrder';
        }
        return $status;
    }

    public function getCompareProperty($id, $property)
    {
        $value = ProductProperties::find()
            ->select('value')
            ->where(['product_id' => $id, 'properties' => $property])
            ->scalar();

        return ($value && $value !== '*') ? $value : '---';
    }
}
