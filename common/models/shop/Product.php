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
 * @property float $price
 * @property float|null $old_price
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property int $status_id
 * @property int $category_id
 * @property int $label_id
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
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'short_description', 'seo_title', 'seo_description', 'price', 'status_id', 'category_id'], 'required'],
            [['description', 'footer_description', 'short_description', 'currency'], 'string'],
            [['price', 'old_price'], 'number'],
            [['status_id', 'category_id', 'label_id', 'brand_id'], 'safe'],
            [['name', 'seo_title', 'seo_description', 'slug', 'sku'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Gets query for [[ProductTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductTags()
    {
        return $this->hasMany(ProductTag::class, ['product_id' => 'id']);
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

    public function getTag()
    {
        return $this->hasOne(Tag::class, ['id' => 'id']);
    }

    public function getGrup()
    {
        return $this->hasOne(Grup::class, ['id' => 'id']);
    }

    public function getBrand()
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    public function getProperties()
    {
        return $this->hasMany(ProductProperties::class, ['product_id' => 'id']);
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
        return $this->hasMany(ProductImage::class, ['product_id' => 'id']);
    }

    public function getReviews()
    {
        return $this->hasMany(Review::class, ['product_id' => 'id']);
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
        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false) {
            $webp_support = true; // webp поддерживается
        } else {
            $webp_support = false; // webp не поддерживается
        }
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        $images = [];
        foreach ($product->images as $image) {
            if ($webp_support == true && isset($image->webp_name)) {
                $images[] = Yii::$app->request->hostInfo . '/product/' . $image->webp_name;
            } else {
                $images[] = Yii::$app->request->hostInfo . '/product/' . $image->name;
            }
        }
        return $images;
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
            return '28';
        }
    }

    public function getImgOne($id)
    {
        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false) {
            $webp_support = true; // webp поддерживается
        } else {
            $webp_support = false; // webp не поддерживается
        }
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            if ($webp_support == true && isset($product->images[0]->webp_name)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->webp_name;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->name;
            }
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    public function getImgSeo($id)
    {
        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false) {
            $webp_support = true; // webp поддерживается
        } else {
            $webp_support = false; // webp не поддерживается
        }
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            if ($webp_support == true && isset($product->images[0]->webp_large)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->webp_large;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->large;
            }
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    // 350 * 350
    public function getImgOneExtraExtraLarge($id)
    {
        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false) {
            $webp_support = true; // webp поддерживается
        } else {
            $webp_support = false; // webp не поддерживается
        }
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            if ($webp_support == true && isset($product->images[0]->webp_extra_extra_large)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->webp_extra_extra_large;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->extra_extra_large;
            }
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    // 290 * 290
    public function getImgOneExtraLarge($id)
    {
        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false) {
            $webp_support = true; // webp поддерживается
        } else {
            $webp_support = false; // webp не поддерживается
        }
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            if ($webp_support == true && isset($product->images[0]->webp_extra_large)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->webp_extra_large;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->extra_large;
            }
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    //  195 * 195
    public function getImgOneLarge($id)
    {
        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false) {
            $webp_support = true; // webp поддерживается
        } else {
            $webp_support = false; // webp не поддерживается
        }
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            if ($webp_support == true && isset($product->images[0]->webp_large)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->webp_large;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->large;
            }
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    // 150 * 150
    public function getImgOneMedium($id)
    {
        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false) {
            $webp_support = true; // webp поддерживается
        } else {
            $webp_support = false; // webp не поддерживается
        }
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            if ($webp_support == true && isset($product->images[0]->webp_medium)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->webp_medium;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->medium;
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
        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false) {
            $webp_support = true; // webp поддерживается
        } else {
            $webp_support = false; // webp не поддерживается
        }
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            if ($webp_support == true && isset($product->images[0]->webp_small)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->webp_small;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->small;
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
        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false) {
            $webp_support = true; // webp поддерживается
        } else {
            $webp_support = false; // webp не поддерживается
        }
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            if ($webp_support == true && isset($product->images[0]->webp_extra_small)) {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->webp_extra_small;
            } else {
                $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->extra_small;
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
            $product_image = ProductImage::find()->where(['product_id' => $product->id])->one();

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
        $product = Product::find()->where(['slug' => $slug])->one();

        return $product->name;
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
        $title_param = '';
        $product_params = ProductProperties::find()->where(['product_id' => $id])->orderBy('sort ASC')->all();
        foreach ($product_params as $params) {
            $title_param .= '<li style="
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
">' . $params->properties . ' ' . '<b>' . $params->value . '</b></li>';
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
        $res = '<a href="#review-form"> 0 (Не оцінювалось)</a>';
        if ($product->reviews) {
            $s = [];
            foreach ($product->reviews as $review) {
                $s[] = $review->rating;
            }
            $res = array_sum($s) / count($product->reviews);
            $count = count($product->reviews);
            $res = '<a href="#review-form"> ' . Yii::$app->formatter->asDecimal($res, 1) . ' (' . $count . ' оцінок)</a>';
        }
        return $res;
    }

    public
    function getNonParametr($id)
    {
        $res = '';
        $parametrs = ProductProperties::find()->where(['product_id' => $id])->all();

        if ($parametrs == null) {
            $res = '<a data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="Незаповнені характеристики"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 18 18" style="color: red">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg> </a>';
            return $res;

        } else {

            foreach ($parametrs as $parametr) {
                if ($parametr->value === null or $parametr->value === '') {
                    $res = '<a data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="Незаповнені характеристики"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 18 18" style="color: red">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg> </a>';
                    return $res;
                }
            }
        }
    }

    public
    function getRating($id, $w = 18, $h = 17)
    {
        $product = Product::find()->with('reviews')->where(['id' => $id])->one();
        $res = '';
        if ($product->reviews) {
            $s = [];
            foreach ($product->reviews as $review) {
                $s[] = $review->rating;
            }
            $rating = round(array_sum($s) / count($product->reviews));
            $count = count($product->reviews);

            $res = '
            <div class="rating">
                                                    <div class="rating__body">';
            if ($rating != 0) {
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
        }
        return $res;
    }

    public function getFooterDescription($id)
    {
        $footer_descr = Product::find()->select(['footer_description', 'name'])->where(['id' => $id])->one();
        if ($footer_descr->footer_description) {
            $footer_descr = str_replace("(*name_product*)",'<b>' . $footer_descr->name . '</b>', $footer_descr->footer_description);
            return $footer_descr;
        } else {
            return '';
        }
    }
}
